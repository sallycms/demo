<?php
/**
 * @sly name  gallery
 * @sly title Galerie
 */

# bekommt den gesetzten Titel aus dem input
$title 		 = $values->get('title');
# bekommt alle ausgewhlten Bilder aus dem input
$images      = $values->getMedia('images');
# testet ob das "image-resize" AddOn zur verfügung steht
$resize      = sly_Util_AddOn::isAvailable('sallycms/image-resize');
# definiert die "extender" Variable
$extender    = false;

print '<div class="gallery_widget"><div class="image_container">';
# testet ob ein Titel gegeben ist
# wenn ein Title gegeben ist, zeigt es diesen an, ansonsten wird die Zeile übersprungen
if ($title != null) print '<h1 class="image_title">'.$title.'</h1>';
# testet ob der Benutzer sich im Backend befindet
if (sly_Core::isBackend()) {
	# wenn der Benutzer im Backend ist, werden alle ausgewählten Bilder in einer bestimmten auflösung angezeigt ($image_size),
	# solange das "image-resize" PlugIn zur verügung steht
	$image_size = "128"; $image_source = $resize ? 'imageresize/c'.$image_size.'w__c'.$image_size.'h__' : 'data/mediapool/';
	# alle bereits ausgewählten Bilder werden in einer vereinfachten darstellung im BackEnd angezeigt
	foreach ($images as $media) print '<img src="../'.$image_source.$media->getFilename().'" alt="" />';
}
else {
	# wenn der Benutzer jedoch nicht im BackEnd ist, soll die volle Version des Blocks/Modules laden
	print '<ul class="image_gallery">';
	# für jedes Bild wird die Variable $i um ein incrementiert und die "for" Schleife durchlaufen,
	# bis die Anzahl der gegebenen Bilder erreicht ist
	for ($i = 0; $i < count($images); $i++) {
		# außerdem wird getestet ob bereits mehr als eine bestimmte Anzahl von durchläufen erreicht wurde,
		# da ab einer bestimmten Anzahl von Bilder die HTML Klasse sich ändert,
		# damit JavaSript funktionen genutzt werden können und nicht alle Bilder sichtbar sind
		$list_class = $i > 7 ? "bottom_images" : "top_images";
		# wenn nun also die HTML Klasse geändert wurde, soll der "$extender" zu aktiv/wahr umdefiniert werden
		if ($list_class == "bottom_images") $extender = true;
		# jetzt wird der Name des aktuellen Bildes geholt
		$image_object = $images[$i]->getFilename();
		# und die Bild Größe auf eienen bestimmten wert gesätzt
		$image_size = "152";
		# jetzt kann die "$image_source"/Bild URL zusammen gesetzt werden
		# dabei spielt wieder das "image-resize" PlugIn eine rolle, da es über die URL dess Bildes entscheidet
		# wenn das "image-resize" PlugIn zur verfügung steht, wird die "$image_size" eingesätzt, damit sich dass Bild auf diese Größe verändert
		$image_source = ($resize ? 'imageresize/c'.$image_size.'w__c'.$image_size.'h__' : 'data/mediapool/').$image_object;
		# jetzt kann die HTML Struktur des aktuellen Bildes zusammen gesetzt werden
		print '<li class = "'.$list_class.'"><a class="fancybox-button" rel="fancybox-button" href="data/mediapool/'.$image_object.'"><img src="'.$image_source.'" alt="" /></a></li>';
	}
	print '</ul>';
	# testet ob die "$extender" Klasse, im oberen Part, als aktiv/wahr definiert wurde
	if($extender == true) {
		# wenn das der Fall ist, wir die Anzahl aller Bilder berechnet
		$bottomImages_number = count($images) - 8;
		# wenn die berechnete Anzahl mehr als ein Bild ist, wird der "$extenderText" auf die mehrzahl angepasst
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