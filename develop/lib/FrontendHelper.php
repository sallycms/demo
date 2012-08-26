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

	/**
	 * @return DemoLayout
	 */
	public static function getLayout() {
		if (!isset(self::$layout)) {
			self::$layout = new DemoLayout();
			self::$layout->openBuffer();
			sly_Core::setLayout(self::$layout);
		}

		return self::$layout;
	}

	public static function printFooter() {
		$layout = self::getLayout();
		$layout->closeBuffer();

		print $layout->render();
	}

	/**
	 * @return string
	 */
	public static function getNavigationHTML() {
		return self::getNavigation()->getNavigationHTMLString();
	}

	/**
	 * @return string
	 */
	public static function getMainArticleURL() {
		return sly_Util_Article::findSiteStartArticle()->getUrl();
	}

	public static function getSetting($key, $default = false, $namespace = 'project') {
		$service = sly_Service_Factory::getAddOnService();

		if (!$service->isAvailable('webvariants/global-settings')) {
			return $default;
		}

		$result = WV8_Settings::getValue($namespace, $key, $default);

		if (in_array($key, array('imprint', 'contact', 'about'))) {
			$art    = sly_Util_Article::findById($result);
			$result = $art ? $art : sly_Core::getCurrentArticle();
		}
		elseif ($key === 'email' && $service->isAvailable('webvariants/developer-utils')) {
			$result = WV_Mail::getSpamProtectedMail($result);
		}

		return $result;
	}

	/**
	 * @param  string $text
	 * @return string
	 */
	public static function processWymeditor($text) {
		$service = sly_Service_Factory::getAddOnService();

		if ($service->isAvailable('sallycms/image-resize')) {
			$text = A2_Thumbnail::scaleMediaImagesInHtml($text, 200);
		}

		if ($service->isAvailable('webvariants/developer-utils')) {
			$text = WV_Mail::protectEmailInHtml($text);
		}

		if ($service->isAvailable('webvariants/wymeditor')) {
			$text = WV14_WYMEditor::fixMediaInBackend($text);
		}

		return $text;
	}
}
