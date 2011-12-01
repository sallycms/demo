<?php
/**
 * @sly name  bottom
 * @sly active false
 */
?>
		</div>
	</div>
	<div id="footer">
		<ul>
			<li><a href="<?= sly_Core::getCurrentArticle()->getUrl() ?>#">nach oben</a></li>
			<li><a href="<?= FrontendHelper::getSetting('contact')->getUrl() ?>">Kontakt</a></li>
			<li><a href="<?= FrontendHelper::getSetting('about')->getUrl() ?>">Über Sally</a></li>
			<li><a href="<?= FrontendHelper::getSetting('imprint')->getUrl() ?>">Impressum</a></li>
		</ul>
	</div>
</div>
