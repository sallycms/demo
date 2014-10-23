<?php
/**
 * @sly name   newsList
 * @sly title  News-Beiträge auflisten
 */

// get the services we need

$container  = sly_Core::getContainer();
$artService = $container['sly-service-article'];
$tplService = $container['sly-service-template'];
$clang      = $container['sly-current-lang-id']; // == sly_Core::getCurrentClang()

// find all *online* news articles

$articles = $artService->findArticlesByType('news', $clang, true);

// sort the articles by their metadata (from newest to oldest)

usort($articles, function($a, $b) {
	return $a->getPosition() - $b->getPosition();
});

// show the 5 most recent articles

$tplService->includeFile('metalist.articles', array(
	'articles' => array_slice($articles, 0, 5)
));
