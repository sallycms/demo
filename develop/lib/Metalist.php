<?php
/*
 * Copyright (c) 2013, webvariants GbR, http://www.webvariants.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

class Metalist {
	protected $articleTypes    = array();
	protected $maxArticles     = PHP_INT_MAX;
	protected $direction       = 'DESC';
	protected $articleTemplate = '';
	protected $pagerTemplate   = '';
	protected $pagerPositions  = array('top' => false, 'bottom' => false);

	public function filterByArticleTypes($types) {
		$this->articleTypes = sly_makeArray($types);
		return $this;
	}

	public function setSortDirection($direction) {
		$this->direction = strtolower($direction) === 'asc' ? 'ASC' : 'DESC';
		return $this;
	}

	public function setArticleTemplate($template) {
		if (!empty($template)) {
			$service = sly_Service_Factory::getTemplateService();

			if (!$service->exists($template)) {
				trigger_error('Contentproblem: Nicht vorhandenes Artikeltemplate in Metalist ausgewählt.', E_USER_WARNING);
			}
			else {
				$this->articleTemplate = $template;
			}
		}

		return $this;
	}

	public function setPagerTemplate($template, $top = true, $bottom = true) {
		if (!empty($template)) {
			$service = sly_Service_Factory::getTemplateService();

			if (!$service->exists($template)) {
				trigger_error('Contentproblem: Nicht vorhandenes Pagertemplate in Metalist ausgewählt.', E_USER_WARNING);
			}
			else {
				$this->pagerTemplate  = $template;
				$this->pagerPositions = compact('top', 'bottom');
			}
		}

		return $this;
	}

	public function setMaxArticles($max) {
		$this->maxArticles = $max <= 0 ? PHP_INT_MAX : (int) $max;
		return $this;
	}

	public function show() {
		if ($this->articleTemplate === null) {
			return false;
		}

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
		$this->printList($articles, $pager);

		return true;
	}

	protected function printList(array $articles, array $pagerConfig) {
		$service = sly_Service_Factory::getTemplateService();

		$this->includePager('top', $pagerConfig);
		$service->includeFile($this->articleTemplate, compact('articles'));
		$this->includePager('bottom', $pagerConfig);
	}

	protected function filterArticles($startIdx) {
		// get a helper instance
		$params = array(
			'articleTypes'     => $this->articleTypes,
			'filterByCategory' => false,
			'sortby'           => null,
			'direction'        => null,

			// enable sorting by 'date' metainfo
			'metaSortActive'    => true,
			'metaSortToken'     => 'date',
			'metaSortDirection' => $this->direction
		);

		// let the metainfo addOn do the dirty work for us
		$helper = new WV2_MetaListHelper($params);

		return $helper->getArticles($this->maxArticles, $startIdx);
	}

	protected function createPagerConfig($articleCount, $perPage, $currentPage) {
		return ($articleCount > $perPage) ? array(
			'curPage'       => $currentPage,
			'perPage'       => $perPage,
			'totalArticles' => $articleCount,
			'GET'           => array()
		) : array();
	}

	protected function includePager($pos, array $config) {
		if (!empty($config) && $this->pagerTemplate && $this->pagerPositions[$pos]) {
			$config['pos'] = $pos;

			$service = sly_Service_Factory::getTemplateService();
			$service->includeFile($this->pagerTemplate, $config);
		}
	}
}
