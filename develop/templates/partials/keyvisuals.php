<?php
/**
 * @sly name  partials.keyvisuals
 */

// $keyvisuals must be given when rendering this template

$resize  = Project::hasAddOn('sallycms/image-resize');
$id      = count($keyvisuals) !== 1 ? ' id="keyvisual"' : '';
$width   = 905;
$height  = 200;
$prefix  = $resize ? 'resize/c'.$width.'w__c'.$height.'h__u__' : 'data/mediapool/';

print '<div'.$id.'>';

foreach ($keyvisuals as $keyvisual) {
	print '<div><img src="'.$prefix.$filename->getUri().'" alt="" /></div>';
}

print '</div>';
