<?php
/**
 * @sly name  2column
 * @sly title 2-spaltiger Texteditor
 */

$htmlLeft = <<<SALLYCMS_WYMEDITOR_TEXT
SLY_HTML_VALUE[left]
SALLYCMS_WYMEDITOR_TEXT;

$htmlRight = <<<SALLYCMS_WYMEDITOR_TEXT
SLY_HTML_VALUE[right]
SALLYCMS_WYMEDITOR_TEXT;

$htmlLeft  = FrontendHelper::processWymeditor($htmlLeft);
$htmlRight = FrontendHelper::processWymeditor($htmlRight);

?>
<div class="twocolumn">
	<div class="left">
		<? if ('SLY_MEDIA[left]'): ?>
		<div class="image"><img src="imageresize/310w__181h__SLY_MEDIA[left]" alt="" /></div>
		<? endif ?>
		<?= $htmlLeft ?>
	</div>

	<div class="right">
		<? if ('SLY_MEDIA[right]'): ?>
		<div class="image"><img src="imageresize/310w__181h__SLY_MEDIA[right]" alt="" /></div>
		<? endif ?>
		<?= $htmlRight ?>
	</div>
</div>
