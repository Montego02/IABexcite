<?php
require_once '../libraries/braintree/lib/Braintree.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('q2f26g27n69qmzp3');
Braintree_Configuration::publicKey('fjx75qtd6wmh6jxz');
Braintree_Configuration::privateKey('168ff80e5407684743ddb8511333438b');


$result = Braintree_Transaction::sale([
    "amount" => $_POST['amount'],
    "paymentMethodNonce" => $_POST['nonce'],
    "orderId" => $_POST['order'],
    "options" => [
      "paypal" => [
        "customField" => $_POST["PayPal custom field"],
        "description" => $_POST["Description for PayPal email receipt"],
      ],
    ],
]);

if ($result->success) {
  print_r("Success ID: " . $result->transaction->id);
} else {
  print_r("Error Message: " . $result->message);
}