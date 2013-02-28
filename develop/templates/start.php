<?php
/**
 * @sly  name         start
 * @sly slots {main: Hauptbereich}
 */

FrontendHelper::getLayout();
print '<div id="content">';
$article->getContent('main');
print '</div>';
FrontendHelper::printFooter(); ?>