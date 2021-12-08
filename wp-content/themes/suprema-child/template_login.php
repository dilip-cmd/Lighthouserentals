<?php 
/**
 * template name: Customer Custom Login Template
 */
get_header();
?>
<div class="login-main">
<div class="qodef-container login-wrp ">
	<div class="qodef-container-inner clearfix">
		<div class="woocommerce">
			<div class="woocommerce-notices-wrapper"></div>
			<div class="u-columns col2-set login-page" id="customer_login">
				
				<div class="u-column1 login-form">
					<h1 class="main-head">Login</h1>
					<?php
					echo do_shortcode("[wc_login_form_bbloomer]");
					?>
					<div class="new-user-login">New User?<a href=<?php echo site_url()."/register/"; ?>>Create Account</a></div>
					<div class="or-connect">
					<p class="or-connect-txt">Or connect with social media</p>
					<div class="social-media">
						<a href="#" class="login-fb"><i class="fa fa-facebook" aria-hidden="true"></i>Login with Facebook</a>
						<a href="#" class="login-google"><i class="fa fa-google" aria-hidden="true"></i>Login with Google</a>
					</div>
				    </div>
				</div>
				<div class="u-column1 login-img">
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