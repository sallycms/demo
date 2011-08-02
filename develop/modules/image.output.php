<?php
/**
 * @sly name  image
 * @sly title Bild
 */
?>
<?php if ('SLY_MEDIA[image]') : ?>
<div class="image"><img src="<?= sly_Core::isBackend() ? '../' : '' ?>imageresize/310w__181h__SLY_MEDIA[image]" alt="" /></div>
<?php endif ?>
