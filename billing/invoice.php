<?php
// include header
include $_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php';
// instantiate billing class
$billing = new \SimpleLance\Billing($db);
// Instantiate stripe
Stripe::setApiKey($stripe['secret_key']);
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
// pulls user details for invoice owner
$user = $users->get_user($invoice['owner']);
// checks to see if invoice is being sent and sends
if (isset($_GET['send']) && $_GET['send'] == 'yes') {
    $email = $users->get_user($invoice['owner'])['email'];
    $billing->send_invoice($_GET['id']);
}
// checks to see if invoice is being set as paid and updates
if (isset($_GET['set_status']) && $_GET['set_status'] == 'paid') {
    $billing->mark_paid($_GET['id']);
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
                        <?php echo $user['first_name'].' '.$users->get_user($invoice['owner'])['last_name']; ?><br>
                        <?php echo $user['address_1']; ?><br>
                        <?php echo $user['city']; ?>,
                        <?php echo $user['post_code']; ?><br>
                        <?php echo $user['country']; ?>
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
                                <td class="thick-line text-right"><?php echo CURRSYM.$invoice['total']; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" onClick="window.print()" class="btn btn-primary">Print Invoice</a>
    <?php if ($_SESSION['access_level'] == '1' && $invoice['status'] != 'Paid') { ?>
        <a href="/billing/invoice.php?set_status=paid&id=<?php echo $_GET['id']; ?>" class="btn btn-primary">Mark Paid</a>
    <?php } ?>
    <?php if ($invoice['status'] !='Paid') { ?>
        <form action="/billing/charge?invoice=<?php echo $invoice['id']; ?>" method="POST">
            <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="<?php echo $stripe['publishable_key']; ?>"
                data-name="<?php echo (SITE_NAME); ?>"
                data-email="<?php echo $user['email']; ?>"
                data-currency="<?php echo (CURRCODE); ?>"
                data-description="Invoice #<?php echo $invoice['id'] ?> (<?php echo CURRSYM.($invoice['total']); ?>)"
                data-amount="<?php echo ($invoice['total'] * '100'); ?>">
            </script>
        </form>
    <?php }

// include footer
include ABS_PATH . '/includes/template/footer.php';
?>
