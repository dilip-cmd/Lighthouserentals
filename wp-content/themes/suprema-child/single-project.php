<?php get_header(); ?>
<script src="<?php echo get_theme_file_uri() ?>/assets/js/owl2.js"></script>
 <script src="<?php echo get_theme_file_uri() ?>/fancybox/jquery.fancybox.js"></script>
<link rel='stylesheet' href='<?php echo get_theme_file_uri() ?>/fancybox/jquery.fancybox.css' type='text/css' media='all' />


<script>

jQuery(document).ready(  function($){

$(".dtl_desk_in .moreinf").click(function(){
  $(this).parents(".dtl_desk_in").toggleClass("active");
});


});



</script>
<script>
jQuery(document).ready(  function($){
$(window).on( 'scroll', function(){
		if ($(window).scrollTop() >= 1) {
			$('body').addClass('fixed');
		} else {
			$('body').removeClass('fixed');
		}
	
	});

});
</script>

<section id="property-tabs" class="property-tabs">
	<div class="worksquare-container ">
		<ul>
			<li><a class="tabs-cnt" href="#photos">Photos</a></li>
			<li><a class="tabs-cnt" href="#summary">Summary</a></li>
			<li><a class="tabs-cnt" href="#amenities">Amenities</a></li>
			<li><a class="tabs-cnt" href="#location">Location</a></li>
			<li><a class="tabs-cnt" href="#availability">Availability</a></li>
			<li><a class="tabs-cnt" href="#rela-prop">Related Property</a></li>
		</ul>
	</div>
</section>


<?php
	
	$digit1 = mt_rand(10,20);
	$digit2 = mt_rand(1,10);
	if( mt_rand(0,1) === 1 ) {
	    $math = "$digit1 + $digit2";
	    $answer = $digit1 + $digit2;
	} else {
	    $math = "$digit1 - $digit2";
	    $answer = $digit1 - $digit2;
	}

?>
<script type="text/javascript">
var temp_count = 0;
jQuery(document).ready(function($){	

	 var width = $(window).width();
     if (width < 767) {
     	$(".single-portfolio .rgt_sticky_bar .sticky-sidebar .a_bav").click(function() {
    $('html, body').animate({
        scrollTop: $(".rgt_sticky_bar .sticky-sidebar").offset().top
    }, 2000);
});
     }
jQuery(document).on('click', '.shortlist_data button.simplefavorite-button.a_short', function() {
		$(this).hide();
	});
 $(".tabs-cnt").click(function(event){
	event.preventDefault();
	$(".tabs-cnt").removeClass("active");
	$(this).addClass("active");
	var offset = $($(this).attr('href')).offset().top - 150; 
	$('html, body').animate({scrollTop:offset}, 500); 
});
    $(".vhmf_select").on("change", function (e){
    	if($(this).val()==''){
    		$(".rs_po h2").text('Private Office');
    	}else{
    		$(".rs_po h2").text($(this).val());

    	}
    });	

	jQuery(".a_bav").click(function(){
		temp_count++;
		$(".calendly-div").html('<div class="calendly-inline-widget" data-url="https://calendly.com/victor-harris/30min/?utm_campaign=<?php echo get_the_title(); ?>&utm_source='+$(".calendly_form select").val()+'" style="min-width:320px;height:630px;"></div>');
		
		$('<script />', { type : 'text/javascript', src : "https://assets.calendly.com/assets/external/widget.js"}).appendTo('.calendly-div');
   	});


   	jQuery(".calendly_form select").change(function(){
   		if(temp_count>0){
			$(".calendly-div").html('<div class="calendly-inline-widget" data-url="https://calendly.com/victor-harris/30min/?utm_campaign=<?php echo get_the_title(); ?>&utm_source='+$(".calendly_form select").val()+'" style="min-width:320px;height:630px;"></div>');
			
			$('<script />', { type : 'text/javascript', src : "https://assets.calendly.com/assets/external/widget.js"}).appendTo('.calendly-div');
		}
   	}); 

	$(".more_cnt").hide();
  	 $(".a_rm").on("click", function () {
  	 	var txt = $(".more_cnt").is(':visible') ? 'Read More' : 'Read Less';
        $(".a_rm").text(txt);
        $('.more_cnt').slideToggle(200);
        $( ".a_rm" ).toggleClass('a_rm_c');
        
    });
	
	

	jQuery('.dtl_owl').loopcarousel({
    navigation : true, 
      pagination :false, 
      slideSpeed : 300,
      paginationSpeed : 400,
      loop:false,
	  margin:0,
	  autoHeight:false,
	  items:1,
		itemsDesktopSmall : [1026, 1],
        itemsTablet : [768, 1],
        itemsTabletSmall : [640, 1],
        itemsMobile : [479, 1],
});
	


	 jQuery(".related_prod .owl-carousel").loopcarousel({
      navigation : true, 
      pagination :false, 
      slideSpeed : 300,
      paginationSpeed : 400,
      loop:true,
	  margin:20,
	  autoHeight:false,
	  items:4,
		itemsDesktopSmall : [1026, 3],
        itemsTablet : [768, 3],
        itemsTabletSmall : [767, 1],
        itemsMobile : [479, 1],
		
		  	  afterAction: function(el){
   this
   .$owlItems
   .removeClass('center')

   //add class active
   this
   .$owlItems 
   .eq(this.currentItem + 1)
   .addClass('center')    
    } 
     });


jQuery(".dtl_rel_slide").loopcarousel({
	     navigation : true, 
      pagination :false, 
      slideSpeed : 300,
      paginationSpeed : 400,
      loop:false,
	  margin:0,
	  autoHeight:false,
	  items:1,
		itemsDesktopSmall : [1026, 1],
        itemsTablet : [768, 1],
        itemsTabletSmall : [640, 1],
        itemsMobile : [479, 1],
	});
	 

	 
jQuery("#sub_btn").click(function() {
        jQuery('.errmsg').remove();
        jQuery('form#enquiry-form input').removeClass('error');
        var bool = 1;
        if (jQuery.trim(jQuery('#mf_name').val()) == '') {
            jQuery('#mf_name').after('<span class="errmsg">Please enter your name.</span>');
            jQuery('#mf_name').addClass('error');
            bool = 0;
        }
		if (jQuery.trim(jQuery('#mf_email').val()) == '') {
            jQuery('#mf_email').after('<span class="errmsg">Please enter your email address.</span>');
            jQuery('#mf_email').addClass('error');
            bool = 0;
        }
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (jQuery.trim(jQuery('#mf_email').val()) != '') {
            if (!jQuery('#mf_email').val().match(mailformat)) {
                jQuery('#mf_email').after('<span class="errmsg">The e-mail address you entered appears to be incorrect. (Example: xxx@xxxx.com)</span>');
                jQuery('#mf_email').addClass('error');
                bool = 0;
            }
        }
        if (jQuery.trim(jQuery('#mf_phone').val()) == '') {
            jQuery('#mf_phone').after('<span class="errmsg">Please enter your phone number.</span>');
            jQuery('#mf_phone').addClass('error');
            bool = 0;
        }
        if (jQuery.trim(jQuery('#mf_comment').val()) == '') {
            jQuery('#mf_comment').after('<span class="errmsg">Please enter your comments.</span>');
            jQuery('#mf_comment').addClass('error');
            bool = 0;
        }
        if (jQuery.trim(jQuery('#mf_captcha').val()) == '') {
            jQuery('#mf_captcha').after('<span class="errmsg">Please enter answer.</span>');
            jQuery('#mf_captcha').addClass('error');
            bool = 0;
        } else if (jQuery('#mf_captcha').val() != "<?php echo $answer ?>") {
            jQuery('#mf_captcha').after('<span class="errmsg">Please enter valid answer.</span>');
            jQuery('#mf_captcha').addClass('error');
            bool = 0;
        }
        if (bool == 0) {
            jQuery("form#enquiry-form input.error:first").focus();
            return false;
        }
    });

	jQuery("#rc_sub_btn").click(function() {
        jQuery('.errmsg').remove();
        jQuery('form#enquiry-form input').removeClass('error');
        var bool = 1;
        if (jQuery.trim(jQuery('#rc_name').val()) == '') {
            jQuery('#rc_name').after('<span class="errmsg">Please enter your name.</span>');
            jQuery('#rc_name').addClass('error');
            bool = 0;
        }
		if (jQuery.trim(jQuery('#rc_phone').val()) == '') {
            jQuery('#rc_phone').after('<span class="errmsg">Please enter your phone number.</span>');
            jQuery('#rc_phone').addClass('error');
            bool = 0;
        }
        if (jQuery.trim(jQuery('#rc_call').val()) == '') {
            jQuery('#rc_call').after('<span class="errmsg">Please enter your best time to call.</span>');
            jQuery('#rc_call').addClass('error');
            bool = 0;
        }
        if (jQuery.trim(jQuery('#rc_captcha').val()) == '') {
            jQuery('#rc_captcha').after('<span class="errmsg">Please enter answer.</span>');
            jQuery('#rc_captcha').addClass('error');
            bool = 0;
        } else if (jQuery('#rc_captcha').val() != "<?php echo $answer ?>") {
            jQuery('#rc_captcha').after('<span class="errmsg">Please enter valid answer.</span>');
            jQuery('#rc_captcha').addClass('error');
            bool = 0;
        }
        if (bool == 0) {
            jQuery("form#enquiry-form input.error:first").focus();
            return false;
        }
    });

    jQuery("#p_sub_btn").click(function() {
        jQuery('.errmsg').remove();
        jQuery('form#enquiry-form input').removeClass('error');
        var bool = 1;

        var response = grecaptcha.getResponse();
		if(response.length == 0){
			jQuery('.p_pcap').append('<span class="errmsg">Captcha validation is required.</span>');
            jQuery('.p_pcap').addClass('error');
            bool = 0;
		}
		
        if (jQuery.trim(jQuery('#p_email').val()) == '') {
            jQuery('#p_email').after('<span class="errmsg">Please enter your email address.</span>');
            jQuery('#p_email').addClass('error');
            bool = 0;
        }
		
		if (bool == 0) {
            jQuery("form#enquiry-form input.error:first").focus();
            return false;
        }
    });
    jQuery('form#pdfsendmail').on('submit', function (e) {
    		action = 'send_pdf';
    		p_email = jQuery('form#pdfsendmail #p_email').val();
            p_title = jQuery('form#pdfsendmail #p_title').val();
    		jQuery.ajax({
						type: 'POST',
						dataType: 'json',
						url: "<?php echo site_url(); ?>/wp-admin/admin-ajax.php",
						data: {
							'action': action,
							'email': p_email,
							'property': p_title
						},
						success: function (data) {
							jQuery('.pdf_mail_form').hide();
							if(data.load == '1') {
								jQuery('p.pdfstatus').text('Your request has been send. We will get back to you as soon as possible.');
							} else {
								jQuery('p.pdfstatus').text('Somthing was wrong! Please try again.');
								}
							}
					});
					e.preventDefault();
    	});
    jQuery(".sticky_sort").click(function(){
	    jQuery(".shortlist_data").animate({
	      width: "toggle"
	    });
    });
	

jQuery(".shortlist_data .sidebar_links .email").fancybox();
jQuery(".shortlist_data .sidebar_links .call").fancybox();
jQuery(".sticky-sidebar .textwidget .a_rcb").fancybox();
jQuery(".sticky-sidebar .openpdf").fancybox();

jQuery('form#mailform').on('submit', function (e) {
					action = 'mail_wishlist';
					mf_name = 	jQuery('form#mailform #mf_name').val();
					mf_email = jQuery('form#mailform #mf_email').val();
					mf_phone = jQuery('form#mailform #mf_phone').val();  
					
					jQuery.ajax({
						type: 'POST',
						dataType: 'json',
						url: "<?php echo site_url(); ?>/wp-admin/admin-ajax.php",
						data: {
							'action': action,
							'name': mf_name,
							'email': mf_email,
							'phone': mf_phone
						},
						success: function (data) {
							jQuery('.st_mail_form').hide();
							if(data.load == '1') {
								jQuery('p.status').text('Your shortlist has been send to your email. Please check your email.');
							} else {
								jQuery('p.status').text('Somthing was wrong! Please try again.');
								}
							}
					});
					e.preventDefault();
		});

jQuery('form#rclistform').on('submit', function (e) {
					action = 'mail_call_back';
					rc_name = 	jQuery('form#rclistform #rc_name').val();
					rc_phone = jQuery('form#rclistform #rc_phone').val();  
					rc_best_time = jQuery('form#rclistform #rc_call').val();  
					
					jQuery.ajax({
						type: 'POST',
						dataType: 'json',
						url: "<?php echo site_url(); ?>/wp-admin/admin-ajax.php",
						data: {
							'action': action,
							'name': rc_name,
							'phone': rc_phone,
							'besttime': rc_best_time,
						},
						success: function (data) {
							jQuery('.rc_mail_form').hide();
							if(data.load == '1') {
								jQuery('p.rc_status').text('Your request has been sent. We will get back to you as soon as possible.');
							} else {
								jQuery('p.rc_status').text('Somthing was wrong! Please try again.');
								}
							}
					});
					e.preventDefault();
		});

});		

</script>
<div style="display:none;" id="pdfmailform" class="st_mail_form">
	<p class="pdfstatus"></p>
	<div class="pdf_mail_form">
		<form class="pdfsendmail" name="pdfsendmail" id="pdfsendmail" method="post">
			<p>Leave your email and we’ll send you a PDF for this property.</p>
			<ul>
			    <input type="hidden" name="p_title" id="p_title" value="<?php the_title(); ?>" />
			    <input type="hidden" name="p_id" id="p_id" value="<?php the_id(); ?>" />
				<li class="full_li"><input type="text" placeholder="Enter your email address" name="p_email" id="p_email" class="txt"></li>
				<li><input type="submit" id="p_sub_btn" name="p_sub_btn" class="txt" value="Submit"></li>
			</ul>
		</form>
	</div>
</div>
<div class="det_hdr">
<div class="container worksquare-container ">
<div class="entry-title">
	<h1 class="title-post fweight-800 text-big-1"><?php the_title(); ?></h1>
	<?php if(get_field('property_location') != "") { ?>
		<p><?php echo get_field('property_location'); ?></p>
	<?php } ?>
</div>

</div>
</div>

<section id="main-container" class="worksquare-container ">
	<div class="row">
		<?php /*if( isset($skyviewcomplex_page_layouts['sidebars']) && !empty($skyviewcomplex_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif;*/ ?>
	<div id="main-content" class="main-content col-xs-12 ">

	<div id="primary" class="content-area ">
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post(); 
					$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
					?>

						<div class="rgt_sticky_bar">
							<div class="col-sm-7">
								 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								 	<div class="dtl_slider_pro">
										<section id="main-container" class="<?php echo apply_filters( 'skyviewcomplex_template_main_content_class', 'container' ); ?> inner">
							<div id="photos" class="owl-carousel-play">

								<?php if(get_field('let_property',$post->ID) != "") { ?>
											<div class="let_img">
												<p>LET</p>
											</div>
									<?php } ?>
							<?php 
							global $is_safari;
							if($is_safari) { if( have_rows('slider_images') ): ?>
								<div class="dtl_owl owl-carousel owl-theme">
									<?php  while ( have_rows('slider_images') ) : the_row(); ?>
											<div class="item">
												<!-- <img src="<?php //echo get_template_directory_uri() ?>/resize.php?src=<?php //the_sub_field('image'); ?>&w=1200&h=800&q=100" alt=""/> -->
												<img src="<?php echo str_replace('webp', 'png', get_sub_field('image')); ?>" alt=""/>
											</div>
										<?php endwhile; ?>
								</div>
								<?php else: ?>
									<div class="dtl_owl owl-carousel owl-theme">
										<div class="item">
											<!-- <img src="<?php //echo get_template_directory_uri() ?>/resize.php?src=<?php //echo $url; ?>&w=1200&h=800&q=100" alt=""/> -->
											<img src="<?php echo str_replace('webp', 'png', $url); ?>" alt=""/>
										</div>
									</div>
								<?php endif; ?>
							<?php } else { ?>
							<?php if( have_rows('slider_images') ): ?>
								<div class="dtl_owl owl-carousel owl-theme">
									<?php while ( have_rows('slider_images') ) : the_row(); ?>
											<div class="item">
												<!-- <img src="<?php //echo get_template_directory_uri() ?>/resize.php?src=<?php //the_sub_field('image'); ?>&w=1200&h=800&q=100" alt=""/> -->
												<img src="<?php the_sub_field('image'); ?>" alt=""/>
											</div>
										<?php endwhile; ?>
								</div>
								<?php else: ?>
									<div class="dtl_owl owl-carousel owl-theme">
										<div class="item">
											<!-- <img src="<?php //echo get_template_directory_uri() ?>/resize.php?src=<?php //echo $url; ?>&w=1200&h=800&q=100" alt=""/> -->
											<img src="<?php echo $url; ?>" alt=""/>
										</div>
									</div>
								<?php endif; ?>
								<?php } ?>
							</div>
						</section>	
								</div>
							<div class="single-body">
						     <div class="post-area single-portfolio">
						       
					           <div class="post-container">
					              <div class="entry-content no-border">
					                <?php the_content(); ?>

                                    <?php if(have_rows('private_office')): ?>
					                <div id="availability" class="vh_dtl_table">
										<h2>Offices Available</h2>
											
											<?php $available = false; ?>
                                            <?php $cnt = 0; while(have_rows('private_office')): the_row(); ?>
                                                
                                            	<?php if(get_sub_field('type') == 'hot_desk') { ?>
                                            	<?php
                                                if($cnt==0){
                                                	?><h4>Desk Available</h4>
													<div class="dtl_desk"><?php
													$cnt++;
                                                }
                                                ?>
                                            	<?php $available = true; ?>
													<div class="dtl_desk_in">
													<h5><?php echo get_sub_field('office_label'); ?> (<?php echo get_sub_field('desks_available'); ?> desk available) <a class="moreinf" href="JavaScript:Void(0);">more details</a></h5>
													<h4 class="rgtp">£<?php echo get_sub_field('price'); ?>/month</h4>
                                                    <div class="hdwrap">
                                                    <?php echo get_sub_field('more_details'); ?>
                                                    </div> 
													</div>
												<?php } ?>
											<?php endwhile;	?>
											<?php /*if($available == false) { ?>
												<div class="dtl_desk_in">
													<h5>No desk available</h5>
												</div>
											<?php }*/ ?>
											<?php if($cnt > 0){ ?>
											</div>
											<?php } ?>
											<?php $available = false; ?>
											
                                            <?php $pri_cnt = 0; while(have_rows('private_office')): the_row(); ?>
                                            	<?php if(get_sub_field('type') == 'private_office') { ?>
                                            	<?php
                                                if($pri_cnt==0){
                                                	?><h4>Private Office Available</h4>
													<div class="dtl_desk"><?php
													$pri_cnt++;
                                                }
                                                ?>
                                            	<?php $available = true; ?>
													<div class="dtl_desk_in">
													<h5><?php echo get_sub_field('office_label'); ?> (<?php echo get_sub_field('desks_available'); ?> desk available) <a class="moreinf" href="JavaScript:Void(0);">more details</a></h5>
													<h4 class="rgtp">£<?php echo get_sub_field('price'); ?>/month</h4>
                                                    <div class="hdwrap">
                                                    <?php echo get_sub_field('more_details'); ?>
                                                    </div> 
													</div>
												<?php } ?>
											<?php endwhile;	?>
											<?php /*if($available == false) { ?>
												<div class="dtl_desk_in">
													<h5>No office available</h5>
												</div>
											<?php }*/ ?>
											<?php if($pri_cnt > 0){ ?>
											</div>
											<?php } ?>
									</div>
									<?php endif; ?>

					               </div>            
					           </div>
						      
						     </div>
						  </div>

								  
								</article>
							</div>
							<div class="col-sm-4 sticky-sidebar">
								<div class="stick-btn">
								<?php echo do_shortcode('[favorite_button post_id="'. $post->ID.'"]'); ?>
								<a class="sticky_sort" href="javascript:void(0)">View Shortlist</a>
								</div>
								<div class="cal_des_cla">
								<form class="calendly_form" method="post" name="calendly_form">
								<?php if(have_rows('private_office')): ?>
									<div class="rs_po">
											<h2>Private Office</h2>
											 <span>Desks available Available Now</span>
										<select class="vhmf_select" name="calendly_option">
											<option class="fstopt" value="" selected >Please select office</option>
											<?php $tempval = ''; while(have_rows('private_office')): the_row(); ?>
											<option value="<?php echo get_sub_field('office_label'); ?> - £<?php echo get_sub_field('price'); ?> per month (excl VAT) - Desks available: <?php echo get_sub_field('desks_available'); ?>"><?php echo get_sub_field('office_label'); ?> - £<?php echo get_sub_field('price'); ?> per month (excl VAT) - Desks available: <?php echo get_sub_field('desks_available'); ?></option>
										<?php
										if($tempval == ''){
											$tempval = "<?php echo get_sub_field('office_label'); ?> - £".get_sub_field('price')." per month (excl VAT) - Desks available: ".get_sub_field('desks_available');
										}
										endwhile;
										?>
										</select>
									</div>
									<a class="a_bav" href="javascript:void(0)">BOOK A VIEWING</a>
								<?php endif; ?>
								</form>
								<div class="calendly-div"></div>
								
								<?php  if ( is_active_sidebar( 'sidebar-right' )  ) : dynamic_sidebar( 'sidebar-right' ); endif;   ?>
								</div>
								<?php if(get_field('special_offer') != "") { ?>
									<div class="spec-offer">
										<h4>Special Offer</h4>
										<?php echo get_field('special_offer'); ?>
									</div>
								<?php } ?>
								<?php if(get_field('fact') != "") { ?>
									<div class="fact-offer">
										<h4>Fact</h4>
										<?php echo get_field('fact'); ?>
									</div>
								<?php } ?>
								<div class="req_pdf">
									<a href="#pdfmailform" class="openpdf designpdf">Request details as a pdf</a>
								</div>
								<a class="back_prop" href="<?php echo get_permalink(3106) ?>">Back to property listings</a>
							</div>
						</div>


				
					<?php 
					
					
				endwhile;
			?>
			<div id="rela-prop" class="related_prod new_pro_list isotope-masonry">
				<h2>Related Property</h2>
				<div class="owl-carousel owl-theme related-prod-in ">
				<?php 
					$terms = get_the_terms( $post->ID , 'project_category');
					
					$related =  new WP_Query ( array( 'post_type' => 'project',
									'tax_query' => array(
									                    array(
									                        'taxonomy' => 'project_category',
									                        'field' => 'id',
									                        'terms' => 46,
									                        'operator'=> 'IN' //Or 'AND' or 'NOT IN'
									                     )),
					'posts_per_page' => 5, 'post__not_in' => array($post->ID) ) );
					
					if( $related->have_posts() ):
					 while($related->have_posts()): $related->the_post(); 
						 $url = wp_get_attachment_url( get_post_thumbnail_id() );
					?>
					<div class="item">
					<div class="portfolio-entries-masonry-entry masonry-item project-pro-wrapper">
						<div class="portfolio">
							<?php if(have_rows('slider_images')): ?>
				               <div class="img dtl_rel_slide new_lst_slide project-image">
				               	<?php while(have_rows('slider_images')): the_row(); ?>
									<div class="item"><a href="<?php echo get_the_permalink() ?>"><img src="<?php echo get_sub_field('image') ?>" alt=""/></a>
									</div>
								<?php endwhile; ?>
							    </div>
						    <?php else: ?>
								<div class="dtl_owl owl-carousel owl-theme">
									
											<div class="item">
												<img src="<?php echo $url; ?>" alt=""/>
											</div>
									
								</div>
							<?php endif; ?>
							<div class="content-wrap">
							<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p class="prop_areas"><span class="areas_title">Size/Space: </span><?php echo get_field('property_area'); ?></p>
							<p><?php echo wp_trim_words( get_the_content(), 10, '...' ); ?></p>
							<?php if(get_field('price') != "") { ?>
			    			<div class="list_price">
								<span class="desk">Price From:</span>
								<span class="price">£<?php echo get_field('price') ?></span>
								<span class="month">per month</span>
							</div>
						   
							<?php } ?>
							<div class="add_btn">
								<?php echo do_shortcode('[favorite_button post_id="'. $post->ID.'"]'); ?>
							</div>
							 </div>
						</div>
					</div>
					</div>	  
				<?php endwhile; endif; ?>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
	</div>	
 
	</div>	
</section>

<div style="display:none;" id="short_sidebar" class="shortlist_data">
      <a href="javascript:void(0)" class="closediv"></a>
      <h2>My Shortlist</h2>
      <div class="list_data">
      	<?php if(current_user_can('administrator') ) {  } else { ?>
        <?php the_user_favorites_list($user_id,$include_links, $filters, $include_button, $include_thumbnails = true, $thumbnail_size = 'thumbnail', $include_excerpt = false); ?>
        <?php } ?>
      </div>
      <div class="sidebar_links">
				<a class="email" href="#shortlistform">Email my shortlist</a>
				<a class="call" href="#rcbackform">Request a call back</a>
				<p>or call us:</p>
				<a class="num" href="tel:020 7183 8458">020 7183 8458</a>

			</div>
    </div>
<div style="display: none;" id="shortlistform" class="shortlis-form">
		<p class="status"></p>
		<div class="st_mail_form">
				<form class="mailform" id="mailform" method="POST">
					<ul>
						<li>
							<label>Name<span class="req">*</span></label>
							<input type="text" name="name" id="mf_name" class="txt">
						</li>
						<li>
							<label>Email<span class="req">*</span></label>
							<input type="text" name="name" id="mf_email" class="txt">
						</li>
						<li>
							<label>Phone<span class="req">*</span></label>
							<input type="text" name="name" id="mf_phone" class="txt">
						</li>
						<li class="captcha_li">
							<label>Captcha<span class="req">*</span></label>
							<span class="math_span"><?php echo $math; ?> = </span> <input name="answer" id="mf_captcha" type="text" class="txt"/>
						</li>
						<li class="full_li">
							<label>Comments<span class="req">*</span></label>
							<textarea name="comments" id="mf_comment" class="txt" cols="50"></textarea>
						</li>
						<li class="full_li">
							<input type="submit" id="sub_btn" name="sub_btn" class="txt" value="Submit">
						</li>
					</ul>
				</form>
		</div>
			</div>
<div style="display: none;" id="rcbackform" class="shortlis-form">
		<p class="rc_status"></p>
		
		<div class="st_mail_form rc_mail_form">
				<form class="mailform" id="rclistform" method="POST">
					<ul>
						<li>
							<label>Name<span class="req">*</span></label>
							<input type="text" name="rc_name" id="rc_name" class="txt">
						</li>
						<li>
							<label>Phone<span class="req">*</span></label>
							<input type="text" name="rc_phone" id="rc_phone" class="txt">
						</li>
						<li>
							<label>Best time to call<span class="req">*</span></label>
							<input type="text" name="rc_call" id="rc_call" class="txt">
						</li>
						<li class="captcha_li">
							<label>Captcha<span class="req">*</span></label>
							<span class="math_span"><?php echo $math; ?> = </span> <input name="answer" id="rc_captcha" type="text" class="txt"/>
						</li>
						<li class="full_li">
							<input type="submit" id="rc_sub_btn" name="rc_sub_btn" class="txt" value="Submit">
						</li>
					</ul>
				</form>
		</div>
			</div>
<script type="text/javascript">

jQuery(document.body).addClass('sticky-overflow');
jQuery(document.body).addClass('header-fix');
	
</script>


<?php
get_footer();
