<?php
// initialise script
include('includes/template/header.php');
// only allow access to admins
if ($_SESSION['access_level'] !== '1') {
    header('Location: access-denied.php');
    exit();
}

if (isset($_POST['submit'])) {

    foreach ($_POST as $name => $value) {
        $$name = $value;
    }

    if (empty($email) || empty($password) || empty($first_name) || empty($last_name) || empty($display_name) ||  empty($address_1) || empty($city) || empty($country)) {
        $error_message[] = 'All fields are required!';
    } else {
        if ($users->user_exists($email) == TRUE) {
            $error_message[] = 'That username already exists';
        }
        if (strlen($password) < 8) {
            $error_message[] = 'Password must be at least 8  characters long';
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
            $error_message[] = 'Please enter a valid email address';
        }
    }

    if (empty($error_message) == TRUE){
        $users->register($email, $password, $first_name, $last_name, $company, $display_name, $address_1, $address_2, $city, $county, $state, $country, $post_code, $phone, $access_level);
        header('Location: users-list.php?addsuccess');
        exit();
    }
}
?>
<!-- html -->
<br><br>
    <?php
        if(isset($error_message)){
            foreach ($error_message as $error) {
                echo '<p>' . $error . '</p>';
            }
        }
    ?>
	<!-- user entry form -->
	<form class="well span6" role="form" action='' method='post'>
		<div class="row">
            <div class="form-group col-lg-6">
                <label for="email">Email Address *</label><br>
                <input type="email" name="email" id="email" value="<?php if (isset($_POST['email'])) echo htmlentities($_POST['email']); ?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="password">Password *</label><br>
                <input type="password" name="password" id="password" value="<?php if (isset($_POST['password'])) echo htmlentities($_POST['password']); ?>">
            </div>
		 	<div class="form-group col-lg-6">
				<label for="first_name">First Name *</label><br>
				<input type="text" name="first_name" id="first_name" value="<?php if (isset($_POST['first_name'])) echo htmlentities($_POST['first_name']); ?>">
		 	</div>
		 	<div class="form-group col-lg-6">
                <label for="last_name">Last Name *</label><br>
                <input type="text" name="last_name" id="last_name" value="<?php if (isset($_POST['last_name'])) echo htmlentities($_POST['last_name']); ?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="company">Company</label><br>
                <input type="text" name="company" id="company" value="<?php if (isset($_POST['company'])) echo htmlentities($_POST['company']); ?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="display_name">Display Name *</label><br>
                <input type="text" name="display_name" id="display_name" value="<?php if (isset($_POST['display_name'])) echo htmlentities($_POST['display_name']); ?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="address_1">Address *</label><br>
                <input type="text" name="address_1" id="address_1" value="<?php if (isset($_POST['address_1'])) echo htmlentities($_POST['address_1']); ?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="address_2">Address 2</label><br>
                <input type="text" name="address_2" id="address_2" value="<?php if (isset($_POST['address_2'])) echo htmlentities($_POST['address_2']); ?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="city">City *</label><br>
                <input type="text" name="city" id="city" value="<?php if (isset($_POST['city'])) echo htmlentities($_POST['city']); ?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="county">County</label><br>
                <input type="text" name="county" id="county" value="<?php if (isset($_POST['county'])) echo htmlentities($_POST['county']); ?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="state">State / Province</label><br>
                <input type="text" name="state" id="state" value="<?php if (isset($_POST['state'])) echo htmlentities($_POST['state']); ?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="country">Country *</label><br>
                <input type="text" name="country" id="country" value="<?php if (isset($_POST['country'])) echo htmlentities($_POST['country']); ?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="post_code">Post Code</label><br>
                <input type="text" name="post_code" id="post_code" value="<?php if (isset($_POST['post_code'])) echo htmlentities($_POST['post_code']); ?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="phone">Phone Number</label><br>
                <input type="text" name="phone" id="phone" value="<?php if (isset($_POST['phone'])) echo htmlentities($_POST['phone']); ?>">
            </div>

            <div class="form-group col-lg-6">
                <label for="access_level">Access level</label><br>
                <select name="access_level">
                    <option value="2">Customer</option>
                    <option value="1">Admin</option>
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
?>