<?php
/**
 * @sly name   redirect
 * @sly title  Weiterleitung
 */
?>
<p style="padding:5px 0">Bitte wählen Sie entweder einen Artikel aus Ihrer
Webseite aus oder geben Sie eine Ziel-URL ein. Wenn Sie beides eingeben, wird
der Artikel bevorzugt.</p>
<?

$url = $values->get('url');
$url = $url ? $url : 'http://';

// Jetzt können die eigenen Elemente zum Formular hinzugefügt werden.
$form->addLink('article', 'Zielartikel', $values->get('article'));
$form->addInput('url', 'URL', $url);
