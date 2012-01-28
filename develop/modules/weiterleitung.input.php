<?php
/**
 * Weiterleitungsmodul
 *
 * Dieses Modul demonstriert, dass innerhalb von Modulen auch problemlos
 * sly_Form verwendet werden kann, um einen einheitlichen Look der Formulare zu
 * erhalten.
 *
 * @sly name  redirect
 * @sly title Weiterleitung
 */
?>
<p style="margin:5px 0 10px 0">Bitte wählen Sie entweder einen Artikel aus Ihrer
Webseite aus oder geben Sie eine Ziel-URL ein. Wenn Sie beides eingeben, wird
der Artikel bevorzugt.</p>
<?php

$url = $values->get('url');
$url = $url ? $url : 'http://';

// Jetzt können die eigenen Elemente zum Formular hinzugefügt werden.
$form->add(new sly_Form_Widget_Link('article', 'Zielartikel', $values->get('article')));
$form->add(new sly_Form_Input_Text('url', 'URL', $url));
