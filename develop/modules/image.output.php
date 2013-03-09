<?php
/**
 * @sly name   image
 * @sly title  Bild
 */

$image  = $values->getMedium('image');
$resize = sly_Util_AddOn::isAvailable('sallycms/image-resize');
$prefix = sly_Core::isBackend() ? '../' : '';

if ($image): ?>
<div class="image">
	<?php if ($resize): ?>
	<img src="<?php echo $prefix ?>imageresize/310w__181h__<?php echo $image->getFilename() ?>" alt="<?php echo sly_html($image->getTitle()) ?>" title="<?php echo sly_html($image->getTitle()) ?>" />
	<?php else: ?>
	<img src="<?php echo $prefix ?>data/mediapool/<?php echo $image->getFilename() ?>" alt="<?php echo sly_html($image->getTitle()) ?>" title="<?php echo sly_html($image->getTitle()) ?>" />
	<?php endif ?>
</div>
<?php endif ?>
