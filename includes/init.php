<?php
ob_start();
session_start();

require_once ('includes/config.php');

// load database settings
require_once (ROOT_PATH.'/includes/database.php');


// load classes as needed
function __autoload($class) {
	$class = strtolower($class);

	$classpath = ROOT_PATH.'/includes/classes/' .$class . '.class.php';
		require_once $classpath;

}
// loads users class for all pages, needed for confirming login etc
$users = new Users($db);