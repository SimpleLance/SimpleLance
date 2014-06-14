<?php
// initialise script
include('includes/template/header.php');
// only allow access to admins
/*if ($_SESSION['access_level'] !== '1') {
    header('Location: access-denied.php');
    exit();
} */
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
            <div class="form-group col-lg-6">
                <label for="email">Email Address</label><br>
                <input type="text" name="email" id="email" value="<?php if (isset($_POST['email'])) echo htmlentities($_POST['email']); ?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" value="<?php if (isset($_POST['password'])) echo htmlentities($_POST['password']); ?>">
            </div>
		 	<div class="form-group col-lg-6">
				<label for="first_name">First Name</label><br>
				<input type="text" name="first_name" id="first_name" value="<?php if (isset($_POST['first_name'])) echo htmlentities($_POST['first_name']); ?>">
		 	</div>
		 	<div class="form-group col-lg-6">
                <label for="last_name">Last Name</label><br>
                <input type="text" name="last_name" id="last_name" value="<?php if (isset($_POST['last_name'])) echo htmlentities($_POST['last_name']); ?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="display_name">Display Name</label><br>
                <input type="text" name="display_name" id="display_name" value="<?php if (isset($_POST['display_name'])) echo htmlentities($_POST['display_name']); ?>">
            </div>
		 	<div class="form-group col-lg-6">
				<label for="access_level">Access level</label><br>
				<select name="access_level">
			        <option value="1">Admin</option>
			        <option value="2">Customer</option>
			    </select> 
		 	</div>
		 		<div class="form-group col-lg-6">
					<button class="btn btn-primary pull-right" name="submit" type="submit">Add User</button>
				</div>	
		</div>		
	</form>
	<!-- /user entry form -->
<!-- /html -->
<?php
// include footer
include('includes/template/footer.php');

if (isset($_POST['submit'])) {

    $email = trim($_POST["email"]);
	$first_name = trim($_POST["first_name"]);
	$last_name = trim($_POST["last_name"]);
    $display_name = trim($_POST["display_name"]);
	$password = trim($_POST["password"]);
	$access_level = trim($_POST["access_level"]);

	if (empty($email) || empty($first_name) || empty($last_name) || empty($display_name) || empty($password) || empty($access_level)) {
		$errors[] = 'All fields are required!';
	} else {
		if ($users->user_exists($email) == TRUE) {
			$errors[] = 'That username already exists';
		}
		if (strlen($password) < 8) {
			$errors[] = 'Password must be at least 8  characters long';
		}
		if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
			$errors[] = 'Please enter a valid email address';
		}
	}

	if (empty($errors) == TRUE){
		$users->register($email, $first_name, $last_name, $display_name, $password, $access_level);
		header('Location: users-list.php?addsuccess');
		exit();
	}
}

?>