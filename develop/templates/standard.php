<?php
/**
 * @sly name  standard
 * @sly slots {main: Hauptbereich}
 */

FrontendHelper::printHeader();
?>
<div id="content"><?= $article->getArticle('main') ?></div>
<? FrontendHelper::printFooter() ?>
