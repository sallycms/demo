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
 * @sly name   ckeditor
 * @sly title  Texteditor
 */
?>
<div class="ckeditor">
	<?php print Project::processRichtext($values->get('ckeditor')) ?>
</div>
