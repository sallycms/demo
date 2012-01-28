<?php
/**
 * @sly name  image
 * @sly title Bild
 */

$form->add(new sly_Form_Widget_Media('image', 'Bild auswählen', $values->get('image')));
