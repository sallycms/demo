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
			<li><a href="<?php echo sly_Core::getCurrentArticle()->getUrl() ?>#">nach oben</a></li>
			<li><a href="<?php echo FrontendHelper::getSetting('contact')->getUrl() ?>">Kontakt</a></li>
			<li><a href="<?php echo FrontendHelper::getSetting('about')->getUrl() ?>">Über Sally</a></li>
			<li><a href="<?php echo FrontendHelper::getSetting('imprint')->getUrl() ?>">Impressum</a></li>
		</ul>
	</div>
</div>
