
<?php include('rp_config.php'); //include('wp-config.php'); ?>
<?php
if(isset($_SESSION)){
session_destroy();
}
get_header();
 ?>	

<body class="page-template-default page page-id-196 logged-in admin-bar no-customize-support">
<section id="">
	<div class="aboutcondiv">
		<div class="aboutcontent">
			
			<div class="innercnt">
				<div class="mtp commonpages">

					<article id="post-196" class="post-196 page type-page status-publish hentry">
						<header class="entry-header"><h1 class="entry-title" style="font-size: 18px; margin-top: 20px;">Thank You</h1></header>
						<div class="entry-content" style="text-align: center;">
						<div class="frm_wrap">
							<strong style="font-size: 14px;">Your payment has been made successfully.</strong>						
						</div>
						
						
						</div>
					</article>

				</div>
			</div>
			
		</div>			
	</div>
</section>
</body>
<?php 
get_footer();
?>