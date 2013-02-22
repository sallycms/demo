<?php
/**
 * @sly name test
 */

foreach ($articles as $article)
print '<a href="'.$article->getUrl().'">'.sly_html($article->getName()).'</a>';