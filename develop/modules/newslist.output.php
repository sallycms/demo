<?php
/**
 * @sly name   newsList
 * @sly title  News-Beiträge auflisten
 */

// Use a custom project helper class (develop/lib/Metalist), so we don't have
// to talk with the metainfo addOn directly here (which can get kind of messy).
$list = new Metalist();

// only show articles matching these article types
$list->filterByArticleTypes(array('news'));

// Only show N articles at most per page. If there are more available, a pager
// will be generated.
$list->setMaxArticles(3);

// configure the pager template to use and show it below the list
$list->setPagerTemplate('metalist.pager', false, true);

// configure the template to use for the actual article list (the meat of this list)
$list->setArticleTemplate('metalist.articles');

// set sorting
$list->setSortDirection('desc');

// and finally show the list
$list->show();
