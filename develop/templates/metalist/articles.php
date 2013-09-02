<?php
/**
 * @sly name metalist.articles
 */

if (!empty($articles)) {
	print '<div class="newslist"><ul>';

	$be       = sly_Core::isBackend();
	$curArtID = sly_Core::getCurrentArticleId();
	$params   = array('origin' => $curArtID);
	$first    = ' first';

	if (!$be) {
		// add additional CSS code
		Project::getLayout()->addCSSFile('assets/css/newslist.less');
	}

	// only the backend app has a publibly available router instance
	if ($be) {
		$router = sly_Core::getContainer()->get('sly-app')->getRouter();
	}

	foreach ($articles as $article) {
		$name = $article->getName();

		// just list the article names in backend and show teaser in frontend
		if ($be) {
			$url = $router->getUrl('content', null, array('article_id' => $article->getId(), 'clang' => $article->getClang()));

			?>
			<li>
				<a href="<?php print $url ?>"><?php print sly_html($name) ?></a>
			</li>
			<?php
		}
		else {
			$date    = $article->getMeta('date');
			$date    = $date ? date('d.m.Y', $date) : '';
			$url     = $article->getUrl($params);
			$content = $article->getContent();
			$teaser  = sly_Util_String::cutText($content, 250, ' <a href="'.$url.'">&hellip; zum Artikel</a>');

			?>
			<li>
				<div class="title<?php print $first ?>">
					<a href="<?php print $url ?>"><?php print sly_html($name) ?></a>
					<span><?php print $date ?></span>
				</div>
				<div class="teaser"><?php print $teaser ?></div>
			</li>
			<?php
		}

		$first = '';
	}

	print '</ul></div>';
}
