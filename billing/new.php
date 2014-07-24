<?php
// include header
include($_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php');
// instantiate projects class
$billing = new Billing($db);
// only allow access to admins
if ($_SESSION['access_level'] != '1') {
    header("Location: /access-denied.php");
}

if (isset($_POST['submit'])) {

    var_dump($_POST);
}
?>
    <form role="form" action="" method="post" name="invoice">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Invoice</h2><h3 class="pull-right">Invoice # ID</h3>
            </div>
            <hr>
            <div class="row">
                <div class="form-group col-lg-12">
                    <label for="owner">Invoice To:</label><br>
                    <select name="owner" id="owner">
                        <option value=""></option>
                        <?php foreach ($users->get_users() as $u) {
                            echo "<option value='".$u['id']."'>".$u['first_name'].' '.$u['last_name']."</option>";
                        } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-4">
                    <address>
                        <label for="created_date">Order Date:</label><br>
                        <input type="text" name="created_date" id="created_date" value="">
                    </address>
                </div>
                <div class="form-group col-xs-4">
                    <address>
                        <label for="created_date">Due Date:</label><br>
                        <input type="text" name="due_date" id="due_date" value="">
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
                                <tr>
                                    <td><input type="text" name="item" id="item" value=""></td>
                                    <td class="text-center"><input type="text" name="price" id="price" value="" onFocus="startCalc();" onBlur="stopCalc();"></td>
                                    <td class="text-center"><input type="text" name="quantity" id="quantity" value="" onFocus="startCalc();" onBlur="stopCalc();"></td>
                                    <td class="text-right"><input type="text" name="total" id="total" value=""></td>
                                    <td><input type="button" name="add" value="Add" class="tr_clone_add"></td>
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
                                <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                <td class="thick-line text-right">SUBTOTAL</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Tax</strong></td>
                                <td class="no-line text-right">TAX</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Total</strong></td>
                                <td class="no-line text-right">TOTAL DUE</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <button class="btn btn-primary pull-right" name="submit" type="submit">Save Invoice</button>
    </form>

<?php
// include footer
include(ABS_PATH . '/includes/template/footer.php');
?>