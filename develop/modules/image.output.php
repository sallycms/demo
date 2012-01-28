<?php
/**
 * @sly name  image
 * @sly title Bild
 */

$image  = $values->get('image');
$resize = sly_Service_Factory::getAddOnService()->isAvailable('image_resize');

if ($image): ?>
<div class="image">
	<?php if ($resize): ?>
	<img src="<?php echo sly_Core::isBackend() ? '../' : '' ?>imageresize/310w__181h__<?php echo $image ?>" alt="" />
	<?php else: ?>
	<img src="<?php echo sly_Core::isBackend() ? '../' : '' ?>data/mediapool/<?php echo $image ?>" alt="" />
	<?php endif ?>
</div>
<?php endif ?>
