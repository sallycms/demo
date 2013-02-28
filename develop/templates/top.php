<?php
/**
 * @sly name top
 */

$self = sly_Core::getCurrentArticle();
?>
<div id="page" class="<?php print sly_Core::getCurrentArticle()->getType(); ?>">
	<div id="container">

		<div id="topline">
			<p>Das Sally CMS &ndash; gut bedienbare und professionelle Webseiten</p>
			<ul>
				<li><a href="<?php echo FrontendHelper::getSetting('contact', $self)->getUrl() ?>">Kontakt</a></li>
				<li><a href="<?php echo FrontendHelper::getSetting('about', $self)->getUrl() ?>">Über Sally</a></li>
				<li><a href="<?php echo FrontendHelper::getSetting('imprint', $self)->getUrl() ?>">Impressum</a></li>
			</ul>
		</div>
		<?php
			if ($self->getType()=="start") {

				$keyvisual   = $self->getMeta('keyvisual');
				$resize      = sly_Util_AddOn::isAvailable('sallycms/image-resize');
				$html_id     = count($keyvisual) != 1 ? 'id="keyvisual"' : "";

				print '<div '.$html_id.'>';
				$image_width = "905"; $image_height = "200";
				$image_source = $resize ? 'imageresize/c'.$image_width.'w__c'.$image_height.'h__u__' : 'data/mediapool/';
				foreach ($keyvisual as $media) {
					print '<div><img src="'.$image_source.$media.'" alt="" /></div>';
					$image_class = "";
				}
				print '</div>';
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
