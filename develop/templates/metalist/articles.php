<?php
/**
 * @sly name  metalist.articles
 */

/*
This template gets included by the Metalist class. It gets the $articles variable
predefined (contains a list of sly_Model_Article objects).
*/

if (!empty($articles)) {
	print '<div class="newslist"><ul>';

	$curArtID = sly_Core::getCurrentArticleId();
	$params   = array('origin' => $curArtID);
	$first    = ' first';
	$be       = sly_Core::isBackend();

	if (!$be) {
		// add additional CSS code
		FrontendHelper::getLayout()->addCSSFile('assets/css/newslist.less');
	}

	foreach ($articles as $article) {
		$name = $article->getName();

		// just list the article names in backend and show teaser in frontend
		if ($be) {
			$url = 'index.php?page=content&amp;article_id='.$article->getId().'&amp;clang='.$article->getClang();

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
