<?php
/**
 * @sly  name         meta.news
 * @sly  title        Newsliste
 * @sly  description  todo
 * @sly  class        meta
 */

$showPreview  = (bool) $additionalValues['show_preview'];
$previewClass = $showPreview == false ? 'none' : '';

if (sly_Core::isBackend())
	print '<h2>Liste aller Newsartikel</h2>';
else {
	if (!empty($articles)) {
		$list_class = " first";
		print '<div class="newslist_widget"><ul>';
		foreach ($articles as $article) {
			$date_unix = $article->getMeta('date'); $date = date('d.m.Y', $date_unix); if ($date == "01.01.1970") $date = "";
			$textPreview = sly_Util_String::cutText($article->getContent(), 250, '<a href="'.$article->getUrl().'"> (zum Artikel)</a>');
			print '<li><div class="newslist_title'.$list_class.'"><a href="'.$article->getUrl(array('listid' => sly_Core::getCurrentArticle()->getId())).'" class="preview">'.$article->getName().'</a>'.'<span> '.$date.'</span></div>';
			print '<div class="newslist_preview '.$previewClass.'">'.$textPreview.'</div></li>';
			$list_class = "";
			//print '<li class="fancyReader"><h1>'.$article->getName().'</h1><h2>'.$date.'</h2><p>'.$article->getContent().'</p></li>';
		}
		print '</ul></div>';
	}
}