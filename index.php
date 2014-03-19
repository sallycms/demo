<?php
/*
 * Copyright (c) 2013, webvariants GbR, http://www.webvariants.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

// remove magic_quotes and register_globals side effects
// You can safely remove this if your server is properly configured.
require 'sally/core/request-filter.php';

// determine application from URI
// If you want/need custom app routing (e.g. not have the backend at /backend/),
// copy the file's content here and adjust as necessary.
list ($slyAppName, $slyAppBase) = require 'sally/core/detect-app.php';

// start output buffering
ob_start();
ob_implicit_flush(0);

// boot Core system
$loader    = require 'sally/core/autoload.php';
$container = sly_Core::boot($loader, null, $slyAppName, $slyAppBase);

// boot the requested application
require 'sally/'.$slyAppName.'/boot.php';
