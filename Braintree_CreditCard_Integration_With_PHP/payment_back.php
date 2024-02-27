<?php
require_once('vendor/lib/autoload.php');
Braintree\Configuration::environment('sandbox'); // 'production' when live
Braintree\Configuration::merchantId('YOUR_MERCHANT_ID');
Braintree\Configuration::publicKey('YOUR_PUBLIC_KEY');
Braintree\Configuration::privateKey('YOUR_PRIVATE_KEY');
$amount = $_POST['amount'];
$nonce = $_POST['nonce'];
$threeDSecureAuthenticationId = $_POST['3ds_auth'];

$result = Braintree\Transaction::sale([
  'amount' => $amount,
  'paymentMethodNonce' => $nonce,
  'threeDSecureAuthenticationId' => $threeDSecureAuthenticationId,
  'options' => [
    'submitForSettlement' => True
  ]
]);

if ($result->success) {
    $transactionId = $result->transaction->id;
    require_once 'success.php';
    exit();
} else {
    $error = $result->message;
    require_once 'error.php';
    exit;
}







?>