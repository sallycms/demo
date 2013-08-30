<?php
/**
 * @sly name   wymeditor
 * @sly title  Texteditor
 */

if (!class_exists('sly_Form_Wymeditor')) {
	throw new sly_Exception('Das WYMeditor-AddOn muss aktiviert sein, um dieses Modul zu verwenden.');
}

$editor = new sly_Form_Wymeditor('html', 'Fließtext', $values->get('html'));
$editor->useFullWidth();

$form->add($editor);
