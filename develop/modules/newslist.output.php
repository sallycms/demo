<?php
/**
 * @sly name newsList
 * @sly title News List
 */

// Neue Liste erzeugen. Jede Liste benötigt einen eindeutigen Identifier, wenn
// Feeds verwendet werden. Der Einfachheit kommt dabei die Slice-ID zum Einsatz
$list = new Metalist_Frontend($slice->getSliceId());

// Filter nach Kategorie (ID 12, rekursiv ja)
// $list->filterByCategory(12, true);

// Filter nach bestimmter Metainfo (nur für Metainfos mit select-Datentyp)
// $list->filterByMetadata('mymetainfo', array('val1', 'val2'));

// Filter nach Artikeltypen (ODER-Verkünpfung)
$list->filterByArticleTypes(array('newsarticle'));

// Setzt die Höchstanzahl von Artikeln. Werden mehr gefunden und ist ein
// Pager-Template gesetzt, wird ein Pager angezeigt.
$list->setMaxArticles(100);
$list->setValue('show_preview', $values->get('preview'));
$list->setArticleTemplate('meta.news');
$list->show();