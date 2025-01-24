<?php

// We always work with UTF8 encoding
mb_internal_encoding('UTF-8');

// Make sure we have a timezone set
date_default_timezone_set('Europe/Paris');

// Load all constants for the application
require_once __DIR__ . '/constants.php';

// Load GitHub integration settings but not with the built-in dev server
if (PHP_SAPI != 'cli-server') {
    if (! file_exists(CONFIG . 'settings.inc.php')) {
        die('File app/config/settings.inc.php is missing. Please check your configuration.');
    }
    require CONFIG . 'settings.inc.php';
}

// Autoloading of classes (both /vendor and /classes)
require_once INSTALL_ROOT . 'vendor/autoload.php';
