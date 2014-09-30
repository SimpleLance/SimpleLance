<?php
// include header
include $_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php';
// instantiate projects class
$projects = new \SimpleLance\Projects($db);
// pulls project details if valid project
if (isset($_GET['id']) && empty($_GET['id']) === false) {
    $id = htmlentities($_GET['id']);
    $note_details = $projects->get_note($id);
}
// update database
if (isset($_POST['submit'])) {

    $title = trim($_POST["title"]);
    $details = trim($_POST["details"]);

    if (empty($title) || empty($details)) {
        $errors[] = 'All fields are required!';
    }

    if (empty($errors) == TRUE) {
        $projects->update_note($title, $details, $id);
        header('Location: /projects/details.php?id='.$note_details['project'].'');
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
				<label for="title">Project Name</label><br>
				<input type="text" name="title" id="title" value="<?php echo htmlentities($note_details['title']); ?>">
		 	</div>
		 	<div class="form-group col-lg-12">
				<label for="details">Description</label><br>
                <textarea rows="5" cols="50" name="details" id="details"><?php echo htmlentities($note_details['details']); ?></textarea>
		 	</div>
		    <div class="form-group col-lg-6">
				<button class="btn btn-primary pull-right" name="submit" type="submit">Edit Note</button>
			</div>
		</div>
	</form>
	<!-- /user entry form -->
<!-- /html -->
<?php
// include footer
include ABS_PATH . '/includes/template/footer.php';
?>
