<?php
// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');

if (isset($_GET['id']) && empty($_GET['id']) === false) {
	$id = htmlentities($_GET['id']);
	$user_details = array();
	$user_details = $users->get_user($id);
}
if ($_SESSION['access_level'] !== '1' && $_GET['id'] !== $_SESSION['id']) {
    header('Location: /access-denied.php');
    exit();
}
// post updates to db
if (isset($_POST['submit'])) {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $display_name = $_POST["display_name"];
    $password = $_POST["password"];

    $users->update_profile($email, $first_name, $last_name, $display_name, $password,$id);
    header('Location: /users/?editsuccess');
    exit();
}
?>
<br><br>
	<form class="well span6" role="form" action='' method='post'>
		<div class="row">
            <div class="form-group col-lg-6">
                <label for="email">Email Address</label><br>
                <input type="text" name="email" id="email" value="<?php echo $user_details['email'];?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" placeholder="Enter new password to change." value="">
            </div>
		 	<div class="form-group col-lg-6">
				<label for="first_name">First Name</label><br>
				<input type="text" name="first_name" id="first_name" value="<?php echo $user_details['first_name'];?>">
		 	</div>
		 	<div class="form-group col-lg-6">
				<label for="last_name">Last Name</label><br>
				<input type="text" name="last_name" id="last_name" value="<?php echo $user_details['last_name']; ?>">
		 	</div>
            <div class="form-group col-lg-6">
                <label for="display_name">Display Name</label><br>
                <input type="text" name="display_name" id="display_name" value="<?php echo $user_details['display_name']; ?>">
            </div>
	 		<div class="form-group col-lg-6">
				<button class="btn btn-primary pull-right" name="submit" type="submit">Edit User</button>
			</div>	
		</div>		
	</form>
<?php
// include footer
include(ABS_PATH . '/includes/template/footer.php');
?>