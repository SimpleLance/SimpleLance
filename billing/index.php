<?php
// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');
// instantiate projects class
$billing = new Billing($db);
// check if user is a customer
if ($_SESSION['access_level'] != '1') { ?>
    <div class="row col-md-9 col-md-offset-1 custyle">
        <table class="table table-striped custab">
            <thead>
            <tr>
                <th>Created On</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Amount Due</th>
                <th>View</th>
            </tr>
            </thead>
            <?php
            foreach ($billing->user_invoices($_SESSION['id']) as $i) { ?>
                <tr>
                    <td><?php echo date('d/m/Y', strtotime($i['created_date'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($i['due_date'])); ?></td>
                    <td><?php echo htmlentities($i['status']); ?></td>
                    <td><?php echo htmlentities($i['amount_due']); ?></td>
                    <td><a href="/billing/invoice.php?id=<?php echo htmlentities($i['id']); ?>">View</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php } else {
// load all projects
    ?>
    <!-- html -->

    <div class="row col-md-9 col-md-offset-1 custyle">
        <?php
        if (isset($_GET['addsuccess']) && empty($_GET['addsuccess'])) {
            echo '<br><br>Project successfully added.';
        }
        if (isset($_GET['editsuccess']) && empty($_GET['editsuccess'])) {
            echo '<br><br>Project successfully updated.';
        }
        ?>
        <table class="table table-striped custab">
            <thead>
            <tr>
                <th>Name</th>
                <th>Created On</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Amount Due</th>
                <th>View</th>
            </tr>
            </thead>
            <?php
            foreach ($billing->list_invoices() as $i) { ?>
                <tr>
                    <td><?php echo $users->get_user($i['user_id'])['first_name'].' '.$users->get_user($i['user_id'])['last_name']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($i['created_date'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($i['due_date'])); ?></td>
                    <td><?php echo htmlentities($i['status']); ?></td>
                    <td><?php echo htmlentities($i['amount_due']); ?></td>
                    <td><a href="/billing/invoice.php?id=<?php echo htmlentities($i['id']); ?>">View</a></td>
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