<?php
/**
 * @sly name  wymeditor
 * @sly title Texteditor
 */

$html = <<<WEBVARIANTS_TEXT
SLY_HTML_VALUE[text]
WEBVARIANTS_TEXT;

$editor = WV14_WYMEditor::getSimpleEditor();
$editor->embed();
unset($editor);
?>
<div class="wvModule">
	<textarea name="VALUE[text]" class="wymeditor" cols="80" rows="10"><?= sly_html($html) ?></textarea>
</div>
