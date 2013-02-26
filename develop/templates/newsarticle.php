<?php
/**
 * @sly  name         newsarticle
 * @sly  title        News Artikel
 * @sly slots {main: Hauptbereich}
 */

$listid = sly_get('listid', 'int', 0);

$catId = $article->getParentId();   //returns 2
$currCatPos = $article->getPosition(); //returns 0
$allArticle = WV_Sally::filterArticles(new WV_Filter_And(
      new WV_Filter_Article_Column('article.re_id', $catId, '='),
      new WV_Filter_Article_Type('newsarticle'),
      new WV_Filter_Article_Online()
    ), 'article.catpos', 'ASC');
$countArt = count($allArticle); $next_link = null; $prev_link = null;
if ($countArt > 1) {
 foreach ($allArticle as $article_i) {
 	if ($article_i->getPosition() == ($currCatPos + 1)) {
 		$next_link = $article_i->getUrl(array('listid' => sly_Core::getCurrentArticle()->getId()));
 	}
 	if ($article_i->getPosition() == ($currCatPos - 1)) {
 		$prev_link = $article_i->getUrl(array('listid' => sly_Core::getCurrentArticle()->getId()));
 	}
 }
}
else {
 	if ($next_link == null) $next_link = $allArticle[0]->getUrl();
	if ($prev_link == null) $prev_link = $allArticle[count($allArticle) - 1]->getUrl();
}
$date_unix = $article->getMeta('date'); $date = date('d.m.Y', $date_unix); if ($date == "01.01.1970") $date = "";
$author    = $article->getMeta('author', null);

FrontendHelper::getLayout();
print '<div id="content"><div class="newsarticle_title">'.$article->getName().'</div>';
print '<div class="newsarticle_content">'.$article->getContent('main').'</div>';
print '<div class="newsarticle_bottom">';
print ($date !== null) ? '<span class="leftValue">'.$author.'</span>' : '';
print '<span class="rightValue">'.$date.'</span></div>';
print '<div id="footerBar">';
print ($prev_link !== null) ? '<a id="prevLink" href="'.$prev_link.'">vorheriger Artikel</a>' : '';
if ($listid > 0) print '<a href="'.(sly_Util_Article::findById($listid)->getUrl()).'">Verzeichniss</a>';
print ($next_link !== null) ? '<a id="nextLink" href="'.$next_link.'">nächster Artikel</a>' : '';
print '</div></div>';
FrontendHelper::printFooter(); ?>