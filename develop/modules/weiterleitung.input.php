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

$mode = 'internal';
$url  = 'REX_VALUE[1]' ? 'REX_VALUE[1]' : 'http://';

?>
<div class="wvModule">
	<? if ($mode == 'both'): ?>
		<label>Beschreibung</label>
		Bitte wählen Sie entweder einen Artikel aus Ihrer Webseite aus oder geben Sie eine
		Ziel-URL ein. Wenn Sie beides eingeben, wird der Artikel bevorzugt.
	<? endif ?>

	<? if ($mode != 'external'): ?>
		<label>Interne Weiterleitung (Zielartikel)</label>
		<span class="help">Zu diesem Artikel wird beim Aufruf dieses Artikels weitergeleitet.</span>
		REX_LINK_BUTTON[1]
	<? endif ?>

	<? if ($mode != 'internal'): ?>
		<label>Externe Weiterleitung (URL)</label>
		<span class="help">Bitte geben Sie die volle URL (mit "http://") ein.</span>
		<input type="text" size="60" name="VALUE[1]" value="<?= sly_html($url) ?>" />
	<? endif ?>
</div>
