<?php

switch ($url['path']) {
    case $webroot_folder:
        $model = $view = 'home';
        break;
    case "{$webroot_folder}a-propos":
        $view = 'about';
        break;
    case "{$webroot_folder}participer":
        $view = 'contribute';
        break;
    case "{$webroot_folder}stats":
        $model = 'stats';
        break;
    default:
        $view = '404';
        break;
}

if (isset($model)) {
    include MODELS . $model . '.php';
}

if (isset($view)) {
    include VIEWS . $view . '.php';
}
