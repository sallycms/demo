<?php
/**
 * @sly  name   wymeditor
 * @sly  title  Texteditor
 */

$html =<<<WEBVARIANTS_TEXT
REX_HTML_VALUE[1]
WEBVARIANTS_TEXT;
if (!is_string($html)) $html = "";

if ($html) {
	$html = A2_Thumbnail::scaleMediaImagesInHtml($html);
	$html = WV14_WYMEditor::fixMediaInBackend($html);

	printf('<div class="wymeditor">%s</div>', $html);
}