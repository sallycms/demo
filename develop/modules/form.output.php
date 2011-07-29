<?php
/**
 * @sly name         form
 * @sly title        Formular
 * @sly description  zeigt ein auswählbares Formulartemplate an
 */


if (sly_Core::isBackend()) {
	$templateName = 'REX_VALUE[5]';
	if (empty($templateName)) $templateName = 'Es wurde kein Template angegeben';
	?>
	<div class="wvModule">
		<label>Template</label>
		<?= sly_html($templateName) ?>
	</div>
	<?
}
else {
	?>
	<form action="<?= sly_html($_SERVER['REQUEST_URI']) ?>" method="post" enctype="multipart/form-data">
		<div class="hidden">
			<input type="hidden" name="<?= WV30_Form::FORM_ID_FIELD_NAME ?>" value="REX_VALUE[5]" />
		</div>
		<? sly_Service_Factory::getTemplateService()->includeFile('REX_VALUE[5]') ?>
	</form>
	<?
}

?>