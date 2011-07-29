<?php
/**
 * @sly  name   3column
 * @sly  title  3-Spalten-Content
 */

$html = <<<WEBVARIANTS_TEXT
REX_HTML_VALUE[1]
WEBVARIANTS_TEXT;
if (!is_string($html)) $html = '';

$editor = WV14_WYMEditor::getSimpleEditor();
$editor->embed();
unset($editor);
?>
<div class="wvModule">
	REX_MEDIA_BUTTON[1]
	<textarea name="VALUE[1]" class="wymeditor" cols="80" rows="10"><?= htmlspecialchars($html, ENT_QUOTES, 'UTF-8') ?></textarea>
</div>
<?php 


$html2 = <<<WEBVARIANTS_TEXT
REX_HTML_VALUE[2]
WEBVARIANTS_TEXT;
if (!is_string($html2)) $html2 = '';

$editor2 = WV14_WYMEditor::getSimpleEditor();
$editor2->embed();
unset($editor2);
?>
<div class="wvModule">
	REX_MEDIA_BUTTON[2]
	<textarea name="VALUE[2]" class="wymeditor" cols="80" rows="10"><?= htmlspecialchars($html2, ENT_QUOTES, 'UTF-8') ?></textarea>
</div>

<?php
$html3 = <<<WEBVARIANTS_TEXT
REX_HTML_VALUE[3]
WEBVARIANTS_TEXT;
if (!is_string($html3)) $html3 = '';

$editor3 = WV14_WYMEditor::getSimpleEditor();
$editor3->embed();
unset($editor3);
?>
<div class="wvModule">
	REX_MEDIA_BUTTON[3]
	<textarea name="VALUE[3]" class="wymeditor" cols="80" rows="10"><?= htmlspecialchars($html3, ENT_QUOTES, 'UTF-8') ?></textarea>
</div>