<?php
/**
 * Weiterleitungsmodul
 *
 * Dieses Modul vereint sowohl interne als auch externe Weiterleitungen in einem.
 * Je nach Kunde kann jedoch die verfügbare Weiterleitungsart eingeschränkt
 * werden, indem in beiden Modulteilen (!) die Variable $mode auf
 *
 *  - external für nur externe Weiterleitungen,
 *  - internal für nur interne Weiterleitungen oder
 *  - both für beide (interne priorisiert)
 *
 * gesetzt wird.
 *
 * @author   Christoph
 * @version  2.0 vom 17.04.09
 * @required true
 *
 * @sly  name   redirect
 * @sly  title  Weiterleitung
 */

if (empty($REX['LUCENE_IS_RUNNING'])) {
	$mode = 'internal'; // internal, external oder both
	$url  = trim('REX_VALUE[1]');
	$id   = (int) 'REX_LINK_ID[1]';

	// Je nach vorhandenen Daten kann sich der Modus noch einmal ändern / spezifieren.

	if (!empty($id) && $mode != 'external') {
		$mode = 'internal';
	}
	elseif (!empty($url) && $url != 'http://' && $mode != 'internal') {
		$mode = 'external';
	}
	else {
		$mode = 'none';
	}

	// Im Backend zeigen wir die Weiterleitung nur an, führen sie aber nicht aus.

	if (sly_Core::isBackend()) {
		?><div class="wvModule"><?php

		switch ($mode) {
			case 'internal':

				$article = sly_Util_Article::findById($id);

				if ($article) {
					$url = $article->getUrl();
					?>
					<label>Zielartikel</label>
					Der Besucher wird zum Artikel <strong><?= sly_html($article->getName()) ?></strong> weitergeleitet.<br />
					(Diesen Artikel <a href="../<?= $url ?>" target="_blank">im Browser aufrufen</a> oder
					<a href="index.php?page=content&amp;article_id=<?= $id ?>">bearbeiten</a>)
					<?php
				}
				else {
					?>
					<label>Zielartikel</label>
					<span style="color:red">Der Zielartikel (ID <?= $id ?>) existiert nicht (mehr).</span>
					<?php
				}

				break;

			case 'external':

				?>
				<label>Ziel-URL</label>
				Der Besucher wird zur URL
				<a href="<?= sly_html($url) ?>" target="_blank"><?= sly_html($url) ?></a>
				weitergeleitet.
				<?php

				break;

			case 'none':
			default:

				?>
				<label>Fehler</label>
				<span style="color:red">Es wurde keine gültige Auswahl getroffen.</span>
				<?php
		}

		?></div><?php
	}

	// Im Frontend zeigen wir die Weiterleitung an und führen sie aus (Location-Header).

	else {
		if ($mode == 'internal') {
			$article = sly_Util_Article::findById($id);
			$url     = $article ? $article->getUrl() : '';
		}

		if (!empty($url)) {
			WV_Sally::clearOutput();

			// Auf realurl-Implementierungen achten: Diese geben immer
			// relative URLs zurück, die über das <base>-Tag vom Browser
			// automatisch in den richtigen Kontext gesetzt werden. Da es
			// hier aber kein <base> gibt, schlägt ein Redirect fehl, wenn
			// der Besucher sich bereits in einer Kategorie befindet.

			$prefix = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\').'/';

			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$prefix.str_replace('&amp;', '&', $url));
			print '<p>Weiterleitung zu: <a href="'.$prefix.$url.'">'.$url.'</a><p>';

			if ($mode != 'internal') {
				print '<script type="text/javascript">window.open("'.$prefix.$url.'", "_blank");</script>';
			}

			exit;
		}
		else {
			trigger_error('Contentproblem: Ungültige Ziel-URL in Weiterleitung ausgewählt.', E_USER_WARNING);
		}
	}
}

?>
