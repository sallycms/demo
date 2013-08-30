<?php
/**
 * @sly name   newsarticle
 * @sly title  News Artikel
 * @sly slots  {main: Hauptbereich}
 */

// add additional CSS code
FrontendHelper::getLayout()->addCSSFile('assets/css/newslist.less');

$origin   = sly_get('origin', 'int', 0);
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
$allNews  = WV_Sally::filterArticles(new WV_Filter_And(
	new WV_Filter_Article_CategoryID($catID),
	new WV_Filter_Article_Type('news'),
	new WV_Filter_Article_Online()
), 'article.catpos', 'ASC');

foreach ($allNews as $newsArticle) {
	$pos = $newsArticle->getPosition();

	if ($pos === $catPos+1) {
		$nextLink = $newsArticle->getUrl(array('origin' => $origin));
	}

	if ($pos === $catPos-1) {
		$prevLink = $newsArticle->getUrl(array('origin' => $origin));
	}
}

FrontendHelper::getLayout();
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
FrontendHelper::printFooter();
