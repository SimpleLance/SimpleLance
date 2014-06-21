<?php
// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');
// instantiate projects class
$projects = new Projects($db);
// load projects
$project = $projects->list_projects();
?>
<!-- html -->

<div class="row col-md-9 col-md-offset-1 custyle">
    <?php
    if (isset($_GET['addsuccess']) && empty($_GET['addsuccess'])) {
        echo '<br><br>Project successfully added.';
    }
    if (isset($_GET['editsuccess']) && empty($_GET['editsuccess'])) {
        echo '<br><br>Project successfully updated.';
    }
    ?>
    <table class="table table-striped custab">
        <thead>
        <tr>
            <th>Name</th>
            <th>Created On</th>
            <th>Customer</th>
            <th>Status</th>
            <th>View</th>
        </tr>
    </thead>
            <?php
                foreach ($project as $p) { ?>
                    <tr>
                        <td><?php echo htmlentities($p['name']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($p['created_on'])); ?></td>
                        <td><?php echo $users->get_user($p['customer'])['first_name'].' '.$users->get_user($p['customer'])['last_name']; ?></td>
                        <td><?php echo htmlentities($p['status']); ?></td>
                        <td><a href="/projects/details.php?id=<?php echo htmlentities($p['id']); ?>">View</a></td>
                    </tr>
            <?php } ?>
    </table>
    </div>


<!-- /html -->
<?php
// include footer
include(ABS_PATH . '/includes/template/footer.php');
?>