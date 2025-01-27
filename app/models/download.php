<?php

use Nightly\Version;
use Json\Json;

// No platform, no download
if (! isset($_GET['os'])) {
    header('Location: /');
    exit;
}

$os = $_GET['os'];
// We only accept a limited set of values
if (! in_array($_GET['os'], ['win32', 'win64', 'lin32', 'lin64', 'macos']))  {
    $os = 'unknown';
}

$stats_file = INSTALL_ROOT . 'data/stats.json';
$json_obj = new Json($stats_file);
if (file_exists($stats_file)) {
    $stats = $json_obj->fetchContent();
} else {
    $stats = [
        'year' => [
            date('Y') => [
                'month' => [
                    date('m') => 0,
                ],
                'os' => [
                    'win32'   => 0,
                    'win64'   => 0,
                    'lin32'   => 0,
                    'lin64'   => 0,
                    'macos'   => 0,
                    'unknown' => 0,
                ],
        ],
        ],
    ];
}

// Increment our stats per OS in the year
$stats['year'][date('Y')]['os'][$os] = $stats['year'][date('Y')]['os'][$os] + 1;

// Increment our stats per period
$stats['year'][date('Y')]['month'][date('m')] = $stats['year'][date('Y')]['month'][date('m')] + 1;

$json_obj->saveFile($stats, $stats_file, true);

// If we don't know the OS, download win64
if ($os == 'unknown') {
    $os = 'win64';
}

// Start the download, prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Location: ' . (new Version)->getFirefoxLinks()[$os], true, 302);
exit;