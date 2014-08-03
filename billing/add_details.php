<?php
// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');
// instantiate billing class
$billing = new \SimpleLance\Billing($db);
// only allow access to admins
if ($_SESSION['access_level'] != '1') {
    header("Location: /access-denied.php");
}
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $invoice = $billing->get_invoice($_GET['id']);
} else {
    header("Location: /billing");
}
if (isset($_POST['submit'])) {

    $item = trim($_POST["item"]);
    $price = trim($_POST["price"]);
    $quantity = trim($_POST["quantity"]);
    $total = trim($_POST["total"]);

    if (empty($item) || empty($price) || empty($quantity) || empty($total)) {
        $errors[] = 'All fields are required!';
    }

    if (empty($errors) == TRUE){
        $billing->add_invoice_item($_GET['id'], $item, $price, $quantity, $total);
    }
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
                <div class="form-group col-xs-4">
                    <address>
                        Created date:<br>
                        <?php echo date('jS F Y', strtotime($invoice['created_date'])); ?>
                    </address>
                </div>
                <div class="form-group col-xs-4">
                    <address>
                        Due date:<br>
                        <?php echo date('jS F Y', strtotime($invoice['due_date'])); ?>
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
                <form role="form" action="" method="post" name="invoice_item">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed" id="invoice_items">
                                <thead>
                                <tr>
                                    <td><strong>Item</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <div>
                                    <?php foreach ($billing->invoice_items($_GET['id']) as $item) { ?>
                                        <tr>
                                            <td><?php echo $item['item']; ?></td>
                                            <td class="text-center"><?php echo CURRSYM.$item['price']; ?></td>
                                            <td class="text-center"><?php echo $item['quantity']; ?></td>
                                            <td class="text-right"><?php echo CURRSYM.$item['total']; ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td><input type="text" name="item" id="item" value=""></td>
                                        <td class="text-center"><input type="text" name="price" id="price" value="" onFocus="startCalc();" onBlur="stopCalc();"></td>
                                        <td class="text-center"><input type="text" name="quantity" id="quantity" value="" onFocus="startCalc();" onBlur="stopCalc();"></td>
                                        <td class="text-right"><input type="text" name="total" id="total" value=""></td>
                                        <td><button class="button " name="submit" type="submit">Add Item</button></td>
                                    </tr>
                                </div>
                                </tbody>
                            </table>
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Total:</strong></td>
                                    <td class="thick-line text-right"><?php echo CURRSYM.$invoice['total']; ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <a href="/billing/invoice.php?send=yes&id=<?php echo $_GET['id']; ?>"  class="btn btn-primary">Send Invoice</a>
<?php
// include footer
include(ABS_PATH . '/includes/template/footer.php');
?>