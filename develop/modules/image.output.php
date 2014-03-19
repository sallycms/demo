<?php
/**
 * @sly name  image
 * @sly title Bild
 */

$image  = $values->getMedium('image');
$resize = sly_Util_AddOn::isAvailable('sallycms/image-resize');
$prefix = sly_Core::isBackend() ? '../' : '';

if ($image) {
	$url = $resize ? $image->resize(array('width' => 310, 'height' => 181)) : 'mediapool/'.$image->getFileName();
?>
	<div class="image">
		<img src="<?php echo $prefix . $url ?>" alt="<?php echo $image->getTitle() ?>" />
	</div>
<?php } ?>
