<?php
/**
 * @sly name  wymeditor
 * @sly title Texteditor
 */

$html = $values->get('html');

if ($html) {
	$html = FrontendHelper::processWymeditor($html);
	printf('<div class="wymeditor">%s</div>', $html);
}
