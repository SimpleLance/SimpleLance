<?php
// include header
include $_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php';
// instantiate billing class
$billing = new \SimpleLance\Billing($db);
// check if user is a customer and only show their invoices
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
            <?php // only show invoices that are not draft
            foreach ($billing->userInvoices($_SESSION['id']) as $i) {
                if ($i['status'] != 'Draft') { ?>
                    <tr>
                        <td><?php echo date('d/m/Y', strtotime($i['created_date'])); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($i['due_date'])); ?></td>
                        <td><?php echo htmlentities($i['status']); ?></td>
                        <td><?php echo CURRSYM . htmlentities($i['total']); ?></td>
                        <td><a href="/billing/invoice.php?id=<?php echo htmlentities($i['id']); ?>">View</a></td>
                    </tr>
          <?php }
           } ?>
        </table>
    </div>
<?php } else {
// user is admin, show all invoices
    ?>
    <div class="row col-md-9 col-md-offset-1 custyle">
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
            foreach ($billing->listInvoices() as $i) { ?>
                <tr>
                    <td><?php echo $users->getUser($i['owner'])['first_name'].' '.$users->getUser($i['owner'])['last_name']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($i['created_date'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($i['due_date'])); ?></td>
                    <td><?php echo htmlentities($i['status']); ?></td>
                    <td><?php echo CURRSYM . htmlentities($i['total']); ?></td>
                    <td><a href="/billing/invoice.php?id=<?php echo htmlentities($i['id']); ?>">View</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php
}
// include footer
include ABS_PATH . '/includes/template/footer.php';
?>
