<?php
/**
 * @sly  name         meta.news
 * @sly  title        Newsliste
 * @sly  description  todo
 * @sly  class        meta
 * @sly  required     true
 */

# List Klasse muss als "first" defieniert werden, da der erste Eintrag ohne top-padding dargestellt werden soll
$list_class   = " first";
if (sly_Core::isBackend())
	# Wenn Sally im Backend ist, wird nur ein kurzer Header angezeigt
	print '<h2>Liste aller Newsartikel</h2>';
else {
	# Wenn Sally im Frontend ist, wird die komplete Liste alles Newsartikel angezeigt
	if (!empty($articles)) {
		print '<div class="newslist_widget"><ul>';
		foreach ($articles as $article) {
			# Nimmt das aktuelle Datum und schreibt es in ein lesbares Format
			$date_unix = $article->getMeta('date'); $date = date('d.m.Y', $date_unix); if ($date == "01.01.1970") $date = "";
			$textPreview = sly_Util_String::cutText($article->getContent(), 250, '<a href="'.$article->getUrl(array('listid' => sly_Core::getCurrentArticle()->getId())).'"> (zum Artikel)</a>');
			print '<li><div class="newslist_title'.$list_class.'"><a>'.$article->getName().'</a><span> '.$date.'</span></div>';
			print '<div class="newslist_preview">'.$textPreview.'</div></li>';
			# Jetzt kann die List Klasse entfernt werden, da das erste Eintrag gesetzt wurde
			$list_class = "";
		}
		print '</ul></div>';
	}
}