<?php

require '../../wp-config.php';
require 'vendor/autoload.php';
global $wpdb;

/*$wpdb->insert( 
    'tbl_orders2', 
    array( 
        'id' => $data['id'],
		'entity' => 'payment',
		'amount' => $data['amount']/100,
		'currency' => "USD",
		'status' => "captured",
		'method' => $data-['payment_method_details']['type'],
		'order_id' => '',
		'description' => '',
		'international' => 0,
		'refund_status' => '',
		'amount_refunded' => 0,
		'captured' => 1,
		'email' => '',
		'contact' => '',
		'fee' => 0,
		'tax' => 0,
		'error_code' => '',
		'error_description' => '',
		'notes' => '',
		'card_id' => $data['source']['id'],
		'bank' => '',
		'wallet' => '',
		'vpa' => '',
		'created_at' => date('Y-m-d H:i:s'),
    )
);
exit;*/

// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys

//Provide your secret key here 
\Stripe\Stripe::setApiKey("sk_test_78m5E8djkqqALL5SSqqRm58j00MvkWaTcp");

// Token is created using Stripe.js or Checkout!
// Get the payment token submitted by the form

//Read JSON from request
$inputJSON = file_get_contents('php://input');

//convert JSON into PHP array
$post = json_decode($inputJSON, TRUE);

//if no valid json found, try it using post/get 
if (!$post) {
	parse_str($inputJSON, $post);
}


//sentize posted data i.e senitize($post);

//Read token 
$errors = [];

if (empty($post['stripe_token'])) {
	$errors[] = "Stripe token missing";
} else {
	$token = $post['stripe_token'];
}

if (empty($post['amount'])) {
	$errors[] = "Amount missing";
} else {
	$amount = $post['amount'];
}

if (empty($post['description'])) {
	$errors[] = "Product description missing";
} else {
	$description = $post['description'];
}

if (isset($post['displayCurrency'])) {
	$currency = $post['displayCurrency']; //usd 
} else {
	$currency = 'usd'; 
}

if (isset($post['cname'])) {
	$cname = $post['cname']; //usd 
} else {
	$cname = 'usd'; 
}

if (isset($post['email'])) {
	$email = $post['email']; //usd 
} else {
	$email = 'usd'; 
}

if (isset($post['description'])) {
	$description = $post['description']; //usd 
} else {
	$description = 'usd'; 
}

$email  = $_POST['stripeEmail'];



$response = null;

if (!empty($errors)) {
	
	$response = json_encode(['errors' => $errors]);

} else {
     $amount = $amount * 100; //Stripe expects amounts in cents/pence

	try {
       
        /*$create_customer = \Stripe\Customer::create(array(
            'source'   => $token,
            'email'    => $email,
            ));

        $customerID = $create_customer->id;*/
        
        
        //$customer = \Stripe\Customer::retrieve($customerID);

        //print_r($customer);

        
	    $info = array(
			"amount" => $amount,
			"currency" => $currency,
			"description" => $description,
			"customer" => "cus_JFz9SDRIRF2kKV",

		);
		
		 
		
		$charge = \Stripe\Charge::create($info);

		//print_r($charge);


		if ($charge->status == 'succeeded') {

			//verify amount here by getting the id of the product

			/*
				if charge successful save as orders in orders table with following
			*/
			//store info in orders table along with customer info
			/*$response = json_encode([
					'msg'				=> 'Charge successful',
					'amount'			=> ($charge->amount / 100), //again convert amount to usd from pence :D
					'status'			=> $charge->status,
					'transaction_id'	=> $charge->id,
					'captured'			=> $charge->captured,
					'created'			=> $charge->created,
					'currency'			=> $charge->currency,
					'description'		=> $charge->description,
					'paid'				=> $charge->paid
				]);*/
			$response = json_encode($charge);

		} else {
			$response = json_encode([
					'errors' => ['Charge failed', $e->getMessage()]
				]);
		}

	} catch (Exception $e) {
		//print_r($charge);
		$response = json_encode([
				'errors' => $e->getMessage()
			]);
	}
}
$data = json_decode($response);
print_r($data);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$wpdb->insert( 
    'tbl_orders2', 
    array( 
        'id' => $data->id,
		'cname' => $cname,
		'cemail' => $email,
		'entity' => 'order',
		'amount' => $data->amount/100,
		'currency' => 'USD',
		'receipt' => '',
		'status' => 'created',
		'attempts' => 0,
		'notes' => $description,
		'created_at' => date('Y-m-d H:i:s'),
    )
);
$wpdb->insert( 
    'tbl_payment2', 
    array( 
        'id' => $data->id,
		'entity' => 'payment',
		'amount' => $data->amount/100,
		'currency' => "USD",
		'status' => "captured",
		'method' => $data->payment_method_details->type,
		'order_id' => $data->id,
		'description' => $description,
		'international' => 0,
		'refund_status' => '',
		'amount_refunded' => 0,
		'captured' => $data->captured,
		'email' => $email,
		'customer' => $data->customer,
		'contact' => '',
		'fee' => 0,
		'tax' => 0,
		'error_code' => '',
		'error_description' => '',
		'notes' => $description,
		'card_id' => $data->source->id,
		'bank' => '',
		'wallet' => '',
		'vpa' => '',
		'created_at' => date('Y-m-d H:i:s'),
    )
);
echo $response;