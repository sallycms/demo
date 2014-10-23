<?php
/**
 * @sly name   standard
 * @sly slots  {main: Hauptbereich}
 */

// init the DI container; $article is predefined by Sally to be the requested article.
$container = Project::init($article);
$layout    = $container['sly-layout'];

// open the layout buffer
$layout->start();

// no we can print our content
?>
<div id="content">
	<?php print $article->getContent('main') ?>
</div>
<?php

// close the buffer (capture the output) and render everything
$layout->end();
