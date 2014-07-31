<?php
// include init file
require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/init.php');
$billing = new Billing($db);

$token  = $_POST['stripeToken'];
$invoice = $billing->get_invoice($_GET['invoice']);
$user = $users->get_user($invoice['owner']);

$customer = Stripe_Customer::create(array(
    'email' => $user['email'],
    'card'  => $token
));

$charge = Stripe_Charge::create(array(
    'customer' => $customer->id,
    'amount'   => $invoice['total'] * '100',
    'currency' => CURRCODE
));

header("Location: /billing/invoice.php?set_status=paid&id=" . $invoice['id'] . "");