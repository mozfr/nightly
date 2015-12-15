<?php

switch ($url['path']) {
    case '/':
    default:
        $page = 'home';
        break;
}

include MODELS . $page . '.php';
include VIEWS . $page . '.php';
