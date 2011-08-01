<?php
/**
 * @sly name  form
 * @sly title Formular
 */

?>
<label>Template</label>
<select name="VALUE[template]" id="VALUE[template]" style="margin-bottom: 20px;">
<?

$service   = sly_Service_Factory::getTemplateService();
$templates = $service->getTemplates('form');

foreach ($templates as $name => $title) {
	$selected = '';
	if ('REX_VALUE[template]' == $name) $selected = ' selected="selected"';
	print '<option value="'.$name.'"'.$selected.'>'.sly_html($title).'</option>';
}
?>
</select>
