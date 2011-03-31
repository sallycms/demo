<?php
/**
 * @sly  name    standard
 * @sly  title   Standard
 * @sly  active  true
 */

FrontendHelper::printHeader();
?>
<div id="page">
	<div id="header">
		<div id="logo">
		</div>
		<div id="keyvisual">
		</div>
	</div>
	<div id="nav"><? echo FrontendHelper::getNavigation() ?></div>
	<div id="article">
		<h1><?= $article->getName() ?></h1>
		<div id="content">
			<?= $article->getContent() ?>
		</div>
	</div>
	<div id="footer">
		&copy; <a href="http://www.webvariants.de">webvariants</a>
		<a href="http://www.sallycms.de">www.sallycms.de</a>
	</div>
</div>
<?php
FrontendHelper::printFooter();

