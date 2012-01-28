<?php
/**
 * @sly name  redirect
 * @sly title Weiterleitung
 */

$url = trim($values->get('url'));
$id  = (int) $values->get('article');

if ($id && sly_Util_Article::exists($id)) {
	$mode = 'internal';
}
elseif (!empty($url) && $url !== 'http://') {
	$mode = 'external';
}
else {
	$mode = 'none';
}

// Im Backend zeigen wir die Weiterleitung nur an, führen sie aber nicht aus.

if (sly_Core::isBackend()) {
	switch ($mode) {
		case 'internal':
			$article = sly_Util_Article::findById($id);
			$url     = $article->getUrl();
			?>
			Der Besucher wird zum Artikel <strong><?php echo sly_html($article->getName()) ?></strong> weitergeleitet.<br />
			(Diesen Artikel <a href="../<?php echo $url ?>" target="_blank">im Browser aufrufen</a> oder
			<a href="index.php?page=content&amp;article_id=<?php echo $id ?>">bearbeiten</a>)
			<?php

			break;

		case 'external':
			?>Der Besucher wird zur URL <strong><a href="<?php echo sly_html($url) ?>" class="sly-blank"><?php echo sly_html($url) ?></a></strong> weitergeleitet.<?php
			break;

		case 'none':
		default:
			?>
			<span style="color:red">Es wurde keine gültige Auswahl getroffen.</span>
			<?php
	}
}

// Im Frontend zeigen wir die Weiterleitung an und führen sie aus.

elseif ($mode !== 'none') {
	$target = $mode === 'internal' ? $id : $url;
	sly_Util_HTTP::redirect($target, array(), 'Sie werden weitergeleitet...', 301);
}

// Warnung auslösen, wenn keine gültige URL ermittelt wurde.

else {
	trigger_error('Keine Ziel-URL in Weiterleitung ausgewählt.', E_USER_WARNING);
}
