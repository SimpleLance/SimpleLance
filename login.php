<?php
// initialise script
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/init.php');
// check to make sure user is not logged in
$users->logged_in_protect();

// process login form if submitted
if (empty($_POST) === false) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) === true || empty($password) === true) {
        $errors[] = 'Sorry, but we need your email address and password.';
    } else if ($users->user_exists($email) === false) {
        $errors[] = 'Sorry that email address doesn\'t exist.';
    } 
    else {
        if (strlen($password) > 18) {
            $errors[] = 'The password should be less than 18 characters, without spacing.';
        }
        $login = $users->login($email, $password);
        if ($login === false) {
            $errors[] = 'Sorry, that email/password is invalid';
        } else {
            session_regenerate_id(true); // destroying the old session id and creating a new one

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
    <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
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
    <script src="/assets/js/jquery-2.1.1.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.metisMenu.js"></script>
    <script src="/assets/js/scripts.js"></script>
</body>
</html>
