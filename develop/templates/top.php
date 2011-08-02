<?php
/**
 * @sly name  top
 * @sly active false
 */
?>
<div id="page">
	<div id="container">

		<div id="topline">
			<p>Das Sally CMS &ndash; gut bedienbare und professionelle Webseiten</p>
			<ul>
				<li><a href="<?= FrontendHelper::getSetting('contact')->getUrl() ?>">Kontakt</a></li>
				<li><a href="<?= FrontendHelper::getSetting('about')->getUrl() ?>">Über Sally</a></li>
				<li><a href="<?= FrontendHelper::getSetting('imprint')->getUrl() ?>">Impressum</a></li>
			</ul>
		</div>

		<div id="header">
			<a href="<?= FrontendHelper::getMainArticleURL() ?>" id="logo">
				<img src="assets/images/logo.png" alt="<?= sly_html(sly_Core::getProjectName()) ?>" />
			</a>

			<div id="claim">
				<h1>Was immer Sie über Sally wissen mögen ...</h1>
				<span>... können wir in einigen Sätzen erklären. Oder Bildern.</span>
			</div>
		</div>

		<div id="main">
			<div id="navigation"><?= FrontendHelper::getNavigationHTML() ?></div>