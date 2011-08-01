<?php
/**
 * @sly name  wymeditor
 * @sly title Texteditor
 */

$html = <<<SALLYCMS_WYMEDITOR_TEXT
SLY_HTML_VALUE[text]
SALLYCMS_WYMEDITOR_TEXT;

if ($html) {
	$html = FrontendHelper::processWymeditor($html);
	printf('<div class="wymeditor">%s</div>', $html);
}
