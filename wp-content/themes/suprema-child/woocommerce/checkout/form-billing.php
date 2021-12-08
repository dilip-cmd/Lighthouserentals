<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>





<div class="woocommerce-billing-fields">
	   	<div class="checkout-col-set" id="customer_details">
	      	<div class="checkout-page-form-field">
	         	<div class="woocommerce-billing-fields">
	         		
		            <div class="woocommerce-billing-fields__field-wrapper">
		            	<div class="step-main-cont checkout-your-dtl">	
		            	  <span class="step-count" >1</span>
		            	 <div class="after-step-dtl">
		                 <h4 class="step-form-head">Your Details</h4>
		            	<p class="form-row form-row-first thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_first_name_field" data-priority="10">
		            		<label for="billing_first_name" class="">First Name&nbsp;<abbr class="required" title="required">*</abbr></label>
		            		<span class="woocommerce-input-wrapper">
		            			<input type="text" class="input-text " name="billing_first_name" id="billing_first_name" placeholder="First name" value="" autocomplete="given-name">
		            		</span>
		            	</p>
		            	<p class="form-row form-row-last thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_last_name_field" data-priority="20">
		            		<label for="billing_last_name" class="">Last name&nbsp;<abbr class="required" title="required">*</abbr></label>
		            		<span class="woocommerce-input-wrapper">
		            			<input type="text" class="input-text " name="billing_last_name" id="billing_last_name" placeholder="Last name" value="" autocomplete="family-name">
		            		</span>
		            	</p>
		            	<p class="form-row form-row-first thwcfd-field-wrapper thwcfd-field-tel validate-required validate-phone" id="billing_phone_field" data-priority="100">
		            		<label for="billing_phone" class="">Mobile Phone Number&nbsp;<abbr class="required" title="required">*</abbr></label>
		            		<span class="woocommerce-input-wrapper">
		            			<input type="tel" class="input-text " name="billing_phone" id="billing_phone" placeholder="Mobile Phone Number" value="" autocomplete="tel">
		            		</span>
		            	</p>
		            	<p class="form-row form-row-last address-field update_totals_on_change thwcfd-field-wrapper thwcfd-field-country validate-required" id="billing_country_field" data-priority="40">
		                  <label for="billing_role_on_set" class="">Role on Set&nbsp;<abbr class="required" title="required">*</abbr></label>
		                  <span class="woocommerce-input-wrapper">
		                     <select name="billing_role_on_set" id="billing_role_on_set" class="country_to_state country_select select2-hidden-accessible" autocomplete="country" data-placeholder="Role on Set" data-label="County" tabindex="-1" aria-hidden="true">
		                        <option value="">Role on Set</option>
		                        <option value="1">1</option>
		                        <option value="2">2</option>
		                        <option value="3">3</option>
		                        
		                     </select>
		                 </span>
		             </p>
		              </div>
		          </div>
		             <div class="step-main-cont checkout-production-dtl">
		             <span class="step-count" >2</span>
		              <div class="after-step-dtl">
		           	 <h4 class="step-form-head">Production's Details</h4>

		           	 <p class="form-row form-row-first thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_job_name_field" data-priority="10">
		            		<label for="billing_job_name" class="">Job Name&nbsp;<abbr class="required" title="required">*</abbr></label>
		            		<span class="woocommerce-input-wrapper">
		            			<input type="text" class="input-text " name="billing_job_name" id="billing_job_name" placeholder="Job Name" value="" autocomplete="given-name">
		            		</span>
		            	</p>
		            	<p class="form-row form-row-last thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_job_type_field" data-priority="10">
		            		<label for="billing_job_type" class="">Job Type&nbsp;<abbr class="required" title="required">*</abbr></label>
		            		<span class="woocommerce-input-wrapper">
		            			<input type="text" class="input-text " name="billing_job_type" id="billing_job_type" placeholder="Job Type" value="" autocomplete="given-name">
		            		</span>
		            	</p>
		            </div>
		             </div>
		             	<div class="step-main-cont checkout-billing-info">
		            	<span class="step-count" >3</span>
		           	 	<div class="after-step-dtl">
		        
		           	 	<h4 class="step-form-head">Billing Information</h4>
		           	 	<div class="cust-info-radio-formwrp form-row form-row-wide thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_default_info_field" data-priority="10">

		           	 	<div class="checkout_radio">
		           	 		 <span class="woocommerce-input-wrapper cust-radio-wrp">
		            			<input type="radio" class="input-radio " name="billing_default_info" id="billing_default_info" value="default_info" autocomplete="given-name">
		            			<span class="checkmark"></span>
		            		</span>
		            		<label for="billing_default_billing_information" class="">Use Default billing information<abbr class="required" title="required">*</abbr></label>
		           	 		
		           	 	</div>

		            		<div class="cust-info-radio">
		            		
			            	<table>
			            		<tr>
			            			<td>Job Name</td>
			            			<td>The HandymanShort Film</td>
			            		</tr>
			            		<tr>		            			
			            			<td>Billing Contact</td>
			            			<td>Jason Albury</td>
			            		</tr>
			            		<tr>
			            			<td>Company Name</td>
			            			<td>SAVAGE Film Services</td>
			            		</tr>
			            		<tr>
			            			<td>Address</td>
			            			<td>7 / 345 Plummer St Port Melbourne</td>
			            		</tr>
			            	</table>
			               </div>
		            	</div>

		            	<div class=" cust-info-radio-formwrp form-row form-row-wide thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_default_info_field" data-priority="10">

		            	<div class="checkout_radio">
	            			<span class="woocommerce-input-wrapper cust-radio-wrp">
	            				<input type="radio" class="input-radio " name="billing_custom_info" id="billing_custom_info" value="custom_info" autocomplete="given-name">
	            				<span class="checkmark"></span>
	            			</span>		            		
		            		<label for="billing_custom_billing_information" class="">Use Custom Billing Information<abbr class="required" title="required">*</abbr></label>
		            	</div>


		            		<div class="cust-info-radio">
		            		

		            		<p class="form-row form-row-first thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_first_name_field" data-priority="10">
			            		<label for="billing_first_name" class="">First Name&nbsp;<abbr class="required" title="required">*</abbr></label>
			            		<span class="woocommerce-input-wrapper">
			            			<input type="text" class="input-text " name="billing_first_name" id="billing_first_name" placeholder="First Name" value="" autocomplete="given-name">
			            		</span>
			            	</p>

			            	<p class="form-row form-row-first thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_last_name_field" data-priority="10">
			            		<label for="billing_last_name" class="">Last Name&nbsp;<abbr class="required" title="required">*</abbr></label>
			            		<span class="woocommerce-input-wrapper">
			            			<input type="text" class="input-text " name="billing_last_name" id="billing_last_name" placeholder="Last Name" value="" autocomplete="given-name">
			            		</span>
			            	</p>

			            	<p class="form-row form-row-first thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_email_address_field" data-priority="10">
			            		<label for="billing_email_aadress" class="">Email Address&nbsp;<abbr class="required" title="required">*</abbr></label>
			            		<span class="woocommerce-input-wrapper">
			            			<input type="text" class="input-text " name="billing_email_aadress" id="billing_email_aadress" placeholder="Last Name" value="" autocomplete="given-name">
			            		</span>
			            	</p>

		            		<p class="form-row form-row-first thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_contact_field" data-priority="10">
			            		<label for="billing_phone_number" class="">Phone Number&nbsp;<abbr class="required" title="required">*</abbr></label>
			            		<span class="woocommerce-input-wrapper">
			            			<input type="text" class="input-text " name="billing_phone_number" id="billing_phone_number" placeholder="Billing Contact" value="" autocomplete="given-name">
			            		</span>
			            	</p>
			            	<!-- <p class="form-row form-row-last thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_company_name_field" data-priority="10">
			            		<label for="billing_company_name" class="">Company Name&nbsp;<abbr class="required" title="required">*</abbr></label>
			            		<span class="woocommerce-input-wrapper">
			            			<input type="text" class="input-text " name="billing_company_name" id="billing_company_name" placeholder="Company name" value="" autocomplete="given-name">
			            		</span>
			            	</p> -->
			            	<p class="form-row form-row-wide thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_address_field" data-priority="10">
			            		<label for="billing_address" class="">Address line 1&nbsp;<abbr class="required" title="required">*</abbr></label>
			            		<span class="woocommerce-input-wrapper">
			            			<input type="text" class="input-text " name="billing_address" id="billing_address" placeholder="Address line 1" value="" autocomplete="given-name">
			            		</span>
			            	</p>
			            	<p class="form-row form-row-wide thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_address2_field" data-priority="10">
			            		<label for="billing_address2" class="">Address line 2&nbsp;<abbr class="required" title="required">*</abbr></label>
			            		<span class="woocommerce-input-wrapper">
			            			<input type="text" class="input-text " name="billing_address2" id="billing_address2" placeholder="Address line 2" value="" autocomplete="given-name">
			            		</span>
			            	</p>

			            	<p class="form-row form-row-wide thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_city_field" data-priority="10">
			            		<label for="billing_city" class="">City&nbsp;<abbr class="required" title="required">*</abbr></label>
			            		<span class="woocommerce-input-wrapper">
			            			<input type="text" class="input-text " name="billing_city" id="billing_city" placeholder="City" value="" autocomplete="given-name">
			            		</span>
			            	</p>

			            	<p class="form-row form-row-wide thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_state_field" data-priority="10">
			            		<label for="billing_state" class="">State&nbsp;<abbr class="required" title="required">*</abbr></label>
			            		<span class="woocommerce-input-wrapper">
			            			<input type="text" class="input-text " name="billing_state" id="billing_state" placeholder="State" value="" autocomplete="given-name">
			            		</span>
			            	</p>

			            	<p class="form-row form-row-wide thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_post_code_field" data-priority="10">
			            		<label for="billing_post_code" class="">Post Code&nbsp;<abbr class="required" title="required">*</abbr></label>
			            		<span class="woocommerce-input-wrapper">
			            			<input type="text" class="input-text " name="billing_post_code" id="billing_post_code" placeholder="Post Code" value="" autocomplete="given-name">
			            		</span>
			            	</p>
			            	<p class="form-row form-row-wide thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_job_number_field" data-priority="10">
			            		<label for="billing_job_number" class="">Purchase Order Number / Internal Job Number&nbsp;<abbr class="required" title="required">*</abbr></label>
			            		<span class="woocommerce-input-wrapper">
			            			<input type="text" class="input-text " name="billing_job_number" id="billing_job_number" placeholder="Job Number" value="" autocomplete="given-name">
			            		</span>
			            	</p>
			            </div>
		            	</div>
		            	 </div>
		            	</div>
		            	<div class="step-main-cont checkout-payment-dtl">
		            	<span class="step-count" >4</span>
		            	<div class="after-step-dtl">
		           	 	<h4 class="step-form-head">Payment Details</h4>

		           	 	<p class="form-row form-row-wide  thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_pay_now_field" data-priority="10">
		            		
		           	 		<div class="checkout_radio">		           	 			
			            		<span class="woocommerce-input-wrapper  cust-radio-wrp">
			            			<input type="radio" class="input-radio " name="billing_pay_now" id="billing_pay_now" value="Pay Now" autocomplete="given-name">
			            			<span class="checkmark"></span>
			            		</span>
			            		<label for="billing_pay_now" class="">Pay Now (Recommended)<span>Pay for your order securely online and rest easy that your job is all good to go.</span></label>
		           	 		</div>

		            		<div class="cust-info-radio">
			            	<div class="pay_now payment_section">
			            		<p class="form-row form-row-wide thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_name_on_card_field" data-priority="10">
				            		<label for="billing_name_on_card" class="">Name on card&nbsp;<abbr class="required" title="required">*</abbr></label>
				            		<span class="woocommerce-input-wrapper">
				            			<input type="text" class="input-text " name="billing_name_on_card" id="billing_name_on_card" placeholder="Name on card" value="" autocomplete="given-name">
				            		</span>
				            	</p>
				            	<p class="form-row form-row-wide thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_card_number_field" data-priority="10">
				            		<label for="billing_card_number" class="">Card Number&nbsp;<abbr class="required" title="required">*</abbr></label>
				            		<span class="woocommerce-input-wrapper">
				            			<input type="text" class="input-text " name="billing_card_number" id="billing_card_number" placeholder="Card Number" value="" autocomplete="given-name">
				            		</span>
				            	</p>
				            	<p class="form-row form-row-first thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_expiry_date_field" data-priority="10">
				            		<label for="billing_expiry_date" class="">Expiry Date&nbsp;<abbr class="required" title="required">*</abbr></label>
				            		<span class="woocommerce-input-wrapper">
				            			<input type="text" class="input-text " name="billing_expiry_date" id="billing_expiry_date" placeholder="MM/YY" value="" autocomplete="given-name">
				            		</span>
				            	</p>
				            	<p class="form-row form-row-last thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_cvv_field" data-priority="10">
				            		<label for="billing_cvv" class="">CVV&nbsp;<abbr class="required" title="required">*</abbr></label>
				            		<span class="woocommerce-input-wrapper">
				            			<input type="text" class="input-text " name="billing_cvv" id="billing_cvv" placeholder="CVV" value="" autocomplete="given-name">
				            		</span>
				            	</p>
			            	</div>
			            </div>
		            	</p>
		            	<p class="form-row form-row-wide  thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_pay_now_field" data-priority="10">
		            	
		            	<div class="checkout_radio">
		            		<span class="woocommerce-input-wrapper  cust-radio-wrp">
		            			<input type="radio" class="input-radio " name="billing_pay_now" id="billing_pay_now" value="Pay Now" autocomplete="given-name">
		            			<span class="checkmark"></span>
		            		</span>
		            		<label for="billing_pay_now" class="">Pay Later<span>Pay in store on equipment collection or with a 30-day account if your company has been approved for 30-day terms.</span></label>
		            		<p class="error">Unless you have been approved for a 30-day accountthis ordermust be paid on or before the pickup date. Don’t worry, we’ll emailyou this to remind it.</p>
			            	
			            </div>
		            	</p>
		            	<p class="form-row form-row-wide  thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_pay_now_field" data-priority="10">
		            		
		            		<div class="checkout_radio">
		            		<span class="woocommerce-input-wrapper  cust-radio-wrp">
		            			<input type="radio" class="input-radio " name="billing_pay_now" id="billing_pay_now" value="Pay Now" autocomplete="given-name">
		            			<span class="checkmark"></span>
		            		</span>
		            		<label for="billing_pay_now" class="">Delegate Payment <span>If you’re booking gear on behalf of a production, you can assign a billing contact so we liaise with you about equipment and them about payment.</span></label>
		            			
		            		</div>

		            		<div class="cust-info-radio">
			            	<div class="pay_now payment_section">
			            		<label for="billing_pay_now" class="">Billing Contact <span>Please enter the details of your billing contact. When you press "Reserve Equipment", we will contact your billing contact to organise billing details and payment</span></label>
			            		<p class="form-row form-row-wide thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_name_on_card_field" data-priority="10">
				            		<label for="billing_name_on_card" class="">First Name&nbsp;<abbr class="required" title="required">*</abbr></label>
				            		<span class="woocommerce-input-wrapper">
				            			<input type="text" class="input-text " name="billing_name_on_card" id="billing_name_on_card" placeholder="First Name" value="" autocomplete="given-name">
				            		</span>
				            	</p>
				            	<p class="form-row form-row-wide thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_card_number_field" data-priority="10">
				            		<label for="billing_card_number" class="">Last Name&nbsp;<abbr class="required" title="required">*</abbr></label>
				            		<span class="woocommerce-input-wrapper">
				            			<input type="text" class="input-text " name="billing_card_number" id="billing_card_number" placeholder="Last Name" value="" autocomplete="given-name">
				            		</span>
				            	</p>
				            	<p class="form-row form-row-wide thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_card_number_field" data-priority="10">
				            		<label for="billing_card_number" class="">Mobile Phone Number&nbsp;<abbr class="required" title="required">*</abbr></label>
				            		<span class="woocommerce-input-wrapper">
				            			<input type="text" class="input-text " name="billing_card_number" id="billing_card_number" placeholder="Mobile Phone Number" value="" autocomplete="given-name">
				            		</span>
				            	</p>
				            	<p class="form-row form-row-wide thwcfd-field-wrapper thwcfd-field-text validate-required" id="billing_card_number_field" data-priority="10">
				            		<label for="billing_card_number" class="">Email&nbsp;<abbr class="required" title="required">*</abbr></label>
				            		<span class="woocommerce-input-wrapper">
				            			<input type="text" class="input-text " name="billing_card_number" id="billing_card_number" placeholder="Email" value="" autocomplete="given-name">
				            		</span>
				            	</p>
				            	
			            	</div>
			            </div>
		            	</p>
		            	 </div>
		            	</div>
		            </div>
	        	</div>
	    	</div>
		</div>
	
	
	
</div>


