<?php
/**
 * @sly  name         meta.sample
 * @sly  title        Beispielliste
 * @sly  description  ein leeres Beispieltemplate zur Verwendung mit dem Metalist-Modul
 * @sly  class        meta
 * @sly  requires     [metainfo]
 */

// Über die Metalist_Frontend-Klasse werden die Artikel direkt als $articles
// reingegeben.

// Ab Metalist_Frontend wird dem Template noch die Variable $feedLinks übergeben,
// die ein ass. Array von Feed-GET-Strings enthält.
// {rss1: 'feed=ksjhfksghfshgf', atom: 'feed=lehrk5rkr', ...}
// Nutze die Angaben, wenn Links zu den Feeds eingebaut werden sollen. Die Feeds
// werden über die API bereits in den HTML-Kopf eingehängt.

foreach ($articles as $article) {
	// $content   = $article->getArticle();
	// $metavalue = $article->getMeta('metainfo', 'optional default value');
	/* ... */
}
