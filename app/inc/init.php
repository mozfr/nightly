<?php

// We always work with UTF8 encoding
mb_internal_encoding('UTF-8');

// Make sure we have a timezone set
date_default_timezone_set('Europe/Paris');

// Load all constants for the application
require_once __DIR__ . '/constants.php';

// Load settings
$settings_file = CONFIG . '/settings.inc.php';
if (! file_exists($settings_file)) {
    die('File app/config/settings.inc.php is missing. Please check your configuration.');
}
require $settings_file;

// Autoloading of classes (both /vendor and /classes)
require_once INSTALL_ROOT . 'vendor/autoload.php';
