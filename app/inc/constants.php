<?php

// Constants for the project
define('INSTALL_ROOT',  realpath('../') . '/');

const WEB_ROOT = INSTALL_ROOT . 'web/';
const APP_ROOT = INSTALL_ROOT . 'app/';
const CONFIG   = APP_ROOT . 'config/';
const INC      = APP_ROOT . 'inc/';
const VIEWS    = APP_ROOT . 'views/';
const MODELS   = APP_ROOT . 'models/';
// Cache class
const CACHE_PATH    = INSTALL_ROOT . 'cache/';
const CACHE_TIME    =  7200;
const CACHE_ENABLED = true;