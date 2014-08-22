<?php
// initialise script
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/init.php');
// check to make sure user is not logged in
$users->logged_in_protect();
// process login form if submitted
if (empty($_POST) === false) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    // checks to make sure email and password provided and that password is at least 8 characters
    if (empty($email) === true || empty($password) === true) {
        $error = 'Sorry, but we need your email address and password.';
    } else if (strlen($password) < 8) {
        $error = 'The password should be more than 8 characters, without spacing.';
    }
    // if no errors are triggered will process login
    if (empty ($errors)) {
        $login = $users->login($email, $password);
        // triggers error on login failure
        if ($login === false) {
            $error = 'Sorry, those login details are invalid';
        } else {
            // destroies the old session id and creates a new one
            session_regenerate_id(true);
            $_SESSION['id'] = $login;
            header('Location: /');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo(SITE_NAME); ?></title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <!-- display any errors -->

                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                        <?php if (!empty($error)) {
                            echo '<br><div class="alert alert-danger" role="alert">' . $error . '</div>';
                        } ?>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email Address" name="email" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
