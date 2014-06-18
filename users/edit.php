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
if (isset($_POST['save'])) {
    foreach ($_POST as $name => $value) {
        $$name = $value;
    }

    if (empty($first_name) || empty($last_name) || empty($email) ||  empty($address_1) || empty($city) || empty($country)) {
        $error_message[] = 'All fields with a * are required!';
    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
            $error_message[] = 'Please enter a valid email address';
        }
        if ($password !== $password_repeat) {
            $error_message[] = 'Your passswords do not match';
        }

        if (empty($error_message) == TRUE){
            $users->update_profile($first_name, $last_name, $email, $password, $access_level, $address_1, $address_2, $city, $state, $post_code, $country, $phone, $id);
            if ($_SESSION['access_level'] == '1') {
                header('Location: /users/?editsuccess');
                exit();
            } else {
                header('Location: /?editsuccess');
            }
        }
    }
}
?>
<br><br>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <?php
            if(isset($error_message)){
                foreach ($error_message as $error) {
                    echo '<p>' . $error . '</p>';
                }
            }
            ?>
            <form class="form-horizontal" role="form" method="post" action="">
                <fieldset>

                    <legend>User Details</legend>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="first_name">First Name*</label>
                        <div class="col-sm-4">
                            <input type="text" id="first_name" name="first_name" placeholder="First Name" value="<?php echo $user_details['first_name'];?>" class="form-control">
                        </div>
                        <label class="col-sm-2 control-label" for="last_name">Last Name*</label>
                        <div class="col-sm-4">
                            <input type="text" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo $user_details['last_name'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="email">Email Address*</label>
                        <div class="col-sm-10">
                            <input type="text" id="email" name="email" placeholder="Email Address" value="<?php echo $user_details['email'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="password">Password*</label>
                        <div class="col-sm-10">
                            <input type="password" id="password" name="password" placeholder="Enter new password to change" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="password_repeat">Repeat Password*</label>
                        <div class="col-sm-10">
                            <input type="password" id="password_repeat" name="password_repeat" placeholder="Repeat new password to change" class="form-control">
                        </div>
                    </div>
                    <?php if($_SESSION['access_level'] == 1) { ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="access_level">User Type</label>
                            <div class="col-sm-10">
                                <select id="access_level" name="access_level">
                                    <option value="2" <?php if($user_details['access_level'] == '2') {echo "selected='selected'"; } ?>>Customer</option>
                                    <option value="1" <?php if($user_details['access_level'] == '1') {echo "selected='selected'"; } ?>>Admin</option>
                                </select>
                            </div>
                        </div>
                    <?php } else { ?>
                    <input type="hidden" id="access_level" name="access_level" value="<?php echo $user_details['access_level'];?>">
                    <?php } ?>
                    <br>
                    <legend>Address Details</legend>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="address_1">Address 1*</label>
                        <div class="col-sm-10">
                            <input type="text" id="address_1" name="address_1" placeholder="Address Line 1" value="<?php echo $user_details['address_1'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="address_2">Address 2</label>
                        <div class="col-sm-10">
                            <input type="text" id="address_2" name="address_2" placeholder="Address Line 2" value="<?php echo $user_details['address_2'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="city">City *</label>
                        <div class="col-sm-10">
                            <input type="text" id="city" name="city" placeholder="City" value="<?php echo $user_details['city'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="state">State</label>
                        <div class="col-sm-4">
                            <input type="text" id="state" name="state" placeholder="State" value="<?php echo $user_details['state'];?>" class="form-control">
                        </div>
                        <label class="col-sm-2 control-label" for="post_code">Postcode</label>
                        <div class="col-sm-4">
                            <input type="text" id="post_code" name="post_code" placeholder="Post Code" value="<?php echo $user_details['post_code'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="country">Country*</label>
                        <div class="col-sm-10">
                            <input type="text" id="country" name="country" placeholder="Country" value="<?php echo $user_details['country'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="phone">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="text" id="phone" name="phone" placeholder="Phone Number" value="<?php echo $user_details['phone'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="pull-right">
                                <button type="submit" name="cancel" class="btn btn-default">Cancel</button>
                                <button type="submit" name="save" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div><!-- /.col-lg-12 -->
    </div>
<?php
// include footer
include(ABS_PATH . '/includes/template/footer.php');
?>