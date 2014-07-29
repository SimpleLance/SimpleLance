<?php
// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');
// instantiate projects class
$projects = new Projects($db);
// pulls project details if valid project
if (isset($_GET['id']) && empty($_GET['id']) === false) {
    $id = htmlentities($_GET['id']);
    $project_details = $projects->get_project($id);
    $task = $projects->list_project_tasks($id);
    $note = $projects->list_project_notes($id);
}

// allow acces only to admin or customer
if ($_SESSION['access_level'] == '1' || $_SESSION['id'] == $project_details['owner']) {
// allow page to continue loading
} else {
    header('Location: /access-denied.php');
    exit();
}

if (isset($_GET['close']) && $_GET['close'] == 'true') {
    $projects->close_project($id);
    header('Location: /projects/add_details.php?id='.$id.'');
}
?>
<!-- html -->
<br><br>
    <?php
    // display any errors
    if (!empty($errors)) {
        echo '<p>' . implode('</p><p>', $errors) . '</p>';
    }
    ?>
    <div class="row">
        <div class="form-group col-lg-12">
            <b>Project Name</b><br>
            <?php echo htmlentities($project_details['name']); ?>
        </div>
        <div class="form-group col-lg-12">
            <b>Description</b><br>
            <?php echo htmlentities($project_details['description']); ?>
        </div>
        <div class="form-group col-lg-12">
            <b>Owner</b><br>
            <?php echo $users->get_user($project_details['owner'])['first_name'].' '.$users->get_user($project_details['owner'])['last_name']; ?>
        </div>
        <div class="form-group col-lg-12">
            <b>Status</b><br>
            <?php echo htmlentities($project_details['status']); ?>
        </div>
    </div>
    <div class="row col-md-12 col-md-offset-0 custyle">
        <table class="table table-striped custab">
            <thead>
            <tr>
                <th>Task</th>
                <th>Created On</th>
                <th>Status</th>
                <th>Edit</th>
            </tr>
            </thead>
            <?php
            foreach ($task as $t) { ?>
                <tr>
                    <td><?php echo htmlentities($t['name']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($t['created_on'])); ?></td>
                    <td><?php echo htmlentities($t['status']); ?></td>
                    <td><a href="/projects/task/edit.php?id=<?php echo htmlentities($t['id']); ?>">Edit</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="row col-md-12 col-md-offset-0 custyle">
        <table class="table table-striped custab">
            <thead>
            <tr>
                <th>Title</th>
                <th>Created On</th>
                <th>Edit</th>
            </tr>
            </thead>
            <?php
            foreach ($note as $n) { ?>
                <tr>
                    <td><?php echo htmlentities($n['title']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($n['created_on'])); ?></td>
                    <td><a href="/projects/note/edit.php?id=<?php echo htmlentities($n['id']); ?>">Edit</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a href="/projects/task/add.php/?project_id=<?php echo $_GET['id']; ?>">New Task</a></li>
            <li><a href="/projects/note/add.php/?project_id=<?php echo $_GET['id']; ?>">New Note</a></li>
            <?php if ($_SESSION['access_level'] == '1') { ?>
            <li class="divider"></li>
            <li><a href="/projects/edit.php?id=<?php echo $_GET['id']; ?>">Edit Project</a></li>
            <li><a href="/projects/details.php?id=<?php echo $_GET['id']; ?>&close=true">Close Project</a></li>
            <li><a href="/projects/delete.php?id=<?php echo $_GET['id']; ?>" onclick="return confirm('Are you sure?')">Delete Project</a></li>
            <?php } ?>
        </ul>
    </div>

<!-- /html -->
<?php
// include footer
include(ABS_PATH . '/includes/template/footer.php');
?>