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

$editor = WV14_WYMEditor::getSimpleEditor();
$editor->embed();

?>
<h1 style="font-size:18px;font-weight:bold;margin:1em 0">Linke Spalte</h1>

SLY_MEDIA_WIDGET[left]
<textarea name="VALUE[left]" class="wymeditor" cols="80" rows="10"><?= sly_html($htmlLeft) ?></textarea>

<h1 style="font-size:18px;font-weight:bold;margin:1em 0">Rechte Spalte</h1>

SLY_MEDIA_WIDGET[right]
<textarea name="VALUE[right]" class="wymeditor" cols="80" rows="10"><?= sly_html($htmlRight) ?></textarea>
