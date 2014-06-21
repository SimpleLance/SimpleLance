<?php

// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');
// only allow access to admins
if ($_SESSION['access_level'] !== '1') {
    header('Location: /access-denied.php');
    exit();
}
// instantiate projects class
$projects = new Projects($db);
// pulls project details if valid project
if (isset($_GET['id']) && empty($_GET['id']) === false) {
    $id = htmlentities($_GET['id']);
    $project_details = $projects->get_project($id);
}
// update database
if (isset($_POST['submit'])) {

    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $owner = trim($_POST["owner"]);
    $status = trim($_POST["status"]);


    if (empty($name) || empty($description) || empty($owner) || empty($status)) {
        $errors[] = 'All fields are required!';
    }

    if (empty($errors) == TRUE){
        $projects->update_project($name, $description, $owner, $status, $id);
        header('Location: /projects/details.php?id='.$id.'');
        exit();
    }
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
	<!-- user entry form -->
	<form class="well span6" role="form" action='' method='post'>
		<div class="row">
			<div class="form-group col-lg-12">
				<label for="name">Project Name</label><br>
				<input type="text" name="name" id="name" value="<?php echo htmlentities($project_details['name']); ?>">
		 	</div>
		 	<div class="form-group col-lg-12">
				<label for="description">Description</label><br>
                <textarea rows="5" cols="50" name="description" id="description"><?php echo htmlentities($project_details['description']); ?></textarea>
		 	</div>
            <div class="form-group col-lg-12">
                <label for="owner">Owner</label><br>
                <select name="owner" id="owner">
                    <?php
                    foreach ($users->get_users() as $user){
                        $user_selected = $users->get_user($project_details['owner']);
                        if ($user['id'] === $project_details['owner']) {
                            $selected = "selected='selected'";
                        } else {
                            $selected = null;
                        }
                        echo "<option value='".$user['id']."' ".$selected.">".$user['first_name'].' '.$user['last_name']."</option>";
                    }
                    ?>
                </select>
            </div>
		 	<div class="form-group col-lg-12">
				<label for="status">Status</label><br>
                <select name="status" id="status">
                    <option value="Open" <?php if($project_details['status'] == 'Open') {echo "selected='selected'"; } ?>>Open</option>
                    <option value="In Progress" <?php if($project_details['status'] == 'In Progress') {echo "selected='selected'"; } ?>>In Progress</option>
                    <option value="On Hold" <?php if($project_details['status'] == 'On Hold') {echo "selected='selected'"; } ?>>On Hold</option>
                    <option value="Closed" <?php if($project_details['status'] == 'Closed') {echo "selected='selected'"; } ?>>Closed</option>
                </select>
		 	</div>
		    <div class="form-group col-lg-6">
				<button class="btn btn-primary pull-right" name="submit" type="submit">Edit Project</button>
			</div>
		</div>
        <a href="/projects/delete.php?id=<?php echo $_GET['id']; ?>" onclick="return confirm('Are you sure?')">Delete Project</a>
	</form>
	<!-- /user entry form -->
<!-- /html -->
<?php
// include footer
include(ABS_PATH . '/includes/template/footer.php');
?>