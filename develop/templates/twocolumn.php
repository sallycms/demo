<?php
/**
 * @sly name   twocolumn
 * @sly slots  {left: Linke Spalte, right: Rechte Spalte}
 */

// init the DI container; $article is predefined by Sally to be the requested article.
$container = Project::init($article);
$layout    = $container['sly-layout'];

// open the layout buffer
$layout->start();

?>
<div id="content">
	<div class="left"><?php print $article->getContent('left') ?></div>
	<div class="right"><?php print $article->getContent('right') ?></div>
</div>
<?php

// close the buffer (capture the output) and render everything
$layout->end();
