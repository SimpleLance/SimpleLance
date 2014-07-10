<?php
// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');
// instantiate projects class
$tickets = new Tickets($db);
// check if user is a customer
if (isset($_GET['owner'])) {
    $ticket = $tickets->user_tickets($_GET['owner']);
?>
    <div class="row col-md-9 col-md-offset-1 custyle">
        <br>
        <a href="/support/new.php">Create New Ticket</a>
        <br>
        <table class="table table-striped custab">
            <thead>
            <tr>
                <th>Subject</th>
                <th>Opened</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Last Reply</th>
                <th>View</th>
            </tr>
            </thead>
            <?php
            foreach ($ticket as $t) { ?>
                <tr>
                    <td><?php echo htmlentities($t['subject']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($t['opened'])); ?></td>
                    <td><?php echo $tickets->get_priority($t['priority']); ?></td>
                    <td><?php echo $tickets->get_status($t['status']); ?></td>
                    <td><?php echo $users->get_user($t['last_reply'])['first_name'].' '.$users->get_user($t['last_reply'])['last_name']; ?></td>
                    <td><a href="/support/ticket.php?id=<?php echo htmlentities($t['id']); ?>">View</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php } else {

    // restrict to admins only
    if($_SESSION['access_level'] != '1') {
        header('Location: /access-denied.php');
        exit();
    }
// load projects
    $ticket = $tickets->list_tickets();
    ?>
    <!-- html -->

    <div class="row col-md-9 col-md-offset-1 custyle">
        <?php
        if (isset($_GET['addsuccess']) && empty($_GET['addsuccess'])) {
            echo '<br><br>Support ticket successfully added.';
        }
        if (isset($_GET['editsuccess']) && empty($_GET['editsuccess'])) {
            echo '<br><br>Support ticket successfully updated.';
        }
        ?>
        <table class="table table-striped custab">
            <thead>
            <tr>
                <th>Subject</th>
                <th>Opened</th>
                <th>Owner</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Last Reply</th>
                <th>View</th>
            </tr>
            </thead>
            <?php
            foreach ($ticket as $t) { ?>
                <tr>
                    <td><?php echo htmlentities($t['subject']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($t['opened'])); ?></td>
                    <td><?php echo $users->get_user($t['owner'])['first_name'].' '.$users->get_user($t['owner'])['last_name']; ?></td>
                    <td><?php echo $tickets->get_priority($t['priority']); ?></td>
                    <td><?php echo $tickets->get_status($t['status']); ?></td>
                    <td><?php echo $users->get_user($t['last_reply'])['first_name'].' '.$users->get_user($t['last_reply'])['last_name']; ?></td>
                    <td><a href="/support/ticket.php?id=<?php echo htmlentities($t['id']); ?>">View</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>


    <!-- /html -->
<?php
}
// include footer
include(ABS_PATH . '/includes/template/footer.php');
?>