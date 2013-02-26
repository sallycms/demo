<?php
/**
 * @sly name newsList
 * @sly title News Liste
 */

/*$redirect = new sly_Form_Input_Checkbox('slicevalue[redirect]', '', 1, '');
$redirect->setChecked($values->get('redirect'));*/

$form->addCheckbox('preview', 'Vorschau anzeigen', '(News Auflistung zeigt eine kurze Vorschau des Artikels an)', true, $values->get('preview'));
// $form->addSelect('preview2', 'News Vorschau anzeigen', array([false]), $values->get('preview2'), 'radio');
//sly_Form_Select_Checkbox;