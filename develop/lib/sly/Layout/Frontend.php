<?php

class sly_Layout_Frontend extends sly_Layout_XHTML {
	protected $article = null;

	public function __construct() {
		//////////////////////////////////////////////////////////////////
		// Zeitzone sollte auch im Frontend gesetzt werden (PHP 5.3+)

		date_default_timezone_set(sly_Core::getTimezone());

		//////////////////////////////////////////////////////////////////
		// Seitentitel setzen

		$pathString = FrontendHelper::getNavigation()->getBreadcrumbs();
		$title      = $pathString ? $pathString : sly_Core::getCurrentArticle()->getName();

		$this->setTitle($title);

		//////////////////////////////////////////////////////////////////
		// Meta- und HTTP-Meta-Angaben setzen

		$this->addMeta('robots', 'index, follow, noodp');
		$this->addMeta('language', 'de_DE');

		$this->addHttpMeta('Content-Type', 'text/html; charset=UTF-8');
		$this->addHttpMeta('Content-Language', 'de');

		// Content-Type auch als HTTP-Header senden
		header('Content-Type: text/html; charset=UTF-8');

		//////////////////////////////////////////////////////////////////
		// CSS

		$this->addCSSFile('assets/css/reset.css');
		$this->addCSSFile('assets/css/textstyles.css');
		$this->addCSSFile('assets/css/main.css');

		// $this->addCSS('body { magin-top: 20px; }');

		//////////////////////////////////////////////////////////////////
		// JavaScript

		$this->addJavaScriptFile('assets/js/jquery.min.js', 'frameworks');
		$this->addJavaScriptFile('assets/js/nospammail.min.js', 'frameworks');

		// $this->addJavaScript('var x = 10;');

		//////////////////////////////////////////////////////////////////
		// Deployer-Integration

		if (class_exists('WV5_Deployment')) {
			WV5_Deployment::useTimeStamp(true);
			WV5_Deployment::useScaffold(true);
			WV5_Deployment::setCSSIndices(array('default', 'IF lt IE 7'));
			WV5_Deployment::setJSIndices(array('frameworks', 'default'));
			WV5_Deployment::setJSCompressionMode(WV5_Deployer_JavaScript::COMPRESSION_GOOGLE);
		}
	}
}
