<?php
// initialise script
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/init.php');
// instantiate tickets class
$tickets = new Tickets($db);
if ($_SESSION['access_level'] !== '1') {
    header('Location: /access-denied.php');
    exit();
}
if (isset($_GET['id']) && empty($_GET['id']) === false) {
    $id = htmlentities($_GET['id']);

    $tickets->delete_ticket($id);
    header("Location: /support/");
    exit();
}
