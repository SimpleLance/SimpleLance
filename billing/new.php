<?php
// include header
include $_SERVER['DOCUMENT_ROOT'] . '/includes/template/header.php';
// instantiate billing class
$billing = new \SimpleLance\Billing($db);
// only allow access to admins
if ($_SESSION['access_level'] != '1') {
    header("Location: /access-denied.php");
}
// creates new invoice on form submission and validation
if (isset($_POST['submit'])) {

    $owner = trim($_POST["owner"]);
    $created_date = trim($_POST["created_date"]);
    $created_date = date('Y-m-d', strtotime($created_date));
    $due_date = trim($_POST["due_date"]);
    $due_date = date('Y-m-d', strtotime($due_date));

    if (empty($owner) || empty($created_date) || empty($due_date)) {
        $errors[] = 'All fields are required!';
    }

    if (empty($errors) == TRUE) {
        $billing->createInvoice($owner, $created_date, $due_date);
    }
}
?>
    <form role="form" action="" method="post" name="invoice">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h2>Invoice</h2
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="owner">Invoice To:</label><br>
                        <select name="owner" id="owner">
                            <option value=""></option>
                            <?php foreach ($users->listUsers() as $u) {
                                echo "<option value='".$u['id']."'>".$u['first_name'].' '.$u['last_name']."</option>";
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <address>
                            <label for="created_date">Order Date:</label><br>
                            <input type="text" name="created_date" id="created_date" value="">
                        </address>
                    </div>
                    <br>
                    <div class="form-group col-xs-12">
                        <address>
                            <label for="due_date">Due Date:</label><br>
                            <input type="text" name="due_date" id="due_date" value="">
                        </address>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary pull-left" name="submit" type="submit">Save Invoice</button>
    </form>

<?php
// include footer
include ABS_PATH . '/includes/template/footer.php';
?>
