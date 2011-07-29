<?php
/**
 * @sly name         form
 * @sly title        Formular
 * @sly description  zeigt ein auswählbares Formulartemplate an
 */

?>
<div class="wvModule">
	<label>Template</label>
	<select name="VALUE[5]" id="VALUE[5]" style="margin-bottom: 20px;">
	<?

	$service   = sly_Service_Factory::getTemplateService();
	$templates = $service->getTemplates('form');
	
	foreach ($templates as $name => $title) {
		$selected = '';
		if ('REX_VALUE[5]' == $name) $selected = ' selected="selected"';
		print '<option value="'.$name.'"'.$selected.'>'.sly_html($title).'</option>';
	}
	?>
	</select>
</div>
