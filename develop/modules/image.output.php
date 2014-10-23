<?php
/**
 * @sly name   image
 * @sly title  Bild
 */

$image  = $values->getMedium('image');
$prefix = sly_Core::isBackend() ? '../' : '';

// We can simply return and end the module in case there is no image selected.
if (!$image) {
	return;
}

if (Project::hasAddOn('sallycms/image-resize')) {
	$url = 'mediapool/resize/310w__181h__'.$image->getFilename();
}
else {
	$url = 'mediapool/'.$image->getFilename();
}

?>
<div class="image">
	<img src="<?php print $prefix.$url ?>" alt="<?php print sly_html($image->getTitle()) ?>" title="<?php print sly_html($image->getTitle()) ?>" />
</div>
