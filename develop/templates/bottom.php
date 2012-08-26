<?php
/**
 * @sly name bottom
 */

$self = sly_Core::getCurrentArticle();

?>
		</div>
	</div>
	<div id="footer">
		<ul>
			<li><a href="<?php echo $self->getUrl() ?>#">nach oben</a></li>
			<li><a href="<?php echo FrontendHelper::getSetting('contact', $self)->getUrl() ?>">Kontakt</a></li>
			<li><a href="<?php echo FrontendHelper::getSetting('about', $self)->getUrl() ?>">Über Sally</a></li>
			<li><a href="<?php echo FrontendHelper::getSetting('imprint', $self)->getUrl() ?>">Impressum</a></li>
		</ul>
	</div>
</div>
