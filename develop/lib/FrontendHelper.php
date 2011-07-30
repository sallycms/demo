<?php

class FrontendHelper {
    static $navigation;

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
		return sly_Core::getLayout('Frontend');
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

		if (!empty($result)) {
			if (in_array($key, array('imprint', 'contact', 'about'))) {
				$art    = sly_Util_Article::findById($result);
				$result = $art ? $art : sly_Core::getCurrentArticle();
			}
			elseif ($key == 'email') {
				$result = WV_Mail::getSpamProtectedMail($result);
			}
		}

		return $result;
	}
}
