<?php
// include header
include $_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php';

if (isset($_GET['id']) && empty($_GET['id']) === false) {
    $id = htmlentities($_GET['id']);
    $user_details = array();
    $user_details = $users->get_user($id);
}
if ($_SESSION['access_level'] !== '1' && $_GET['id'] !== $_SESSION['id']) {
    header('Location: /access-denied.php');
    exit();
}
// get gravatar hash
$gravatarhash = md5(strtolower(trim($user_details['email'])));

// instantiate projects and support classes
$projects = new \SimpleLance\Projects($db);
$support = new \SimpleLance\Support($db);
?>
<br><br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
            <?php
            if (isset($_GET['password_updated']) && empty($_GET['password_updated'])) {
                echo "Password successfully updated";
            }
            ?>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo($user_details['first_name'].' '.$user_details['last_name']); ?> - <a href="/users/edit.php?id=<?php echo($user_details['id']); ?>">Edit</a> </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://www.gravatar.com/avatar/<?php echo($gravatarhash); ?>" class="img-circle"> </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Email Address:</td>
                                    <td><?php echo($user_details['email']); ?></td>
                                </tr>
                                <tr>
                                    <td>Phone Number:</td>
                                    <td><?php echo($user_details['phone']); ?></td>
                                </tr>
                                <tr>
                                    <td>User Type:</td>
                                    <td><?php if ($user_details['access_level'] == '1') {echo('Admin');} else { echo('Customer');} ?></td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>Address 1:</td>
                                    <td><?php echo($user_details['address_1']); ?></td>
                                </tr>
                                <tr>
                                    <td>Address 2:</td>
                                    <td><?php echo($user_details['address_2']); ?></td>
                                </tr>
                                <tr>
                                    <td>City:</td>
                                    <td><?php echo($user_details['city']); ?></td>
                                </tr>
                                <tr>
                                    <td>State:</td>
                                    <td><?php echo($user_details['state']); ?></td>
                                </tr>
                                <tr>
                                    <td>Post Code:</td>
                                    <td><?php echo($user_details['post_code']); ?></td>
                                </tr>
                                <tr>
                                    <td>Country:</td>
                                    <td><?php echo($user_details['country']); ?></td>
                                </tr>

                                </tbody>
                            </table>
                            <table class="table table-user-information">
                                <thead>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <?php
                                foreach ($projects->user_projects($user_details['id']) as $p) { ?>
                                    <tr>
                                        <td><a href="/projects/details.php?id=<?php echo($p['id']); ?>"><?php echo($p['name']); ?></a></td>
                                        <td><?php echo($p['status']); ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                            <table class="table table-user-information">
                                <thead>
                                <tr>
                                    <th>Ticket Subject</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <?php
                                foreach ($support->user_tickets($user_details['id']) as $t) { ?>
                                    <tr>
                                        <td><a href="/support/ticket.php?id=<?php echo($t['id']); ?>"><?php echo($t['subject']); ?></a></td>
                                        <td><?php echo($support->get_status($t['status'])); ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
// include footer
include ABS_PATH . '/includes/template/footer.php';
?>
