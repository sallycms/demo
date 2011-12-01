<?php
/**
 * @sly name  wymeditor
 * @sly title Texteditor
 */

ob_start();
?>SLY_HTML_VALUE[text]<?
$html = ob_get_clean();

if ($html) {
	$html = FrontendHelper::processWymeditor($html);
	printf('<div class="wymeditor">%s</div>', $html);
}
