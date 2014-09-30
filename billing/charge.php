<?php
// include init file
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/init.php';
// Instantiate stripe
Stripe::setApiKey($stripe['secret_key']);
$billing = new \SimpleLance\Billing($db);
// pull stripe token from form
$token  = $_POST['stripeToken'];
// load invoice details
$invoice = $billing->get_invoice($_GET['invoice']);
// load invoice owner details
$user = $users->get_user($invoice['owner']);
// create stripe customer
$customer = Stripe_Customer::create(array(
    'email' => $user['email'],
    'card'  => $token
));
// process stripe charge
$charge = Stripe_Charge::create(array(
    'customer' => $customer->id,
    'amount'   => $invoice['total'] * '100',
    'currency' => CURRCODE
));
// update invoice status to paid once charge complete
header("Location: /billing/invoice.php?set_status=paid&id=" . $invoice['id'] . "");
