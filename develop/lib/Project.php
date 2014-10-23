<?php
/*
 * Copyright (c) 2014, webvariants GmbH & Co. KG, http://www.webvariants.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

class Project {
	private static $container;

	public static function init(sly_Model_Article $curArticle) {
		$container = self::$container = sly_Core::getContainer();

		// Make the navigation available on the container (instead of having a
		// dedicated private static member here to keep track of the instance).

		$container['project-navigation'] = $container->share(function() {
			return new sly_Util_Navigation(2, false);
		});

		// The metalist instance is not that important and cheap to build, so we
		// do not share the instance (and hence create a new one every time the
		// list is accessed).

		$container['project-metalist'] = function($container) {
			return new Metalist($container['sly-service-template']);
		};

		// Use the Sally identifier for the layout (instead of "project-layout" or
		// something like that), since we need to make the layout available under
		// that key anyway.

		$container['sly-layout'] = $container->share(function($container) use ($curArticle) {
			return new DemoLayout($curArticle, $container['project-navigation']);
		});

		// set the project's timezone

		date_default_timezone_set($container['sly-config']->get('timezone'));

		// give the container to the template

		return $container;
	}

	/**
	 * @return string
	 */
	public static function getName() {
		return self::$container['sly-config']->get('projectname');
	}

	/**
	 * @return DemoLayout
	 */
	public static function getLayout() {
		return self::$container['sly-layout'];
	}

	/**
	 * @return sly_Util_Navigation
	 */
	public static function getNavigation() {
		return self::$container['project-navigation'];
	}

	/**
	 * @return string
	 */
	public static function getMainArticleURL() {
		return sly_Util_Article::findSiteStartArticle()->getUrl();
	}

	/**
	 * @return string
	 */
	public static function hasAddOn($name) {
		// When called from within the backend, ::init() has not been executed and
		// hence there is no self::$container.

		$container = self::$container ?: sly_Core::getContainer();
		$service   = $container['sly-service-addon'];

		return $service->isAvailable($name);
	}

	/**
	 * @param  string $text
	 * @return string
	 */
	public static function processRichtext($text) {
		if (self::hasAddOn('sallycms/image-resize')) {
			$text = sly\ImageResize\Util::scaleMediaImagesInHtml($text, array('max_width' => 200));
		}

		if (self::hasAddOn('webvariants/developer-utils')) {
			$text = WV_Mail::protectEmailInHtml($text);
		}

		return $text;
	}
}
