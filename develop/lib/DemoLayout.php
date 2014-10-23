<?php
/*
 * Copyright (c) 2014, webvariants GmbH & Co. KG, http://www.webvariants.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

class DemoLayout extends sly_Layout_XHTML5 {
	protected $article;

	public function __construct(sly_Model_Article $curArticle, sly_Util_Navigation $navigation) {
		// remember the current article for later

		$this->article = $curArticle;

		// determine page title

		$this->setTitle($navigation->getBreadcrumbs() ?: $curArticle->getName());

		// add some meta information

		$this->addMeta('robots', 'index, follow, noodp');
		$this->setLanguage('de_DE');

		// CSS

		$this->addCSSFile('assets/css/textstyles.less');
		$this->addCSSFile('assets/css/main.less');
		$this->addCSSFile('assets/css/jquery.fancybox.css');

		// $this->addCSS('body { magin-top: 20px; }');

		// JavaScript

		// falls Scripts direkt vor dem schließenden </body> Tag ausgegeben werden sollen (anstatt im <head>)
		// $this->putJavaScriptAtBottom();

		$this->addJavaScriptFile('assets/js/jquery.min.js', 'frameworks');
		$this->addJavaScriptFile('assets/js/jquery.fancybox.pack.js', 'frameworks');
		$this->addJavaScriptFile('assets/js/main.js');

		// $this->addJavaScript('var x = 10;');
	}

	public function start() {
		$this->openBuffer();
	}

	public function end() {
		$this->closeBuffer();
		print $this->render();
	}

	public function printHeader() {
		parent::printHeader();
		sly_Util_Template::render('partials.top', array('self' => $this->article));
	}

	public function printFooter() {
		sly_Util_Template::render('partials.bottom', array('self' => $this->article));
		parent::printFooter();
	}
}
