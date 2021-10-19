<?php

declare(strict_types=1);

namespace Naja\Guide;

if (\PHP_SAPI !== 'cli-server') {
	throw new \RuntimeException('The internalServer.php can only be used with the built-in development server.');
}

// fix for https://bugs.php.net/bug.php?id=61286
if ( ! isset($_SERVER['PATH_INFO'])) {
	$_SERVER['SCRIPT_NAME'] = '/index.php';
	$_SERVER['SCRIPT_FILENAME'] = __FILE__;
	$_SERVER['PATH_INFO'] = $_SERVER['REQUEST_URI'];
	$_SERVER['PHP_SELF'] = $_SERVER['SCRIPT_NAME'] . $_SERVER['REQUEST_URI'];
}

// serve static files directly
if (\file_exists(__DIR__ . $_SERVER['PATH_INFO'])) {
	return false;
}

require __DIR__ . '/index.php';
