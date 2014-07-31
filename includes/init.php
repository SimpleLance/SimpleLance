<?php
ob_start();
session_start();

// define absolute server path
define('ABS_PATH', $_SERVER['DOCUMENT_ROOT']);

// include configuration file
require_once(ABS_PATH.'/includes/config.php');

// load database settings
require_once (ABS_PATH.'/includes/database.php');


// load classes as needed
function __autoload($class) {
	$class = strtolower($class);
	$class = ABS_PATH.'/includes/classes/'.$class.'.class.php';
	require_once ($class);

}
// load stripe
require_once(ABS_PATH . '/includes/lib/Stripe.php');
Stripe::setApiKey($stripe['secret_key']);
// loads users class for all pages, needed for confirming login etc
$users = new Users($db);