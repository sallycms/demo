<?php
/**
 * @sly  name   3column
 * @sly  title  3-Spalten-Content
 */

$html = <<<WEBVARIANTS_TEXT
REX_HTML_VALUE[1]
WEBVARIANTS_TEXT;
$html2 = <<<WEBVARIANTS_TEXT
REX_HTML_VALUE[2]
WEBVARIANTS_TEXT;
$html3 = <<<WEBVARIANTS_TEXT
REX_HTML_VALUE[3]
WEBVARIANTS_TEXT;

if (!is_string($html) &&  !is_string($html2) && !is_string($html3)) $html = '';

if ($html && $html2 && $html3) {
	$html = A2_Thumbnail::scaleMediaImagesInHtml($html, 200);
	$html = WV_Mail::protectEmailInHtml($html);
	$html = WV14_WYMEditor::fixMediaInBackend($html);
	$html2 = A2_Thumbnail::scaleMediaImagesInHtml($html2, 200);
	$html2 = WV_Mail::protectEmailInHtml($html2);
	$html2 = WV14_WYMEditor::fixMediaInBackend($html2);
	$html3 = A2_Thumbnail::scaleMediaImagesInHtml($html3, 200);
	$html3 = WV_Mail::protectEmailInHtml($html3);
	$html3 = WV14_WYMEditor::fixMediaInBackend($html3);
	
	printf('<div id="threecolumn">');
	printf('<div class="threecolumn"><div class="images"><img src="imageresize/340w__181h__REX_MEDIA[1]"/></div>%s</div>', $html);
	printf('<div class="threecolumn"><div class="images"><img src="imageresize/340w__181h__REX_MEDIA[2]"/></div>%s</div>', $html2);
	printf('<div class="threecolumn"><div class="images"><img src="imageresize/340w__181h__REX_MEDIA[3]"/></div>%s</div>', $html2);
	printf('</div>');
}