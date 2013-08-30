<?php
/**
 * @sly name partials.top
 */

$self       = sly_Core::getCurrentArticle();
$keyvisuals = $self->getType() === 'start' ? $self->getMeta('keyvisuals') : null;

?>
<div id="page" class="<?php print $self->getType() ?>">
	<div id="container">
		<div id="topline">
			<p>Das Sally CMS &ndash; gut bedienbare und professionelle Webseiten</p>
			<ul>
				<li><a href="<?php echo FrontendHelper::getSetting('contact', $self)->getUrl() ?>">Kontakt</a></li>
				<li><a href="<?php echo FrontendHelper::getSetting('about', $self)->getUrl() ?>">Über Sally</a></li>
				<li><a href="<?php echo FrontendHelper::getSetting('images', $self)->getUrl() ?>">Bildnachweise</a></li>
			</ul>
		</div>
		<?php
			if (!empty($keyvisuals)) {
				sly_Util_Template::render('partials.keyvisuals', compact('keyvisuals'));
			}
		?>
		<div id="header">
			<a href="<?php echo FrontendHelper::getMainArticleURL() ?>" id="logo">
				<img src="assets/images/logo.png" alt="<?php echo sly_html(sly_Core::getProjectName()) ?>" />
			</a>

			<div id="claim">
				<h1>Was immer Sie über Sally wissen mögen ...</h1>
				<span>... können wir in einigen Sätzen erklären. Oder Bildern.</span>
			</div>
		</div>

		<div id="main">
			<div id="navigation"><?php echo FrontendHelper::getNavigationHTML() ?></div>
