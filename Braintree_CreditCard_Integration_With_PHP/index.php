<?php
require_once('vendor/lib/autoload.php');
Braintree\Configuration::environment('sandbox'); // 'production' when live
Braintree\Configuration::merchantId('YOUR_MERCHANT_ID');
Braintree\Configuration::publicKey('YOUR_PUBLIC_KEY');
Braintree\Configuration::privateKey('YOUR_PRIVATE_KEY');
$clientToken = Braintree\ClientToken::generate();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <title>Creditcard Payment</title>
</head>

<body>
  <h1>3D Secure v2.0 sdk with Drop-in</h1>

<hr>

<form action="payment_back.php" id="cc_form" class="container" method="post">
  <div class="row">
    <div class="col-xs-12">
      <p class="lead">This is a functional example of performing 3D Secure verification on a credit card tokenized with Drop-in. For 3DS 2.0, it's highly recomended to supply additional information about the customer to achieve a frictionless flow (no challenge presented).</p>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <p>For this demo, you may populate the fields with fake customer information.</p>
      <button class="btn btn-warning" id="autofill">Autofill Customer Information</button>
    </div>
  </div>
  
  <div class="row">
    <div class="col-xs-12" >
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="you@example.com">
        <span id="help-email" class="help-block"></span>
      </div>
      <div class="form-group">
        <label for="billing-phone">Billing phone number</label>
        <input type="billing-phone" class="form-control" id="billing-phone" placeholder="123-456-7890">
        <span id="help-billing-phone" class="help-block"></span>
      </div>
      <div class="form-group">
        <label for="billing-given-name">Billing given name</label>
        <input type="billing-given-name" class="form-control" id="billing-given-name" placeholder="First">
        <span id="help-billing-given-name" class="help-block"></span>
      </div>
      <div class="form-group">
        <label for="billing-surname">Billing surname</label>
        <input type="billing-surname" class="form-control" id="billing-surname" placeholder="Last">
        <span id="help-billing-surname" class="help-block"></span>
      </div>
      <div class="form-group">
        <label for="billing-street-address">Billing street address</label>
        <input type="billing-street-address" class="form-control" id="billing-street-address" placeholder="123 Street">
        <span id="help-billing-street-address" class="help-block"></span>
      </div>
      <div class="form-group">
        <label for="billing-extended-address">Billing extended address</label>
        <input type="billing-extended-address" class="form-control" id="billing-extended-address" placeholder="Unit 1">
        <span id="help-billing-extended-address" class="help-block"></span>
      </div>
      <div class="form-group">
        <label for="billing-locality">Billing locality</label>
        <input type="billing-locality" class="form-control" id="billing-locality" placeholder="City">
        <span id="help-billing-locality" class="help-block"></span>
      </div>
      <div class="form-group">
        <label for="billing-region">Billing region</label>
        <input type="billing-region" class="form-control" id="billing-region" placeholder="State">
        <span id="help-billing-region" class="help-block"></span>
      </div>
      <div class="form-group">
        <label for="billing-postal-code">Billing postal code</label>
        <input type="billing-postal-code" class="form-control" id="billing-postal-code" placeholder="12345">
        <span id="help-billing-postal-code" class="help-block"></span>
      </div>
      <div class="form-group">
        <label for="billing-country-code">Billing country code (Alpha 2)</label>
        <input type="billing-country-code" class="form-control" id="billing-country-code" placeholder="XX">
        <span id="help-billing-country-code" class="help-block"></span>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-xs-12">
      <table class="table">
        <tr><th>Field</th><th>Value</th></tr>
        <tr><td>Number (successful with no challenge)</td><td>4000000000001000</td></tr>
        <tr><td>Number (successful with challenge)</td><td>4000000000001091</td></tr>
                <tr><td>Number (unsuccessful with challenge)</td><td>4000000000001109</td></tr>
        <tr><td>Expiration Date (for sandbox testing, year must be exactly 3 years in the future)</td><td>12/22</td></tr>
        <tr><td>CVV</td><td>123</td></tr>
        <tr><td>Postal Code</td><td>12345</td></tr>
      </table>
    </div>
  </div>
  <input type="hidden" name="nonce" id="nonce" value="">
  <input type="hidden" name="3ds_auth" id="3ds_auth" value="">
  <input type="hidden" name="amount" id="amount" value="100">

  
  <div class="col-xs-12 nonce-group hidden">
    <p class="lead"> Payment method nonce received: </p>
    <div class="input-group">
      <span class="input-group-addon lead"></span>
      <input readonly name="nonce" class="form-control">
    </div>
      <br>
      <p class="lead"> Reload the codepen to try another card. </p>
      <br>
  </div>

  <div class="input-group pay-group bt-drop-in-container">
    <div class="row">
      <div class="col-xs-12" >
       <div id="drop-in"></div>
      </div>
    </div>
    
    <div class="row">
      <input disabled id="pay-btn" class="btn btn-success" type="submit" value="Loading...">
    </div>
   </div>
</form>
</body>
<script type="text/javascript">
  var clientToken = '<?= $clientToken;?>';
</script>
<script src="https://js.braintreegateway.com/web/dropin/1.38.0/js/dropin.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="payment.js"></script>
</html>