<?php
/**
 * @sly name   standard
 * @sly slots  {main: Hauptbereich}
 */

FrontendHelper::getLayout();
?>
<div id="content">
	<?php echo $article->getContent('main') ?>
</div>
<?php
FrontendHelper::printFooter();
