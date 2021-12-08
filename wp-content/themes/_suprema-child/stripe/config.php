<?php
$dir = get_stylesheet_directory().'/stripe/vendor/autoload.php';
require_once($dir);

$stripe = [
  "secret_key"      => "sk_test_UpVqxMkKPFdYcIdPDIEnAQO800fDL0aeCO",
  "publishable_key" => "pk_test_3g5ZYes1Gw3fCg14R1fBRU8c00I5z8Qz5U",
];

/*$stripe = [
  "secret_key"      => "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",
  "publishable_key" => "pk_live_51ITjDgLZsJJs3zmU9JyMMpP09otlTOADQonawjsLxsRMAakoM2Di7jfzbqlPepdazS5G5JRVL38wbrASDuyWN8fH00HKM66XWp",
];*/


\Stripe\Stripe::setApiKey($stripe['secret_key']);

?>