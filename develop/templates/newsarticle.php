<?php
/**
 * @sly name   newsarticle
 * @sly slots  {main: Hauptbereich}
 */

// init the DI container; $article is predefined by Sally to be the requested article.
$container = Project::init($article);
$layout    = $container['sly-layout'];

// add additional CSS code
$layout->addCSSFile('assets/css/newslist.less');

// get some info about the current article

$origin   = sly_get('origin', 'int', 0); // is a shortcut for $container['sly-request']->get('origin', 'int', 0)
$artID    = $article->getId();
$name     = $article->getName();
$content  = $article->getContent();
$catID    = $article->getParentId();
$catPos   = $article->getPosition();
$author   = $article->getMeta('author');
$date     = $article->getMeta('date');
$date     = $date ? date('d.m.Y', $date) : '';
$nextLink = null;
$prevLink = null;

// use the developer-utils' generic filter system to select all sibling news articles

$filter = new WV_Filter_And(
	new WV_Filter_Article_CategoryID($catID),
	new WV_Filter_Article_Type('news'),
	new WV_Filter_Article_Online()
);

$comparator = function($a, $b) {
	return $a->getPosition() - $b->getPosition();
};

$allNews = WV_Filter::filterArticles($filter, $comparator);

// determine next and prev link

foreach ($allNews as $newsArticle) {
	$pos = $newsArticle->getPosition();

	if ($pos === $catPos+1) {
		$nextLink = $newsArticle->getUrl(array('origin' => $origin));
	}

	if ($pos === $catPos-1) {
		$prevLink = $newsArticle->getUrl(array('origin' => $origin));
	}
}

$layout->start();

?>
<div id="content" class="news-article">
	<h2><?php print sly_html($name) ?></h2>
	<div class="content"><?php print $content ?></div>

	<?php if ($author || $date): ?>
	<div class="infos">
		<?php if ($author): ?>
		<span class="author"><?php print sly_html($author) ?></span>
		<?php endif ?>
		<span class="date"><?php print $date ?></span>
	</div>
	<?php endif ?>

	<div class="nav">
		<?php
		if ($prevLink) {
			?><span class="prev"><a href="<?php print $prevLink ?>">« vorheriger Artikel</a></span><?php
		}
		else {
			?><span class="prev">&nbsp;</span><?php
		}

		if ($origin) {
			$article = sly_Util_Article::findById($origin);

			if ($origin) {
				print '<a href="'.$article->getUrl().'">Verzeichnis</a>';
			}
		}

		if ($nextLink) {
			?><span class="next"><a href="<?php print $nextLink ?>">nächster Artikel »</a></span><?php
		}
		else {
			?><span class="next">&nbsp;</span><?php
		}
		?>
	</div>
</div>
<?php

// close the buffer (capture the output) and render everything
$layout->end();
