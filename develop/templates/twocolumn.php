<?php
/**
 * @sly name   twocolumn
 * @sly slots  {left: Linke Spalte, right: Rechte Spalte}
 */

FrontendHelper::getLayout();
?>
<div id="content">
	<div class="left"><?php echo $article->getContent('left') ?></div>
	<div class="right"><?php echo $article->getContent('right') ?></div>
</div>
<?php
FrontendHelper::printFooter();
