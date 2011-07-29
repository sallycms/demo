<?php
/**
 * @sly name  standard
 * @sly title Standardseite
 * @sly slots {main: Hauptbereich}
 */

FrontendHelper::printHeader();
?>
<div id="wrapper"></div>
<div id="logo"><a href="<?= FrontendHelper::getMainArticleURL() ?>" name="logo"><img src="assets/images/logo.png" alt="<?= sly_html(FrontendHelper::getSetting('company')) ?>" /></a></div>
<div id="page">
	<div id="header">
		<div id="prenavi">
			<p>Das Sally CMS - <br /> gut bedienbare und professionelle Webseiten</p>
			<ul>
				<li><a href="<?= FrontendHelper::getSetting('contact')->getUrl() ?>">Kontakt</a></li>
				<li><a href="<?= FrontendHelper::getSetting('about')->getUrl() ?>">Über Sally</a></li>
				<li><a href="<?= FrontendHelper::getSetting('imprint')->getUrl() ?>">Impressum</a></li>
			</ul>
		</div>
	</div>
	<div id="navigation"><?= FrontendHelper::getNavigationHTML() ?></div>
	<div id="content"><?= $article->getArticle('main') ?></div>
	<div id="footer">
		<ul>
			<li><a href="<?= sly_Core::getCurrentArticle()->getUrl() ?>#logo">Nach Oben</a></li>
			<li><a href="<?= FrontendHelper::getSetting('contact')->getUrl() ?>">Kontakt</a></li>
			<li><a href="<?= FrontendHelper::getSetting('about')->getUrl() ?>">Über Sally</a></li>
			<li><a href="<?= FrontendHelper::getSetting('imprint')->getUrl() ?>">Impressum</a></li>
		</ul>
	</div>
</div>
<? FrontendHelper::printFooter() ?>
