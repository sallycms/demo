<?php
/*
 * Copyright (c) 2014, webvariants GmbH & Co. KG, http://www.webvariants.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

/**
 * Collection of helpers to manage global settings
 */
class Settings {
	/**
	 * get raw setting
	 *
	 * @param  string $key
	 * @param  string $namespace
	 * @param  mixed  $default
	 * @return mixed
	 */
	public static function get($key, $namespace = 'project', $default = null) {
		if (!Project::hasAddOn('webvariants/global-settings')) {
			trigger_error('Global Settings is not enabled.', E_USER_WARNING);
			return $default;
		}

		return WV8_Settings::getValue($namespace, $key, $default);
	}

	/**
	 * get article model
	 *
	 * @param  string $key
	 * @param  string $namespace
	 * @param  mixed  $default    article object or ID
	 * @return sly_Model_Article
	 */
	public static function article($key, $namespace = 'project', $default = null, $clang = null, $revision = sly_Service_Article::FIND_REVISION_ONLINE) {
		$articleID = self::get($key, $namespace);

		if ($articleID || sly_Util_String::isInteger($default)) {
			$article = sly_Util_Article::findById($articleID ? $articleID : $default, $clang, $revision);
		}
		else {
			$article = $default;
		}

		return $article;
	}

	/**
	 * get site start article if no valid article was selected
	 *
	 * @param  string $key
	 * @param  string $namespace
	 * @return sly_Model_Article  the site start article if no valid article was selected
	 */
	public static function articleOrHome($key, $namespace = 'project') {
		return self::article($key, $namespace, sly_Core::getSiteStartArticleId());
	}

	/**
	 * get current article if no valid article was selected
	 *
	 * @param  string $key
	 * @param  string $namespace
	 * @return sly_Model_Article  the current article if no valid article was selected
	 */
	public static function articleOrCurrent($key, $namespace = 'project') {
		return self::article($key, $namespace, sly_Core::getCurrentArticle());
	}

	/**
	 * get (full) URL to an article
	 *
	 * @param  string  $key
	 * @param  string  $namespace
	 * @param  array   $params     GET parameters
	 * @param  string  $sep        separator
	 * @param  string  $default
	 * @param  boolean $absolute
	 * @param  boolean $secure     true to force SSL, false to force HTTP, null to keep current
	 * @return string
	 */
	public static function url($key, $namespace = 'project', $params = array(), $sep = '&amp;', $default = '#', $absolute = false, $secure = null) {
		$article = self::article($key, $namespace, null);

		if ($article === null) {
			if (is_string($default)) {
				return $default;
			}

			if (sly_Util_String::isInteger($default)) {
				$article = sly_Util_Article::findById($default);
				if (!$article) return '#';
			}
			elseif ($default instanceof sly_Model_Base_Article) {
				$article = $default;
			}
			else {
				throw new LogicException('Don\' know how to handle the default value in Settings::url().');
			}
		}

		if ($absolute) {
			$url = sly_Util_HTTP::getAbsoluteUrl($article, $article->getClang(), $params, $sep, $secure);
		}
		else {
			$url = sly_Util_HTTP::getUrl($article, $article->getClang(), $params, $sep, $secure);
		}

		return $url;
	}

	/**
	 * get absolute URL to an article
	 *
	 * This is just a simple wrapper around the all-mighty url() method.
	 *
	 * @param  string  $key
	 * @param  string  $namespace
	 * @param  array   $params     GET parameters
	 * @param  string  $sep        separator
	 * @param  string  $default
	 * @param  boolean $secure     true to force SSL, false to force HTTP, null to keep current
	 * @return string
	 */
	public static function absoluteUrl($key, $namespace = 'project', $params = array(), $sep = '&amp;', $default = '#', $secure = null) {
		return self::url($key, $namespace, $params, $sep, $default, true, $secure);
	}

	/**
	 * transform directly entered URLs into real URLs
	 *
	 * Basically takes care of turning 'www.google.com' into
	 * 'http://www.google.com/'.
	 *
	 * @param  string $key
	 * @param  string $namespace
	 * @param  string $default
	 * @return string
	 */
	public static function urlFromText($key, $namespace = 'project', $default = null) {
		$url = self::get($key, $namespace);
		if (!$url) return $default;

		if (!strpos($url, '/')) {
			$url .= '/';
		}

		if (!sly_Util_String::startsWith($url, 'http://') && !sly_Util_String::startsWith($url, 'https://')) {
			$url = 'http://'.$url;
		}

		return $url;
	}

	/**
	 * get HTML link
	 *
	 * @param  string $key
	 * @param  string $namespace
	 * @param  string $linkText   null to use the URL
	 * @param  string $classes    CSS classes for the link
	 * @param  string $default
	 * @return string
	 */
	public static function linkFromText($key, $namespace = 'project', $linkText = null, $classes = 'external', $default = null) {
		$url = self::urlFromText($key, $namespace, $default);
		if (!$url) return $default;

		if (!$linkText) {
			$linkText = $url;
		}

		return sprintf('<a href="%s" class="'.$classes.'">%s</a>', sly_html($url), sly_html($linkText));
	}
}
