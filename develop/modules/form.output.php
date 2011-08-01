<?php
/**
 * @sly name  form
 * @sly title Formular
 */

$template = 'SLY_VALUE[template]';

if (sly_Core::isBackend()) {
	if (empty($template)) $template = 'Es wurde kein Template angegeben';
	?>
	<label>Template:</label> <?= sly_html($template) ?>
	<?
}
else {
	?>
	<form action="<?= sly_html($_SERVER['REQUEST_URI']) ?>" method="post" enctype="multipart/form-data">
		<div class="hidden">
			<input type="hidden" name="<?= WV30_Form::FORM_ID_FIELD_NAME ?>" value="<?= $template ?>" />
		</div>
		<? sly_Service_Factory::getTemplateService()->includeFile($template) ?>
	</form>
	<?
}
