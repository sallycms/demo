<?php
/**
 * @sly name  form.contact
 * @sly title Kontaktformular
 * @sly class form
 */

$form = WV30_Helper::getForm('form.contact', true);

if ($form->isSubmitted()) {
	$form->isValid();
	$values = $form->getValues();
}

if ($form->isSubmitted() && $form->isValid()) {
	printf('<p class="info_message">%s</p>', ht($form->getSuccessMessage()));
}

if ($form->isSubmitted() && !$form->isValid()) {
	printf('<p class="error_message">%s</p>', ht($form->getErrorMessage()));
}

?>

<div id="contactform">
	<h6>Kontaktformular</h6>

	<div id="name">
		<label for="named">Name:</label>
		<input name="name" id="<?= WV30_Helper::hasErrors() ? 'error' : 'named' ?>" value="<?= sly_html(WV30_Helper::getValueOnError('name')) ?>"/>
	</div>

	<div id="email">
		<label for="mail">E-Mail:</label>
		<input name="mail" id="<?= WV30_Helper::hasErrors() ? 'error' : 'mail' ?>" value="<?= sly_html(WV30_Helper::getValueOnError('mail')) ?>"/>
	</div>

	<div id="message">
		<label for="text">Nachricht:</label>
		<textarea name="text" id="<?= WV30_Helper::hasErrors() ? 'error' : 'text' ?>" rows="2" cols="8"><?= WV30_Helper::getValueOnError('text') ?></textarea>
	</div>

	<div id="send">
		<input type="submit" name="send" value="Abesenden"/>
	</div>
</div>
