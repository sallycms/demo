<?php
/**
 * @sly name  metalist.pager
 */

// übergebene Variablen: $curPage, $perPage, $totalArticles, $pos
// $pos ist entweder 'top' oder 'bottom' und gibt an, ob der Pager über oder
// unter der Liste der Artikel erzeugt werden soll.

// Beispiel: keinen Pager über der Liste erzeugen
// if ($pos === 'top') return;

$base  = sly_Core::getCurrentArticle()->getUrl();
$pager = new sly_Util_Pager($curPage, $totalArticles, $perPage, 2, 2, 0);
$links = $pager->getHTMLString($_GET, 'p', $base, array(
	'first_active'   => false,
	'first_inactive' => false,
	'prev_active'    => '',
	'prev_inactive'  => '',
	'next_active'    => '',
	'next_inactive'  => '',
	'last_active'    => false,
	'last_inactive'  => false
));

?>
<div class="newslist-pager">
	<?php print $links ?>
</div>
