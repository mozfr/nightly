<?php

$url  = parse_url($_SERVER['REQUEST_URI']);
$file = pathinfo($url['path']);

// Don't process non-PHP files, even if they don't exist on the server
if (isset($file['extension']) && $file['extension'] != 'php' && ! $api_url) {
    return false;
}

if ($url['path'] != '/') {
    // Normalize path before comparing the string to list of valid paths
    $url['path'] = explode('/', $url['path']);
    $url['path'] = array_filter($url['path']); // Remove empty items
    $url['path'] = array_values($url['path']); // Reorder keys
    $url['path'] = implode('/', $url['path']);
}

// Include all valid urls here
require_once __DIR__ . '/urls.php';

// Always redirect to an url ending with slashes
$temp_url = parse_url($_SERVER['REQUEST_URI']);
if (substr($temp_url['path'], -1) != '/') {
    unset($temp_url);
    header('Location:/' . $url['path'] . '/');
    exit;
}

// We can now initialize the application and dispatch urls
require_once __DIR__ . '/init.php';
