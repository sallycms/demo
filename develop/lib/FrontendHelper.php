<?php
/*
 * Copyright (c) 2012, webvariants GbR, http://www.webvariants.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

class FrontendHelper {
	private static $navigation;
	private static $layout;

	/**
	 * returns a sly_Util_Navigation instance
	 *
	 * @return sly_Util_Navigation
	 */
	public static function getNavigation() {
		if (!isset(self::$navigation)) {
			self::$navigation = new sly_Util_Navigation(2, false);
		}
		return self::$navigation;
	}

	public static function getLayout() {
		if (!isset(self::$layout)) {
			self::$layout = new sly_Layout_Frontend();
			sly_Core::setLayout(self::$layout);
		}

		return self::$layout;
	}

	public static function printHeader() {
		self::getLayout()->printHeader();
	}

	public static function printFooter() {
		self::getLayout()->printFooter();
	}

	public static function getNavigationHTML() {
		return self::getNavigation()->getNavigationHTMLString();
	}

	public static function getMainArticleURL() {
		return sly_Util_Article::findSiteStartArticle()->getUrl();
	}

	public static function getSetting($key, $default = false, $namespace = 'project') {
		$result = WV8_Settings::getValue($namespace, $key, $default);

		if (in_array($key, array('imprint', 'contact', 'about'))) {
			$art    = sly_Util_Article::findById($result);
			$result = $art ? $art : sly_Core::getCurrentArticle();
		}
		elseif ($key == 'email') {
			$result = WV_Mail::getSpamProtectedMail($result);
		}

		return $result;
	}

	public static function processWymeditor($text) {
		$service = sly_Service_Factory::getAddOnService();

		if ($service->isAvailable('image_resize')) {
			$text = A2_Thumbnail::scaleMediaImagesInHtml($text, 200);
		}

		if ($service->isAvailable('developer_utils')) {
			$text = WV_Mail::protectEmailInHtml($text);
		}

		if ($service->isAvailable('wymeditor')) {
			$text = WV14_WYMEditor::fixMediaInBackend($text);
		}

		return $text;
	}
}
