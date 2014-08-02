<?php
// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');
// gets user details from database
if (isset($_GET['id']) && empty($_GET['id']) === false) {
    $id = htmlentities($_GET['id']);
    $user_details = array();
    $user_details = $users->get_user($id);
}
// allows access only to admin or specific user
if ($_SESSION['access_level'] !== '1' && $_GET['id'] !== $_SESSION['id']) {
    header('Location: /access-denied.php');
    exit();
}
// checks for form submission
if (isset($_POST['submit'])) {
    $password = trim($_POST['password']);
    $password_verify = trim($_POST['password_verify']);

    if ($password !== $password_verify) {
        $errors[] = 'Your passswords do not match';
    }

    if (strlen($password) < 8) {
        $errors[] = 'Your password must be at least 8 characters long';
    }

    if (empty($errors)) {
        $users->change_password($_GET['id'], $password);
        header('Location: /users/profile.php?id='.$user_details['id'].'&password_updated');
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

                    <legend>Change Password for <b><?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?></b></legend>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="password">Password*</label>
                        <div class="col-sm-10">
                            <input type="password" id="password" name="password" placeholder="Enter new password to change" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="password_verify">Repeat Password*</label>
                        <div class="col-sm-10">
                            <input type="password" id="password_verify" name="password_verify" placeholder="Repeat new password to change" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="pull-right">
                                <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
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