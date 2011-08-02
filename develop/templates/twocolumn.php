<?php
/**
 * @sly name  twocolumn
 * @sly slots {left: Linke Spalte, right: Rechte Spalte}
 */

FrontendHelper::printHeader();
?>
<div id="content">
	<div class="left"><?= $article->getArticle('left') ?></div>
	<div class="right"><?= $article->getArticle('right') ?></div>
</div>
<? FrontendHelper::printFooter() ?>
