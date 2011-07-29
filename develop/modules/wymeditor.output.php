<?php
/**
 * @sly  name   wymeditor
 * @sly  title  Texteditor
 */

$html = <<<WEBVARIANTS_TEXT
SLY_HTML_VALUE[text]
WEBVARIANTS_TEXT;
if (!is_string($html)) $html = '';

if ($html) {
	$service = sly_Service_Factory::getAddOnService();

	if ($service->isAvailable('image_resize')) {
		$html = A2_Thumbnail::scaleMediaImagesInHtml($html, 200);
	}

	if ($service->isAvailable('developer_utils')) {
		$html = WV_Mail::protectEmailInHtml($html);
	}

	$html = WV14_WYMEditor::fixMediaInBackend($html);
	printf('<div class="wymeditor">%s</div>', $html);
}
