<?php 
/**
 * template name: Customer Custom reg Template
 */
get_header();
?>
<div class="login-main register-main">
<div class="qodef-container login-wrp">
	<div class="qodef-container-inner clearfix">
		<div class="woocommerce">
			<div class="woocommerce-notices-wrapper"></div>
			<div class="u-columns col2-set login-page" id="customer_login">
				<div class="u-column1 col-1 login-form">
					<h1 class="main-head">Register</h1>
					<?php 
					echo do_shortcode("[wc_reg_form_bbloomer]");
					?>
					<div id="message">            
	                  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
	                  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
	                  <p id="number" class="invalid">A <b>number</b></p>
	                  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
	                </div>
				</div>
				<div  class="u-column1 col-2 login-img">
					<img src="<?php echo site_url()."/wp-content/uploads/login_ger.png"; ?>">
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<?php
get_footer();
?>