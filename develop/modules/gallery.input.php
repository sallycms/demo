<?php
/**
 * @sly name  gallery
 * @sly title Galerie
 */

$form->addInput('title', 'Galerie Titel', $values->get('title'));
$form->addMediaList('images', 'Bilder auswählen', $values->get('images'));