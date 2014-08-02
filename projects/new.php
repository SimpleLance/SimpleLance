<?php

// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');
// only allow access to admins
if ($_SESSION['access_level'] !== '1') {
    header('Location: /access-denied.php');
    exit();
}
// pull users
$user = $users->get_users();
// instantiate projects class
$projects = new \SimpleLance\Projects($db);
if (isset($_POST['submit'])) {

    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $owner = trim($_POST["owner"]);
    $status = trim($_POST["status"]);


    if (empty($name) || empty($description) || empty($owner) || empty($status)) {
        $errors[] = 'All fields are required!';
    }

    if (empty($errors) == TRUE){
        $projects->new_project($name, $description, $owner, $status);
        header('Location: /projects/?addsuccess');
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
	<form class="well span6" role="form" action='' method='post'>
		<div class="row">
			<div class="form-group col-lg-12">
				<label for="name">Project Name</label><br>
				<input type="text" name="name" id="name" value="">
		 	</div>
		 	<div class="form-group col-lg-12">
				<label for="description">Description</label><br>
                <textarea rows="5" cols="50" name="description" id="description"></textarea>
		 	</div>
            <div class="form-group col-lg-12">
                <label for="owner">Owner</label><br>
                <select name="owner" id="owner">
                    <option value=""></option>
                    <?php foreach ($user as $u) {
                        echo "<option value='".$u['id']."'>".$u['first_name'].' '.$u['last_name']."</option>";
                    } ?>
                </select>
            </div>
		 	<div class="form-group col-lg-12">
				<label for="status">Status</label><br>
                <select name="status" id="status">
                    <option value=""></option>
                    <option value="Open">Open</option>
                    <option value="In Progress">In Progress</option>
                    <option value="On Hold">On Hold</option>
                    <option value="Closed">Closed</option>
                </select>
		 	</div>
		    <div class="form-group col-lg-6">
				<button class="btn btn-primary pull-right" name="submit" type="submit">Add Project</button>
			</div>
		</div>		
	</form>
<?php
// include footer
include(ABS_PATH . '/includes/template/footer.php');
?>