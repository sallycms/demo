<?php
/*
 * Copyright (c) 2013, webvariants GbR, http://www.webvariants.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

class DemoLayout extends sly_Layout_XHTML5 {
	public function __construct() {
		//////////////////////////////////////////////////////////////////
		// Zeitzone sollte auch im Frontend gesetzt werden (PHP 5.1+)

		date_default_timezone_set(sly_Core::getTimezone());

		//////////////////////////////////////////////////////////////////
		// Seitentitel setzen

		$pathString = FrontendHelper::getNavigation()->getBreadcrumbs();
		$title      = $pathString ? $pathString : sly_Core::getCurrentArticle()->getName();

		$this->setTitle($title);

		//////////////////////////////////////////////////////////////////
		// Meta- und HTTP-Meta-Angaben setzen

		$this->addMeta('robots', 'index, follow, noodp');
		$this->setLanguage('de_DE');

		//////////////////////////////////////////////////////////////////
		// CSS

		$this->addCSSFile('assets/css/textstyles.less');
		$this->addCSSFile('assets/css/main.less');

		// $this->addCSS('body { magin-top: 20px; }');

		//////////////////////////////////////////////////////////////////
		// JavaScript

		// falls Scripts direkt vor dem schließenden </body> Tag ausgegeben werden sollen (anstatt im <head>)
		// $this->putJavaScriptAtBottom();

		$this->addJavaScriptFile('assets/js/jquery.min.js', 'frameworks');

		// $this->addJavaScript('var x = 10;');
	}

	public function printHeader() {
		parent::printHeader();
		sly_Util_Template::render('top');
	}

	public function printFooter() {
		sly_Util_Template::render('bottom');
		parent::printFooter();
	}
}
