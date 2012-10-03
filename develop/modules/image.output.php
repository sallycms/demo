<?php
/**
 * @sly name  image
 * @sly title Bild
 */

$image  = $values->get('image');
$resize = sly_Util_AddOn::isAvailable('sallycms/image-resize');
$prefix = sly_Core::isBackend() ? '../' : '';

if ($image): ?>
<div class="image">
	<?php if ($resize): ?>
	<img src="<?php echo $prefix ?>imageresize/310w__181h__<?php echo $image ?>" alt="" />
	<?php else: ?>
	<img src="<?php echo $prefix ?>data/mediapool/<?php echo $image ?>" alt="" />
	<?php endif ?>
</div>
<?php endif ?>
