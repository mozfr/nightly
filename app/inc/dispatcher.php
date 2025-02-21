<?php

switch ($url['path']) {
    case '/':
        $model = $view = 'home';
        break;
    case '/a-propos':
        $view = 'about';
        break;
    case '/download':
        $model = 'download';
        break;
    case '/participer':
        $view = 'contribute';
        break;
        break;
    case '/stats':
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
