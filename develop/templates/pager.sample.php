<?php
/**
 * @sly  name         pager.sample
 * @sly  title        Beispielpager
 * @sly  description  erzeugt eine primitive Pagination für Metalisten
 * @sly  class        pager
 * @sly  requires     [metainfo]
 */

// übergebene Variablen: $curPage, $perPage, $totalArticles, $GET, $pos
// $GET enthält z.B. die Metafilter-Parameter und die Sortierreihenfolge
// und muss ggf. mit weiteren Werten ergänzt werden, damit die Metaliste
// funktioniert (falls weitere $_GET-Werte von Relevanz für das Modul sind,
// z.B. wenn realURL2 nicht aktiv ist und article_id und clang benötigt
// werden).
// $pos ist entweder 'top' oder 'bottom' und gibt an, ob der Pager über oder
// unter der Liste der Artikel erzeugt werden soll.

// Beispiel: keinen Pager über der Liste erzeugen
// if ($pos === 'top') return;

$base  = sly_Core::getCurrentArticle()->getUrl(); // will cause trouble when not using realURL2!
$pager = new sly_Util_Pager($curPage, $totalArticles, $perPage, 2, 2, 0);
$links = $pager->getHTMLString($_GET, 'p', $base, array(
	'first_active'   => false,
	'first_inactive' => false,
	'prev_active'    => '&laquo; vorherige Seite',
	'prev_inactive'  => '',
	'next_active'    => 'nächste Seite &raquo;',
	'next_inactive'  => '',
	'last_active'    => false,
	'last_inactive'  => false
));

?>
<div class="pager">
	<?= $links ?>
</div>
