<?php
// initialise script
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/init.php');

// only allow access to admins
if ($_SESSION['access_level'] !== '1') {
    header('Location: access-denied.php');
    exit();
}
if (isset($_GET['id']) && empty($_GET['id']) === false) {
    $id = htmlentities($_GET['id']);

    $users->delete_user($id);
    header("Location: /users/?deletesuccess");
    exit();
}
