<?php 
/**
 * template name: Make Payment
 */
get_header();

require_once('wp-config.php');
$dir = get_stylesheet_directory().'/stripe/config.php';
require($dir);
	
//global $wpdb;

if(isset($_POST['make_payment'])){

	$errors = [];

		$token = $payment_amount = $first_name = $last_name = $email = $card_number = $ex_date = $cvv = "";
		$payment_amount = 0;

			echo "<pre>";print_r($_POST);exit();

		if (!empty($_REQUEST['stripeToken'])) {
	  $token = $_REQUEST['stripeToken'];
	} else {
	  $errors[] = "Stripe token missing";
	}
			

		if ( isset($_REQUEST['payment_amount']) && !empty($_REQUEST['payment_amount'])) {
		  $payment_amount = $_REQUEST['payment_amount'];
		} else {
		  $errors[] = "Amount missing";
		}

		if ( isset($_REQUEST['first_name']) && !empty($_REQUEST['first_name'])) {
		  $first_name = $_REQUEST['first_name'];
		} else {
		  $errors[] = "First Name missing";
		}

		if ( isset($_REQUEST['last_name']) && !empty($_REQUEST['last_name'])) {
		  $last_name = $_REQUEST['last_name'];
		} else {
		  $errors[] = "Last Name missing";
		}

		if ( isset($_REQUEST['email']) && !empty($_REQUEST['email'])) {
		  $email = $_REQUEST['email'];
		} else {
		  $errors[] = "Email missing";
		}

		if ( isset($_REQUEST['card_number']) && !empty($_REQUEST['card_number'])) {
		  $card_number = $_REQUEST['card_number'];
		} else {
		  $errors[] = "Card Number missing";
		}

		if ( isset($_REQUEST['ex_date']) && !empty($_REQUEST['ex_date'])) {
		  $ex_date = $_REQUEST['ex_date'];
		} else {
		  $errors[] = "Expiry Date missing";
		}

		if ( isset($_REQUEST['cvv']) && !empty($_REQUEST['cvv'])) {
		  $cvv = $_REQUEST['cvv'];
		} else {
		  $errors[] = "CVV missing";
		}
		

		

		$response = null;

		if (!empty($errors)) {
		  
		  $response = json_encode(['errors' => $errors]);

		} else {
		  $payment_amount = $payment_amount * 100;

		  try {
		    $email = trim($email);
		      $customer_id = $wpdb->get_var( "SELECT customer FROM stripe_payment where email = '".$email."' order by created_at desc limit 1" );
		     
		      if($customer_id){
		        $customerId = $customer_id;
		      }else{
		        $customer = \Stripe\Customer::create([
		          'email' => $email,
		          'source'  => $token,
		        ]);
		        $customerId = $customer->id;
		      }
		      
		      $charge = \Stripe\Charge::create([
		          'customer' => $customerId,
		          'amount'   => $payment_amount,
		          'currency' => "USD",
		      ]);

		    if ($charge->status == 'succeeded') {

		      $wpdb->insert( 
		        'wp_stripe_orders', 
		          array( 
		            'id' => $charge->id,
		            'cname' => $first_name,
		            'cemail' => $email,
		            'entity' => 'order',
		            'amount' => $charge->amount/100,
		            'currency' => "USD",
		            'receipt' => '',
		            'status' => 'created',
		            'attempts' => 0,
		            'notes' => $description,
		            'created_at' => date('Y-m-d H:i:s'),
		          )
		      );
		      $wpdb->insert( 
		        'wp_stripe_payment', 
		          array( 
		            'id' => $charge->id,
		            'entity' => 'payment',
		            'amount' => $charge->amount/100,
		            'currency' => "USD",
		            'status' => "captured",
		            'method' => $charge->payment_method_details->type,
		            'order_id' => $charge->id,
		            'description' => $description,
		            'international' => 0,
		            'refund_status' => '',
		            'amount_refunded' => 0,
		            'captured' => $charge->captured,
		            'email' => $email,
		            'customer' => $charge->customer,
		            'contact' => '',
		            'fee' => 0,
		            'tax' => 0,
		            'error_code' => '',
		            'error_description' => '',
		            'notes' => $description,
		            'card_id' => $charge->source->id,
		            'bank' => '',
		            'wallet' => '',
		            'vpa' => '',
		            'created_at' => date('Y-m-d H:i:s'),
		          )
		      );
		            
		      header('Location: https://lighthouserentals.mobilegiz.com/stripethankyou.php');
		      exit;
		    } else {
		      $response = json_encode([
		        'errors' => ['Charge failed', $e->getMessage()]
		      ]);
		    }

		  } catch (Exception $e) {
		    $response = json_encode([
		      'errors' => $e->getMessage()
		    ]);
		  }
		}
			
}







?>
<form method="POST" name="payment_form">   
	
	<div class="form-row">
			<label class="label">
				<b>Payment Amount</b>				
			</label>
			<input type="text" class="input-text" name="payment_amount" placeholder="Payment Amount" value="">
	</div>
	<div class="form-row half-row form-row-first">
			<label>
				First Name
			</label>
			<input type="text" class="input-text" name="first_name" placeholder="First Name" value="">
	</div>
	<div class="form-row half-row  form-row-last">
			<label>
				Last Name
			</label>
			<input type="text" class="input-text" name="last_name" placeholder="Last Name" value="">
	</div>
	<div class="form-row ">
			<label>
				Email
			</label>
			<input type="email" class="input-text" name="email" placeholder="Email" value="">
	</div>

   	<div class="credit-card-dtl">
   		<div class="credit-card-dtl-head">
   			<h6>Credit Card Details</h6>
   			<p>Lighthouse Rentals does not store credit card information.</p>
   		</div>

   		<div class="form-row">
			<label>
				Card Number
			</label>
			<input type="tel" class="input-text" name="card_number" placeholder="Card Number" value="">
	  	</div>
	  	<div class="form-row half-row form-row-first">
			<label>
				Expiry Date
			</label>
			<input type="tel" class="input-text" name="ex_date" placeholder="MM/YY" value="">
		</div>
		<div class="form-row half-row  form-row-last">
				<label>
					CVV
				</label>
				<input type="text" class="input-text" name="cvv" placeholder="***" value="">
		</div>
		
   	</div>	
   	<div class="make-payment-submitbtn">
   		<input type="hidden" name="currency" value="usd" id="currency">
   		<script src="https://checkout.stripe.com/checkout.js" class="stripe-button btn_cn"
					          data-key="<?php echo $stripe['publishable_key']; ?>"
					          data-description="Access for a year"
					          data-amount="<?php echo $amount;?>"
					          data-locale="auto"
					          data-currency="usd"></script>
   		<!-- <input type="submit" name="make_payment" class="site-btn btn-arrow" value="Make Payment"> -->
	</div>
</form>

<?php 
get_footer();
?>