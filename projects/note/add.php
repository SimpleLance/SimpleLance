<?php
// include header
include $_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php';
// pull users
$user = $users->listUsers();
// instantiate projects class
$projects = new \SimpleLance\Projects($db);
$project_id = htmlentities($_GET['project_id']);

if (isset($_POST['submit'])) {

    $title = trim($_POST["title"]);
    $details = trim($_POST["details"]);

    if (empty($title) || empty($details)) {
        $errors[] = 'All fields are required!';
    }

    if (empty($errors) == TRUE) {
        $projects->newNote($project_id, $title, $details);
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
				<label for="title">Note Title</label><br>
				<input type="text" name="title" id="title" value="">
		 	</div>
		 	<div class="form-group col-lg-12">
				<label for="details">Note Details</label><br>
                <textarea rows="5" cols="50" name="details" id="details"></textarea>
		 	</div>
		    <div class="form-group col-lg-6">
				<button class="btn btn-primary pull-right" name="submit" type="submit">Add Note</button>
			</div>
		</div>
	</form>
	<!-- /user entry form -->
<!-- /html -->
<?php
// include footer
include ABS_PATH . '/includes/template/footer.php';
?>
