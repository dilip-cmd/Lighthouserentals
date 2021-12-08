<?php /* Template Name: Stripe Payment Template */ ?>
<?php get_header();
use \PhpPot\Service\StripePayment;

require (get_stylesheet_directory()."/vendor/config.php");

if (!empty($_POST["token"])) {
    require (get_stylesheet_directory().'/vendor/StripePayment.php');
    $stripePayment = new StripePayment();
    
    $stripeResponse = $stripePayment->chargeAmountFromCard($_POST);
    
    require (get_stylesheet_directory()."/vendor/DBController.php");
    $dbController = new DBController();
    
    $amount = $stripeResponse["amount"] /100;
    
    $param_type = 'ssdssss';
    $param_value_array = array(
        $_POST['email'],
        $_POST['item_number'],        
        $amount,
        $stripeResponse["currency"],
        $stripeResponse["balance_transaction"],
        $stripeResponse["status"],
        json_encode($stripeResponse),
        $_POST['radio'],
        $_POST['job_refe']
    );
   // $query = "INSERT INTO wp_tbl_payment (email, item_number, amount, currency_code, txn_id, payment_status, payment_response,job_type,job_refe) values (?, ?, ?, ?, ?, ?, ?,?,?)";
    global $wpdb;
    $query = "INSERT INTO wp_tbl_payment ( email, item_number, amount, currency_code, txn_id, payment_status, payment_response,job_type,job_refe )VALUES( '".$_POST['email']."', '".$_POST['item_number']."', '".$amount."', '".$stripeResponse["currency"]."', '".$stripeResponse["balance_transaction"]."', '".$stripeResponse["status"]."', '".json_encode($stripeResponse)."', '".$_POST['radio']."', '".$_POST['job_refe']."' )";

    $Insert_mamber = $wpdb->get_results($query); 




    //$id = $dbController->insert($query, $param_type);
    
    if ($stripeResponse['amount_refunded'] == 0 && empty($stripeResponse['failure_code']) && $stripeResponse['paid'] == 1 && $stripeResponse['captured'] == 1 && $stripeResponse['status'] == 'succeeded') {

        
        $to = "accounts@savagegroup.com.au";
        $subject = "Light House Make a Payment";

        $message = "
        <html>
        <head>
        <title>Light House Make a Payment</title>
        <style>
            h4{
                text-align: center;font-size: 25px;font-weight: bold;
            }
            table.paylemt{
                border: 1px solid black;text-align: center;margin: auto;padding: 10px;
                border-collapse: collapse;
            }
            table.paylemt, .paylemt td, .paylemt th {
              border: 1px solid black;
            }
            table.paylemt td, table.paylemt th{padding:10px;
            }
        </style>
        </head>
        <body>
        <h4 >Make a Payment</h4>
        <table class='paylemt'>
        <tr>
        <th>Email</th>
        <th>Job Type</th>
        <th>Job Reference</th>
        <th>Amount</th>
        <th>Response</th>
        </tr>
        <tr>
        <td>".$_POST['email']."</td>
        <td>".$_POST['radio']."</td>
        <td>".$_POST['job_refe']."</td>
        <td>$".$amount."</td>
        <td>".$stripeResponse["balance_transaction"]."</td>
        </tr>
        </table>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        //$headers .= 'From: <afzal@webtechsystem.com>' . "\r\n";

        mail($to,$subject,$message,$headers);



        $successMessage = "Stripe payment is completed successfully. The TXN ID is " . $stripeResponse["balance_transaction"];
    }
}

?>

<!-- ============================================== -->
<div class="qodef-container">    
    <div class="qodef-container-inner clearfix">
        <div class="vc_row wpb_row vc_row-fluid qodef-section make-payment-rw inn-pad-50 qodef-content-aligment-left qodef-grid-section" style="">
            <div class="clearfix qodef-section-inner">
                <div class="qodef-section-inner-margin clearfix">
                    <div class="wpb_column vc_column_container vc_col-sm-6">
                        <div class="vc_column-inner">
                            <div class="wpb_wrapper">
                                <div data-qodef-parallax-speed="1" class="vc_row wpb_row vc_inner vc_row-fluid qodef-section qodef-content-aligment-left" style="">
                                    <div class="qodef-full-section-inner">
                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner">
<div class="wpb_wrapper">
    <?php if(!empty($successMessage)) { ?>
        <div id="success-message"><?php echo $successMessage; ?></div>
    <?php  } ?>
    <div id="error-message"></div>
    <div class="wpb_text_column wpb_content_element  make-payment-top">
        <div class="wpb_wrapper">
            <h3>Make a Payment</h3>
<p>Owe us money? We want it! Complete the below form to make payment for a Lighthouse Rentals or SAVAGE Film Services Job.</p>
<p>If you have a question about payments or need support with payments, don’t hesitate to contact the SAVAGE Group Accounts Department via phone on <a href="tel:(03) 8657 5007">(03) 8657 5007</a> or you can email us at <a href="mailto:account@savagegroup.com.au">account@savagegroup.com.au</a></p>

        </div>
    </div>

    <div class="wpb_raw_code wpb_content_element wpb_raw_html make-payment-form">
        <div class="wpb_wrapper">
            <form id="frmStripePayment" action="" method="post">
   <div class="form-row">
         <label class="label">
                <b>Job Type</b>
                Which company are you making a payment for?
         </label>
         <div class="custom-radio-group">
         <div class="custom-radio">
              <input type="radio" name="radio" id="lighthouserentals" value="Lighthouse Rentals">
             
              <label class="cust-radio-img" for="lighthouserentals">
                    <span class="radiobtn"></span>
                    <span class="cust-radio-imgbx">
                        <img src="https://lighthouserentals.com.au/wp-content/uploads/2021/08/lighthouse-input.png" alt="" class="alignnone size-full wp-image-124797" width="241" height="106">
                        <span class="cust-radio-title">Lighthouse Rentals</span>
                    </span>
                    
              </label>
        </div>
        <div class="custom-radio">
              <input type="radio" name="radio" id="savage-film" value="SAVAGE Film Services">
             
               <label class="cust-radio-img" for="savage-film">
                 <span class="radiobtn"></span>
                    <span class="cust-radio-imgbx">
                        <img src="https://lighthouserentals.com.au/wp-content/uploads/2021/08/savage-group-input.png" alt="" class="alignnone size-full wp-image-124798" width="236" height="108">
                        <span class="cust-radio-title">SAVAGE Film Services</span>
                    </span>
                    
              </label>
        </div>  
    </div>

    </div>
    <div class="form-row">
            <label class="label">
                <b>Job Reference</b>
                This can be your Quote Number, Order Reference Number or even just your name. Once you submit a payment on this form we’ll email you a receipt for the transaction you have made.   
            </label>
            <input type="text" class="input-text" id="job_refe" placeholder="Job Reference" name="job_refe" value="">
    </div>
    <div class="form-row">
            <label class="label">
                <b>Payment Amount</b>
                Don’t forget to include the GST amount when making a payment. Additionally, we all love collecting credit card points, but  credit card fees can be pretty high. We will be passing on the cost of any <a href="#">credit card processing fees</a> on payments over $2000.  
            </label>
            <input type="text" id="amount" name="amount" placeholder="Payment Amount" class="demoInputBox">
    </div>
    <div class="form-row half-row form-row-first">
            <label>
                First Name
            </label>
            <input type="text" id="fname" name="fname" placeholder="First Name" class="demoInputBox">
    </div>
    <div class="form-row half-row  form-row-last">
            <label>
                Last Name
            </label>
           <input type="text" id="lname" name="lname" placeholder="Last Name" class="demoInputBox">
    </div>
    <div class="form-row ">
            <label>
                Email
            </label>
            <input type="text" id="email" name="email" placeholder="Email" class="demoInputBox">
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
            <input type="text" id="card-number" name="card-number" placeholder="Card Number" class="demoInputBox">
      </div>
      <div class="form-row half-row form-row-first">
            <label>
                Expiry Date
            </label>
            
            <div class="contact-row column-right">
            <span id="userEmail-info" class="info"></span><br>
            <select name="month" id="month" class="demoSelectBox">
                <option selected="selected">MM</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <select name="year" id="year" class="demoSelectBox">
                <option selected="selected">YY</option>
                <option value="18">2018</option>
                <option value="19">2019</option>
                <option value="20">2020</option>
                <option value="21">2021</option>
                <option value="22">2022</option>
                <option value="23">2023</option>
                <option value="24">2024</option>
                <option value="25">2025</option>
                <option value="26">2026</option>
                <option value="27">2027</option>
                <option value="28">2028</option>
                <option value="29">2029</option>
                <option value="30">2030</option>
            </select>
        </div>
    </div>
    <div class="form-row half-row  form-row-last">
            <label>
                CVV
            </label>
            <input type="text" name="cvc" id="cvc" placeholder="***" class="demoInputBox cvv-input">
    </div>
    <div class="all-visa-txt"><p>all visa/mastercard credit card transactions incur a 0.78% surcharge.<br> amex credit card transactions incur a 1.75% surcharge.</p></div>
   </div>   
   <div class="make-payment-submitbtn">
        <input type="submit" name="pay_now" value="pay securely online" id="submit-btn" class="btnAction site-btn btn-arrow" onClick="stripePay(event);">

        <div id="loader">
            <img alt="loader" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/vendor/LoaderIcon.gif">
        </div>
    </div>
    <input type='hidden' name='currency_code' value='USD'>
    <input type='hidden' name='item_name' value='Payment'>
    <input type='hidden' name='item_number' value='PHPPOTEG#1'>


</form>
        </div>
    </div>
</div></div></div></div></div></div></div></div>
<div class="wpb_column vc_column_container vc_col-sm-6 sticky-col"><div class="vc_column-inner"><div class="wpb_wrapper">
    <div class="wpb_single_image wpb_content_element vc_align_left   payment-right-img">
        
        <figure class="wpb_wrapper vc_figure">
            <div class="vc_single_image-wrapper   vc_box_border_grey"><img src="https://lighthouserentals.com.au/wp-content/uploads/2021/08/shake-hands.png" class="vc_single_image-img attachment-full" alt="" loading="lazy" srcset="https://lighthouserentals.com.au/wp-content/uploads/2021/08/shake-hands.png 691w, https://lighthouserentals.com.au/wp-content/uploads/2021/08/shake-hands-300x233.png 300w, https://lighthouserentals.com.au/wp-content/uploads/2021/08/shake-hands-600x465.png 600w, https://lighthouserentals.com.au/wp-content/uploads/2021/08/shake-hands-64x50.png 64w" sizes="(max-width: 691px) 100vw, 691px" width="691" height="536"></div>
        </figure>
    </div>
</div></div></div></div></div></div>
                                                                    </div>
            </div>
<!-- ============================================== -->





<!-- <form id="frmStripePayment" action="" method="post">
    <div class="field-row">
        <label>First Name</label>
        <span id="first-name-info" class="info"></span><br>
        <input type="text" id="fname" name="fname" class="demoInputBox">
    </div>
    <div class="field-row">
        <label>Last Name</label>
        <span id="last-name-info" class="info"></span><br>
        <input type="text" id="lname" name="lname" class="demoInputBox">
    </div>
    <div class="field-row">
        <label>Email</label>
        <span id="email-info" class="info"></span><br>
        <input type="text" id="email" name="email" class="demoInputBox">
    </div>
    <div class="field-row">
        <label>Amount</label>
        <span id="amount-info" class="info"></span><br>
        <input type="text" id="amount" name="amount" class="demoInputBox">
    </div>
    <div class="field-row">
        <label>Card Number</label>
        <span id="card-number-info" class="info"></span><br>
        <input type="text" id="card-number" name="card-number" class="demoInputBox">
    </div>
    <div class="field-row">
        <div class="contact-row column-right">
            <label>Expiry Month / Year</label> 
            <span id="userEmail-info" class="info"></span><br>
            <select name="month" id="month" class="demoSelectBox">
                <option value="08">08</option>
                <option value="09">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <select name="year" id="year" class="demoSelectBox">
                <option value="18">2018</option>
                <option value="19">2019</option>
                <option value="20">2020</option>
                <option value="21">2021</option>
                <option value="22">2022</option>
                <option value="23">2023</option>
                <option value="24">2024</option>
                <option value="25">2025</option>
                <option value="26">2026</option>
                <option value="27">2027</option>
                <option value="28">2028</option>
                <option value="29">2029</option>
                <option value="30">2030</option>
            </select>
        </div>
        <div class="contact-row cvv-box">
            <label>CVC</label>
            <span id="cvv-info" class="info"></span><br>
            <input type="text" name="cvc" id="cvc" class="demoInputBox cvv-input">
        </div>
    </div>
    <div>
        <input type="submit" name="pay_now" value="Submit" id="submit-btn" class="btnAction" onClick="stripePay(event);">

        <div id="loader">
            <img alt="loader" src="<?php //echo get_bloginfo('stylesheet_directory'); ?>/vendor/LoaderIcon.gif">
        </div>
    </div>
    <input type='hidden' name='currency_code' value='USD'>
    <input type='hidden' name='item_name' value='Payment'>
    <input type='hidden' name='item_number' value='PHPPOTEG#1'>
</form> -->

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/vendor/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
<script>
    function cardValidation () {
        var valid = true;
        var amount = $('#amount').val();
        var job_refe = $('#job_refe').val();
        var name = $('#fname').val()+" "+$('#lname').val();
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var email = $('#email').val();
        var cardNumber = $('#card-number').val();
        var month = $('#month').val();
        var year = $('#year').val();
        var cvc = $('#cvc').val();

        var isValid = $("input[name=radio]").is(":checked");

       // alert(isValid);

        $("#error-message").html("").hide();

        if (isValid == false) {
            valid = false;
            $("#error-message").append("Job Type required<br>").show();
        }

        if (amount.trim() == "") {
            valid = false;
            $("#error-message").append("Amount required<br>").show();
        }

        if (job_refe.trim() == "") {
            valid = false;
            $("#error-message").append("Job Reference required<br>").show();
        }

        if (fname.trim() == "") {
            valid = false;
            $("#error-message").append("First Name required<br>").show();
        }
        if (lname.trim() == "") {
            valid = false;
            $("#error-message").append("Last Name required<br>").show();
        }
        if (email.trim() == "") {
            valid = false;
            $("#error-message").append("Email required<br>").show();
        }
        if (cardNumber.trim() == "") {
            valid = false;
            $("#error-message").append("Card Number required<br>").show();
        }

        if (month.trim() == "") {
            valid = false;
            $("#error-message").append("Month required<br>").show();
        }
        if (year.trim() == "") {
            valid = false;
            $("#error-message").append("Year required<br>").show();
        }
        if (cvc.trim() == "") {
            valid = false;
            $("#error-message").append("CVC are required<br>").show();
        }

        if(amount.trim() == "" && job_refe.trim() == "" && fname.trim() == "" && lname.trim() == "" && email.trim() == "" && cardNumber.trim() == "" && month.trim() == "" && year.trim() == "" && cvc.trim() == ""){
            $("#error-message").html("All Fields are required").show();
        }
        /*if(valid == false) {
            $("#error-message").html("All Fields are required").show();
        }*/

        return valid;
    }
    //set your publishable key
    Stripe.setPublishableKey("<?php echo STRIPE_PUBLISHABLE_KEY; ?>");

    //callback to handle the response from stripe
    function stripeResponseHandler(status, response) {
        if (response.error) {
            //enable the submit button
            $("#submit-btn").show();
            $( "#loader" ).css("display", "none");
            //display the errors on the form
            $("#error-message").html(response.error.message).show();
        } else {
            //get token id
            var token = response['id'];
            //insert the token into the form
            $("#frmStripePayment").append("<input type='hidden' name='token' value='" + token + "' />");
            //submit form to the server
            $("#frmStripePayment").submit();
        }
    }
    function stripePay(e) {
        e.preventDefault();
        var valid = cardValidation();

        if(valid == true) {
            $("#submit-btn").hide();
            $( "#loader" ).css("display", "inline-block");
            Stripe.createToken({
                number: $('#card-number').val(),
                cvc: $('#cvc').val(),
                exp_month: $('#month').val(),
                exp_year: $('#year').val()
            }, stripeResponseHandler);

            //submit from callback
            return false;
        }
    }
</script>

<?php /*do_shortcode('[Did_You_Forget]');*/ ?>
<?php do_shortcode('[Did_You_Forget2]'); ?>
<?php get_footer(); ?>