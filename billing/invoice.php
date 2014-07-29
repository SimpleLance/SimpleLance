<?php
// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');
// instantiate projects class
$billing = new Billing($db);
// check if valid invoice requested, if not return to invoice list
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $invoice = $billing->get_invoice($_GET['id']);
    if ($invoice == "Error" || $invoice['owner'] != $_SESSION['id'] && $_SESSION['access_level'] != '1') {
        header("Location: /billing/");
        exit();
    }
} else {
    header("Location: /billing/");
    exit();
}

if (isset($_GET['send']) && $_GET['send'] == 'yes') {
    $email = $users->get_user($invoice['owner'])['email'];
    $billing->send_invoice($_GET['id'], $email);
    header("Location: /billing/");
    exit();
}
?>

    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Invoice # <?php echo $invoice['id']; ?></h2>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong><br>
                        <?php echo $users->get_user($invoice['owner'])['first_name'].' '.$users->get_user($invoice['owner'])['last_name']; ?><br>
                        <?php echo $users->get_user($invoice['owner'])['address_1']; ?><br>
                        <?php echo $users->get_user($invoice['owner'])['city']; ?>,
                        <?php echo $users->get_user($invoice['owner'])['post_code']; ?><br>
                        <?php echo $users->get_user($invoice['owner'])['country']; ?>
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <address>
                        <strong>Order Date:</strong><br>
                        <?php echo date('jS F Y', strtotime($invoice['created_date'])); ?><br><br>
                    </address>
                </div>
                <div class="col-xs-4">
                    <address>
                        <strong>Due Date:</strong><br>
                        <?php echo date('jS F Y', strtotime($invoice['due_date'])); ?><br><br>
                    </address>
                </div>
                <div class="col-xs-4">
                    <address>
                        <strong>Status:</strong><br>
                        <?php echo $invoice['status']; ?><br><br>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>Item</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                                <td class="text-center"><strong>Quantity</strong></td>
                                <td class="text-right"><strong>Totals</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($billing->invoice_items($_GET['id']) as $item) { ?>
                            <tr>
                                <td><?php echo $item['item']; ?></td>
                                <td class="text-center"><?php echo CURRSYM.$item['price']; ?></td>
                                <td class="text-center"><?php echo $item['quantity']; ?></td>
                                <td class="text-right"><?php echo CURRSYM.$item['total']; ?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Total</strong></td>
                                <td class="thick-line text-right"><?php echo CURRSYM.$invoice['amount_due']; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" onClick="window.print()" class="btn btn-primary">Print Invoice</a>

<?php
// include footer
include(ABS_PATH . '/includes/template/footer.php');
?>