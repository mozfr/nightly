<?php

switch ($url['path']) {
    case '/':
        $model = $view = 'home';
        break;
    case '/a-propos':
        $view = 'about';
        break;
    case '/participer':
        $view = 'contribute';
        break;
    case '/download':
        $model = 'download';
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
