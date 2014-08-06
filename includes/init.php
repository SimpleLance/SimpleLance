<?php
ob_start();
session_start();
// define absolute server path
define('ABS_PATH', $_SERVER['DOCUMENT_ROOT']);
// checks to see if a dev config file exists and if does, loads it
if(file_exists(ABS_PATH.'/includes/.dev.config.php')){
    require_once(ABS_PATH.'/includes/.dev.config.php');
} else { // if no dev config file found loads main config
    require_once(ABS_PATH.'/includes/config.php');
}
// load database settings
require_once (ABS_PATH.'/includes/database.php');
// load composer libs
require (ABS_PATH . '/vendor/autoload.php');
// loads users class for all pages, needed for confirming login etc
$users = new \SimpleLance\Users($db);