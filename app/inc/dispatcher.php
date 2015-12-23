<?php

switch ($url['path']) {
    case '/':
        $model = $view = 'home';
        break;
    case 'a-propos':
        $model = $view = 'about';
        break;
    case 'participer':
        $model = $view = 'contribute';
        break;
    case 'stats':
        $model = 'stats';
        break;
    default:
        $model = $view = 'home';
        break;
}

if (isset($model))
    include MODELS . $model . '.php';

if (isset($view))
    include VIEWS . $view . '.php';
