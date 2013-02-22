<?php
/**
 * @sly name newsList
 * @sly title News auflisten
 */

if (sly_Core::isBackend()) {
	print '<p>Liste von Artikeln</p>';
	return;
}

// Neue Liste erzeugen. Jede Liste benötigt einen eindeutigen Identifier, wenn
// Feeds verwendet werden. Der Einfachheit kommt dabei die Slice-ID zum Einsatz.
$list = new Metalist_Frontend('sliceSLICE_ID');

// Filter nach Kategorie (ID 12, rekursiv ja)
// $list->filterByCategory(12, true);

// Filter nach bestimmter Metainfo (nur für Metainfos mit select-Datentyp)
// $list->filterByMetadata('mymetainfo', array('val1', 'val2'));

// Filter nach Artikeltypen (ODER-Verkünpfung)
$list->filterByArticleTypes(array('artikeltyp')); //HIER MUSS DER ENTSPRECHENDE ARTIKELTYP EINGEFÜGT WERDEN!

// Setzt die Höchstanzahl von Artikeln. Werden mehr gefunden und ist ein
// Pager-Template gesetzt, wird ein Pager angezeigt.
$list->setMaxArticles(100);

// Das Template, das zur Anzeige der Artikel verwendet werden soll.
$list->setArticleTemplate('test'); //HIER MUSS DAS TEMPLATE EINGEFÜGT WERDEN, WELCHEN DIE LISTE ANZEIGEN SOLL!

// Pager-Template, kommt nur zum Einsatz, wenn mehr als maxArticles gefunden wurden.
// Zweiter und dritter Parameter steuern, ob der Pager über und unter der Liste
// angezeigt werden soll.
// $list->setPagerTemplate('mypager', true, false);

// Soll ein Feed für diese Liste integriert werden?
// $list->enableFeeds(true, 'Titel des Feeds');

// Sortierung:
//   Entweder über ein reguläres Artikelattribut (updatedate, createdate, name, ...).
//   Oder über eine Metainfo. Dann muss der dritte Parameter true sein.
$list->setSorting('pos', 'ASC'); //HIER KANN DIE REIHENFOLGE DER ARTIKEL FESTGELEGT WERDEN! BEI NEWS SOLLEN zb. DIE NEUSTEN OBEN STEHEN!
//$list->setSorting('mymetainfo', 'DESC', true);

// Liste anzeigen
$list->show();
?>