<?php
/**
 * @sly name  gallery
 * @sly title Galerie
 */

$title 		 = $values->get('title');
$images      = $values->getMedia('images');
$resize      = sly_Util_AddOn::isAvailable('sallycms/image-resize');
$extender	 = false;

print '<div class="gallery_widget"><div class="image_container">';
if ($title != null) print '<h1 class="image_title">'.$title.'</h1>';
if (sly_Core::isBackend()) {
	$image_size = "128"; $image_source = $resize ? 'imageresize/c'.$image_size.'w__c'.$image_size.'h__' : 'data/mediapool/';
	foreach ($images as $media) print '<img src="../'.$image_source.$media->getFilename().'" alt="" />';
}
else {
	print '<ul class="image_gallery">';
	for ($i = 0; $i < count($images); $i++) {
		$list_class = $i > 7 ? "bottom_images" : "top_images";
		if ($list_class == "bottom_images") $extender = true;
		$image_object = $images[$i]->getFilename();
		$image_size = "152";
		$image_source = ($resize ? 'imageresize/c'.$image_size.'w__c'.$image_size.'h__' : 'data/mediapool/').$image_object;
		print '<li class = "'.$list_class.'"><a class="fancybox-button" rel="fancybox-button" href="data/mediapool/'.$image_object.'"><img src="'.$image_source.'" alt="" /></a></li>';
	}
	print '</ul>';
	if($extender == true) {
		$bottomImages_number = count($images) - 8;
		$extenderText = $bottomImages_number != 1 ? "{$bottomImages_number} weitere Bilder" : "{$bottomImages_number} weiteres Bild";
		print '<div class="extender"><p class="clicker">mehr Bilder anzeigen</p><p id="extenderInfo">('.$extenderText.')</p><p class="clicker collapser">weniger Bilder anzeigen</p></div>';
	}
	else {
		$bottomImages_number = count($images);
		if ($bottomImages_number < 5) {
			$text = $bottomImages_number == 1 ? ' Bild' : ' Bilder';
			$wholeText = "{$bottomImages_number}".$text;
			print '<div id="bottom">'.$wholeText.'</div>';
		}
	}
}
print '</div></div>'; ?>