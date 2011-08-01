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
<p style="margin-bottom:10px">Bitte wählen Sie entweder einen Artikel aus Ihrer
Webseite aus oder geben Sie eine Ziel-URL ein. Wenn Sie beides eingeben, wird
der Artikel bevorzugt.</p>
<?

$url = 'SLY_VALUE[url]' ? 'SLY_VALUE[url]' : 'http://';

// Die Werte sind irrelevant, da kein <form>-Tag erzeugt wird.
$form = new sly_Form('index.php', 'POST', '');

// Die Buttons des Formulars müssen entfernt werden.
$form->setSubmitButton(null);
$form->setResetButton(null);

// Jetzt können die eigenen Elemente zum Formular hinzugefügt werden.
$form->add(new sly_Form_Widget_Link('SLY_'.'LINK[article]', 'Zielartikel', 'SLY_LINK[article]'));
$form->add(new sly_Form_Input_Text('VALUE[url]', 'URL', $url));

// Das Formular muss ohne <form>-Tag gerendert werden.
print $form->render(true);
