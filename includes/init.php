<?php
ob_start();
session_start();

// define absolute server path
define('ABS_PATH', $_SERVER['DOCUMENT_ROOT']);

// load database settings
require_once (ABS_PATH.'/includes/database.php');


// load classes as needed
function __autoload($class) {
	$class = strtolower($class);
	$class = ABS_PATH.'/includes/classes/'.$class.'.class.php';
	require_once ($class);

}
// loads users class for all pages, needed for confirming login etc
$users = new Users($db);