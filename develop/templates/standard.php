<?php
/**
 * @sly name  standard
 * @sly slots {main: Hauptbereich}
 */

FrontendHelper::printHeader();
?>
<div id="content"><?php echo $article->getContent('main') ?></div>
<?php FrontendHelper::printFooter(); ?>
