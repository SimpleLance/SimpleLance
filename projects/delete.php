<?php
// initialise script
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/init.php');
// instantiate projects class
$project = new Projects($db);
if ($_SESSION['access_level'] !== '1') {
    header('Location: /access-denied.php');
    exit();
}
if (isset($_GET['id']) && empty($_GET['id']) === false) {
    $id = htmlentities($_GET['id']);

    $project->delete_project($id);
    $project->delete_project_notes($id);
    $project->delete_project_tasks($id);
    header("Location: /projects/");
    exit();
}
