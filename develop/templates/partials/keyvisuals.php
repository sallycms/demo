<?php
/**
 * @sly name  partials.keyvisuals
 */

// $keyvisuals must be given when rendering this template

$resize = sly_Util_AddOn::isAvailable('sallycms/image-resize');
$id     = count($keyvisuals) !== 1 ? ' id="keyvisual"' : '';
$width  = 905;
$height = 200;
$prefix = $resize ? 'imageresize/c'.$width.'w__c'.$height.'h__u__' : 'data/mediapool/';

print '<div'.$id.'>';

foreach ($keyvisuals as $filename) {
	print '<div><img src="'.$prefix.$filename.'" alt="" /></div>';
}

print '</div>';
