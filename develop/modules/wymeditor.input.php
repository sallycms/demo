<?php
/**
 * @sly  name   wymeditor
 * @sly  title  Texteditor
 */

$html =<<<WEBVARIANTS_TEXT
REX_HTML_VALUE[1]
WEBVARIANTS_TEXT;
if (!is_string($html)) $html = "";

$editor = WV14_WYMEditor::getSimpleEditor();
$editor->setPlugins(array('hovertools', 'email', 'filelink', 'fullscreen')); //resizable is expermental
$editor->embed();
unset($editor);
?>
<div>
	<label style="width:100%;">Fließtext:</label>
	<textarea name="VALUE[1]" class="wymeditor" cols="80" rows="10"><?php echo sly_html($html) ?></textarea>
</div>
