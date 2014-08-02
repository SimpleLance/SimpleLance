<?php
// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');
// pull users
$user = $users->get_users();
// instantiate projects class
$projects = new \SimpleLance\Projects($db);
$project_id = htmlentities($_GET['project_id']);
if (isset($_POST['submit'])) {

    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $status = trim($_POST["status"]);


    if (empty($name) || empty($description) || empty($status)) {
        $errors[] = 'All fields are required!';
    }

    if (empty($errors) == TRUE){
        $projects->new_task($project_id, $name, $description, $status);
        header('Location: /projects/details.php?id='.$project_id.'');
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
				<label for="name">Task Name</label><br>
				<input type="text" name="name" id="name" value="">
		 	</div>
		 	<div class="form-group col-lg-12">
				<label for="description">Description</label><br>
                <textarea rows="5" cols="50" name="description" id="description"></textarea>
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
				<button class="btn btn-primary pull-right" name="submit" type="submit">Add Task</button>
			</div>
		</div>		
	</form>
	<!-- /user entry form -->
<!-- /html -->
<?php
// include footer
include(ABS_PATH . '/includes/template/footer.php');
?>