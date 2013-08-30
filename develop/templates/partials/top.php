<?php
/**
 * @sly name partials.top
 */

$keyvisuals = $self->getType() === 'start' ? $self->getMeta('keyvisuals') : null;

?>
<div id="page" class="<?php print $self->getType() ?>">
	<div id="container">
		<div id="topline">
			<p>Das Sally CMS &ndash; gut bedienbare und professionelle Webseiten</p>
			<ul>
				<li><a href="<?php print Settings::url('contact') ?>">Kontakt</a></li>
				<li><a href="<?php print Settings::url('about') ?>">Über Sally</a></li>
				<li><a href="<?php print Settings::url('images') ?>">Bildnachweise</a></li>
			</ul>
		</div>
		<?php
			if (!empty($keyvisuals)) {
				sly_Util_Template::render('partials.keyvisuals', compact('keyvisuals'));
			}
		?>
		<div id="header">
			<a href="<?php print Project::getMainArticleURL() ?>" id="logo">
				<img src="assets/images/logo.png" alt="<?php print sly_html(Project::getName()) ?>" />
			</a>

			<div id="claim">
				<h1>Was immer Sie über Sally wissen mögen ...</h1>
				<span>... können wir in einigen Sätzen erklären. Oder Bildern.</span>
			</div>
		</div>

		<div id="main">
			<div id="navigation"><?php print Project::getNavigation()->getNavigationHTMLString() ?></div>
