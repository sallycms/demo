<?php
/**
 * @sly name test2
 */

print '<a href="'.$article->getUrl().'">'.sly_html($article->getName()).'</a>';