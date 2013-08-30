<?php
/**
 * Copyright (c) 2013, MEDIASTUTTGART, http://mediastuttgart.de
 *
 * This file is released under the terms of the MIT license.
 * You can find the complete text in the attached LICENSE
 * file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 *
 * @sly name ckeditor
 * @sly title Texteditor (CKEditor)
 */

$ckeditor = new sly_Form_CKEditor('ckeditor', 'Texteditor', $values->get('ckeditor'));

/*
 * load custom styleset
 *
 * $ckeditor->setStyleset('custom');
 */

/*
 * load custom configuration
 *
 * $ckeditor->setConfig('custom');
 */

/*
 * set single configuration value
 *
 * $ckeditor->setConfigValue('forcePasteAsPlainText', true);
 */

/*
 * use full width
 *
 * $ckeditor->useFullWidth();
 */

$form->add($ckeditor);
