<?php 

/**
 * template name: Home Page
 */


get_header(); ?>

<!-- <div class="corona-header" ><h1>Elitecommcom is now closed for the holiday period. We are open from the 4th of January 2021 by appointment only and from the 7th of January 2020 for full trading. For assistance, please call Tom on 0000 000 000 from the 4th of January onwards.</h1>
<h3>The team at Elitecommcom would like to wish everyone a safe and relaxing break and we can't wait to see you all in 2021.</h3></div> -->




<div class="home-grid-container">
	<div class="grid-list">	
		<a href="https://limelitelighting.mobilegiz.com/product-category/lighting/" class="home-grid-item">	
		<div class="bg-img" style="background: url(<?php echo get_stylesheet_directory_uri(); ?>/image/lighting.jpg);"></div>
		<div class="home-item-name">
		    <h3>Lighting</h3>
		    <div class="icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/image/lighting-icn.png"></div>
		</div>
		</a>
		<a href="https://limelitelighting.mobilegiz.com/product-category/power/" class="home-grid-item">	
			<div class="bg-img" style="background: url(<?php echo get_stylesheet_directory_uri(); ?>/image/power-image.jpg);"></div>
			<div class="home-item-name">
			    <h3>Power</h3>
			    <div class="icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/image/power-icn.png"></div>
			</div>
		</a>
		<a href="https://limelitelighting.mobilegiz.com/product-category/rigging/" class="home-grid-item">	
			<div class="bg-img" style="background: url(<?php echo get_stylesheet_directory_uri(); ?>/image/light-regging.jpg);"></div>
			<div class="home-item-name">
			    <h3>Rigging</h3>
			    <div class="icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/image/rigging-icn.png"></div>
			</div>
		</a>
		<a href="https://limelitelighting.mobilegiz.com/product-category/av/" class="home-grid-item">	
			<div class="bg-img" style="background: url(<?php echo get_stylesheet_directory_uri(); ?>/image/lights-av.jpg);"></div>
			<div class="home-item-name">
			    <h3>AV</h3>
			    <div class="icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/image/av-icn.png"></div>
			</div>
		</a>
	</div>
	<div class="search_div">
				<label class="search_label">SEARCH:</label>
				<?php if ( 'fullscreen' !== et_get_option( 'header_style', 'left' ) ) { ?>
					<div class="clear"></div>
				<?php } ?>
				<form role="search" method="get" class="et-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php
						printf( '<input type="search" class="et-search-field" placeholder="%1$s" value="%2$s" name="s" title="%3$s" />',
							esc_attr__( 'Search &hellip;', 'Divi' ),
							get_search_query(),
							esc_attr__( 'Search for:', 'Divi' )
						);

						/**
						 * Fires inside the search form element, just before its closing tag.
						 *
						 * @since ??
						 */
						do_action( 'et_search_form_fields' );
					?>
					<button type="submit" id="searchsubmit_header"></button>
				</form>
			
	</div>
</div>

<div class="footer_search">
	
	<div class="feature">		
		<div class="feature-text"></div>
	</div>
	<div class="feature">		
		<div class="feature-text">PRODUCTION LIGHTING RENTAL SPECIALIST</div>
	</div>
	<div class="feature">		
		<div class="feature-text"></div>
	</div>
	
</div>
<?php

get_footer();
