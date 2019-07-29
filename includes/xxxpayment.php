<?php
require_once 'libraries/braintree/lib/Braintree.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('q2f26g27n69qmzp3');
Braintree_Configuration::publicKey('fjx75qtd6wmh6jxz');
Braintree_Configuration::privateKey('168ff80e5407684743ddb8511333438b');



$clientToken = Braintree_ClientToken::generate();
?>


<input id="clientToken" value="<?php echo $clientToken;?>" type="hidden" >

       
 <?php
//
//$result = Braintree_Transaction::sale([
//    'amount' => '1000.00',
//    'paymentMethodNonce' => 'nonceFromTheClient',
//    'options' => [ 'submitForSettlement' => true ]
//]);
//
//if ($result->success) {
//    print_r("success!: " . $result->transaction->id);
//} else if ($result->transaction) {
//    print_r("Error processing transaction:");
//    print_r("\n  code: " . $result->transaction->processorResponseCode);
//    print_r("\n  text: " . $result->transaction->processorResponseText);
//} else {
//    print_r("Validation errors: \n");
//    print_r($result->errors->deepAll());
//}
?>



<form id="checkout" method="post" action="">
    <div id="payment-form"></div>
    <div id="paypal-container"></div>
  <!--<input type="submit" value="Jetzt bezahlen" type="hidden">-->
</form>




<form id="formSendNonce" action="//sendNonce.php via handler" method="post" enctype="multipart/form-data">
    <input type="hidden" id="nonce" name="nonce" value="">
    <input type="hidden" id="amount" name="amount" value="10">
    <input type="hidden" id="order" name="order" value="111">
    
    <img alt="apps-programmierer-anfragen" src="/images/template/pfeilBig.png" height="50" width="50">
    <button  id="btnPay" class="full  hidden" type="submit" ></button>

</form>




<script src="https://js.braintreegateway.com/js/braintree-2.21.0.min.js"></script>
