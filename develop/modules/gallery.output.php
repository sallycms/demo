<?php
/**
 * @sly name   gallery
 * @sly title  Galerie
 */

$title  = $values->get('title');
$images = $values->getMedia('images'); // takes all selected images, checks their existence and wraps then in sly_Model_Medium objects
$resize = Project::hasAddOn('sallycms/image-resize');
$be     = sly_Core::isBackend();
$size   = $be ? 128 : 152;
$prefix = $resize ? sprintf('mediapool/resize/c%dw__c%dh__', $size, $size) : 'mediapool/';
$rel    = 'gallery_'.uniqid();

if ($be) {
	$prefix = '../'.$prefix;
}

?>
<div class="gallery">
	<?php
	if ($title) {
		print '<h3>'.sly_html($title).'</h3>';
	}

	print '<ul class="images">';

	foreach ($images as $idx => $image) {
		$className = $idx > 7 ? 'bottom' : 'top'; // 8x top, then bottom
		$filename  = $image->getFilename();
		$title     = sly_html($image->getTitle());
		$source    = $prefix.$filename;

		// show a plain list in backend and a fancy one in frontend
		if ($be) {
			?>
			<li style="display:inline">
				<img src="<?php print $source ?>" alt="<?php print $title ?>" alt="<?php print $title ?>" />
			</li>
			<?php
		}
		else {
			?>
			<li class="<?php print $className ?>">
				<a class="fancybox" rel="<?php print $rel ?>" href="mediapool/<?php print $filename ?>" title="<?php print $title ?>">
					<img src="<?php print $source ?>" alt="<?php print $title ?>" />
				</a>
			</li>
			<?php
		}
	}

	print '</ul>';

	// show the extender in frontend if more than 8 images have been added
	if (!$be) {
		// add additional CSS code
		Project::getLayout()->addCSSFile('assets/css/gallery.less');

		$total = count($images);

		print '<div class="footer">';

		if ($total > 8) {
			$hidden = $total - 8;
			$info   = $hidden === 1 ? 'Ein weiteres Bild' : $hidden.' weitere Bilder';
			?>
			<p class="extend"><a href="#" data-alt="weniger Bilder anzeigen">mehr Bilder anzeigen</a></p>
			<p>(<?php print $info ?>)</p>
			<?php
		}
		else {
			$info = $total == 1 ? 'Ein Bild' : $total.' Bilder';
			print '<p>'.$info.'</p>';
		}

		print '</div>';
	}
	?>
</div>
