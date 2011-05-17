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

	/**
	 * pseudo prints the header, it just opens a buffer and
	 * sets some variables for the layout
	 */
	public static function printHeader() {
		$layout = self::getLayout();
		$layout->openBuffer();

		header('Content-Type: text/html; charset=UTF-8');

		$layout->addMeta('robots', 'index, follow, noodp');
		//$layout->addMeta('keywords', MetaInfoUtils::getValueExForArticle('keywords'));
		//$layout->addMeta('description', MetaInfoUtils::getDescription());
		$layout->addMeta('language', 'de_DE');
		//$layout->addMeta('publisher', self::getSetting('company'));

		$layout->addHttpMeta('Content-Type', 'text/html; charset=UTF-8');
		$layout->addHttpMeta('Content-Language', 'de');
		$layout->addHttpMeta('Content-Script-Type', 'text/javascript');
		$layout->addHttpMeta('Content-Style-Type', 'text/css');

		// body
		// $layout->setBodyAttr('class', 'test');

		// favicon
		$layout->setFavIcon('favicon.ico');

		// Title
		$pathString = self::getNavigation()->getBreadcrumbs();
		$title      = $pathString ? $pathString : sly_Util_Article::findById(sly_Core::getCurrentArticleId())->getName();

		$layout->setTitle($title);

		// CSS

		$layout->addCSSFile('assets/css/main.css');
		$layout->addCSSFile('assets/css/textstyles.css');

		// $layout->addCSS('body { magin-top: 20px; }');

		// JavaScript

		$layout->addJavaScriptFile('assets/js/jquery.min.js', 'frameworks');

		// $layout->addJavaScript('var x = 10;');

		if (class_exists('WV5_Deployment')) {
			WV5_Deployment::useTimeStamp(true);
			WV5_Deployment::useScaffold(true);
			WV5_Deployment::setCSSIndices(array('default', 'IF lt IE 7'));
			WV5_Deployment::setJSIndices(array('frameworks', 'default'));
			WV5_Deployment::setJSCompressionMode(WV5_Deployer_JavaScript::COMPRESSION_GOOGLE);
		}
	}

	/**
	 * writes the html doc and the body
	 */
	public static function printFooter() {
		$layout = self::getLayout();
		$layout->closeBuffer();
		print $layout->render();
	}

	/**
	 * get a specific layout singleton
	 */
	public static function getLayout() {
		return sly_Core::getLayout('XHTML');
	}
}
