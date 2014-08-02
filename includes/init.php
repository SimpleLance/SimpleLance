<?php
ob_start();
session_start();
// define absolute server path
define('ABS_PATH', $_SERVER['DOCUMENT_ROOT']);
// include configuration file
require_once(ABS_PATH.'/includes/config.php');
// load database settings
require_once (ABS_PATH.'/includes/database.php');
// load composer libs
require (ABS_PATH . '/vendor/autoload.php');
// loads users class for all pages, needed for confirming login etc
$users = new \SimpleLance\Users($db);