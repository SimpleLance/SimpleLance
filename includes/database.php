<?php
// include configuration file
require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/config.php');

// setup db connection
$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
