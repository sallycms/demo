<?php
/*
 * Copyright (c) 2012, webvariants GbR, http://www.webvariants.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

class Metalist_Frontend {
	// unique ID to make feeds work
	protected $listID = null;

	// category filter
	protected $category          = null;
	protected $categoryRecursive = false;

	// article type filter
	protected $articleTypes = null;

	// metadata filter
	protected $metainfo   = null;
	protected $metaValues = null;

	// general config
	protected $maxArticles     = PHP_INT_MAX;
	protected $articleTemplate = '';
	protected $pagerTemplate   = '';
	protected $pagerPositions  = array('top' => false, 'bottom' => false);

	// feed config
	protected $enableFeeds = false;
	protected $feedTitle   = null;

	// sorting config (either by regular article data or by metadata)
	protected $sortby     = null;
	protected $direction  = null;
	protected $isMetaSort = false;

	public function __construct($listID) {
		$this->listID = $listID;
	}

	public function filterByCategory($category, $recursive = false) {
		if (!$category && $recursive) return; // meaningless, will catch all articles anyway

		$category = WV_Sally::getIDForCategory($category);

		if (!$category /* root? */ || sly_Util_Category::exists($category) /* real category */) {
			$this->category          = $category;
			$this->categoryRecursive = (boolean) $recursive;
		}
		else {
			trigger_error('Contentproblem: Nicht vorhandene Kategorie ausgewählt.', E_USER_WARNING);
		}
	}

	public function filterByArticleTypes($types) {
		$this->articleTypes = sly_makeArray($types);
	}

	public function filterByMetadata($metainfo, $values) {
		$this->metainfo   = $metainfo;
		$this->metaValues = $values;
	}

	public function setSorting($sortby, $direction, $isMeta = false) {
		$this->sortby     = $sortby;
		$this->direction  = strtolower($direction) === 'asc' ? 'ASC' : 'DESC';
		$this->isMetaSort = (boolean) $isMeta;
	}

	public function setArticleTemplate($template) {
		if (empty($template)) return;
		$service = sly_Service_Factory::getTemplateService();

		if (!$service->exists($template)) {
			trigger_error('Contentproblem: Nicht vorhandenes Artikeltemplate in Metalist ausgewählt.', E_USER_WARNING);
		}
		else {
			$this->articleTemplate = $template;
		}
	}

	public function setPagerTemplate($template, $top = true, $bottom = true) {
		if (empty($template)) return;
		$service = sly_Service_Factory::getTemplateService();

		if (!$service->exists($template)) {
			trigger_error('Contentproblem: Nicht vorhandenes Pagertemplate in Metalist ausgewählt.', E_USER_WARNING);
		}
		else {
			$this->pagerTemplate  = $template;
			$this->pagerPositions = compact('top', 'bottom');
		}
	}

	public function setMaxArticles($max) {
		$this->maxArticles = $max <= 0 ? PHP_INT_MAX : (int) $max;
	}

	public function enableFeeds($switch = true, $feedTitle = null) {
		if (!class_exists('WV21_Feeds')) {
			trigger_error('Contentproblem: Feed-AddOn muss aktiviert werden.', E_USER_WARNING);
			$switch = false;
		}

		$this->enableFeeds = (boolean) $switch;
		$this->feedTitle   = $feedTitle;
	}

	public function show() {
		if ($this->articleTemplate === null) {
			return false;
		}

		// when in lucene mode, do nothing at all

		if (class_exists('WV11') && WV11::isRunning()) {
			return false;
		}

		// create the feed integration

		$feedLink = $this->enableFeeds ? $this->createFeed() : array();

		// prepare pager

		$perPage     = $this->maxArticles;
		$currentPage = abs(sly_get('p', 'int'));
		$startIdx    = $currentPage * $perPage;

		// find all matching articles

		$articles     = $this->filterArticles($startIdx);
		$articleCount = $articles[1];
		$articles     = $articles[0];

		// prepare pager

		$pager = $this->pagerTemplate ? $this->createPagerConfig($articleCount, $perPage, $currentPage) : array();

		// print all three parts

		$this->printList($articles, $pager, array($feedLink));
	}

	protected function printList(array $articles, array $pagerConfig, array $feedLink) {
		$service = sly_Service_Factory::getTemplateService();

		$this->includePager('top', $pagerConfig);
		$service->includeFile($this->articleTemplate, compact('articles', 'feedLink'));
		$this->includePager('bottom', $pagerConfig);
	}

	protected function filterArticles($startIdx) {
		// prepare meta filter and sorting and let the user overwrite the default ones

		$retval = $this->getMetaFilter();
		extract($retval);

		$retval = $this->getMetaSort();
		extract($retval);

		// get a helper instance

		$params = array(
			'metaFilterActive'      => $metaFilterActive,
			'metaFilter'            => $metaFilter,

			'metaSortActive'        => $this->isMetaSort,
			'metaSortToken'         => $this->isMetaSort ? $metaSortToken : null,
			'metaSortDirection'     => $this->isMetaSort ? $metaSortDirection : null,

			'articleTypes'          => sly_makeArray($this->articleTypes),

			'filterByCategory'      => $this->category !== null,
			'categoryId'            => $this->category,
			'walkCategoryRecursive' => $this->categoryRecursive,

			'sortby'                => $this->isMetaSort ? null : $this->sortby,
			'direction'             => $this->isMetaSort ? null : $this->direction
		);

		$metaListHelper = $this->getMetaListHelper($params);

		return $metaListHelper->getArticles($this->maxArticles, $startIdx);
	}

	protected function getMetaListHelper(array $params) {
		return new WV2_MetaListHelper($params);
	}

	protected function createPagerConfig($articleCount, $perPage, $currentPage) {
		$pager = array();

		if ($articleCount > $perPage) {
			$pager = array('curPage' => $currentPage, 'perPage' => $perPage, 'totalArticles' => $articleCount, 'GET' => array());

			// add special meta filter and sorting parameters

			$retval = $this->getMetaFilter();
			extract($retval);

			if ($metaFilterActive) {
				$pager['GET']['filter_value'] = $metaFilter;
			}

			if ($this->isMetaSort) {
				$retval = $this->getMetaSort();
				extract($retval);

				$pager['GET']['sort_token']     = $metaSortToken;
				$pager['GET']['sort_direction'] = $metaSortDirection;
			}
		}

		return $pager;
	}

	protected function includePager($pos, array $config) {
		if (!empty($config) && $this->pagerTemplate && $this->pagerPositions[$pos]) {
			$config['pos'] = $pos;

			$service = sly_Service_Factory::getTemplateService();
			$service->includeFile($this->pagerTemplate, $config);
		}
	}

	protected function createFeed() {
		$filter = new WV_Filter_And(
			new WV_Filter_Article_CLang(sly_Core::getCurrentClang())
		);

		if ($this->category !== null) {
			$filter->add(new WV_Filter_Article_CLang(sly_Core::getCurrentClang()));
		}

		if (!empty($this->articleTypes)) {
			$subFilter = new WV_Filter_Or();

			foreach ($this->articleTypes as $type) {
				$subFilter->add(new WV_Filter_Article_Type($type));
			}

			$filter->add($subFilter);
		}

		if ($this->feedTitle === null) {
			$title = sly_Util_Category::findById($this->category)->getName();
		}
		else {
			$title = $this->feedTitle;
		}

		$layout  = James::getLayout();
		$formats = $this->getFeedFormats();
		$feedID  = WV21_Feeds::createArticleFeed($this->listID, $title, $filter, array('filedownloadex','googlemaps','productteaser','wymeditor','preview', 'sidebar_contact'));
		$url     = sly_Util_HTTP::getBaseUrl(true).'/feed/'.$feedID;

		$layout->addFeedFile($url, 'rss2');

		// remember for footer
		sly_Core::getTempRegistry()->set('rssfeed', $url);

		return $url;
	}

	/**
	 * Overwrite this method if you need less feed formats. It's a method and
	 * no property, because this way the WV21_Feeds class is only loaded when
	 * feeds are active.
	 *
	 * @return array  list of enabled feed formats
	 */
	protected function getFeedFormats() {
		return array(
			'atom' => WV21_Feed::FORMAT_ATOM,
			'rss1' => WV21_Feed::FORMAT_RSS1,
			'rss2' => WV21_Feed::FORMAT_RSS2
		);
	}

	protected function getMetaFilter() {
		$metaFilterActive = $this->metainfo !== null;
		$metaFilter       = null;

		if ($metaFilterActive) {
			$metaFilterActive = sly_request('metafilter', 'bool', true);
			$metaFilter       = array($this->metainfo => $this->metaValues);
			$metaFilter       = sly_request('metafilter', 'array', $metaFilter);
		}

		return compact('metaFilterActive', 'metaFilter');
	}

	protected function getMetaSort() {
		$metaSortToken     = $this->sortby;
		$metaSortDirection = $this->direction;

		if ($this->isMetaSort) {
			$metaSortToken     = sly_get('sort_token', 'string', $metaSortToken);
			$metaSortDirection = sly_get('sort_direction', 'string', $metaSortDirection);
			$metaSortDirection = strtolower($metaSortDirection) === 'asc' ? 'ASC' : 'DESC';
		}

		return compact('metaSortToken', 'metaSortDirection');
	}
}
