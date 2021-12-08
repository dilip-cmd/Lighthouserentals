<?php
if ( et_theme_builder_overrides_layout( ET_THEME_BUILDER_HEADER_LAYOUT_POST_TYPE ) || et_theme_builder_overrides_layout( ET_THEME_BUILDER_FOOTER_LAYOUT_POST_TYPE ) ) {
    // Skip rendering anything as this partial is being buffered anyway.
    // In addition, avoids get_sidebar() issues since that uses
    // locate_template() with require_once.
    return;
}

/**
 * Fires after the main content, before the footer is output.
 *
 * @since 3.10
 */
do_action( 'et_after_main_content' );

if ( 'on' === et_get_option( 'divi_back_to_top', 'false' ) ) : ?>

	<span class="et_pb_scroll_top et-pb-icon"></span>

<?php endif;

if ( ! is_page_template( 'page-template-blank.php' ) ) : ?>

    <?php
		$logo = ( $user_logo = et_get_option( 'divi_logo' ) ) && ! empty( $user_logo )
			? $user_logo
			: $template_directory_uri . '/images/logo.png';
	?>

			
    <footer>
		<div class="footer-container">
			<!-- <div class="logo logo-container"><a href="#"><img _ngcontent-c8="" alt="" src="<?php //echo $logo; ?>"></a></div>		
			<div class="linkwrap">
				<div class="col link-container">
					<ul>
						<li><u><a href="#">About</a></u></li>
						<li><u><a href="#">Contact</a></u></li>
						<li><u><a href="#">Sponsorships</a></u></li>
					</ul>
				</div>
				<div class="col phone-container">
					<p><strong>Phone</strong></p>
					<p>(03) 9646 9034</p>
				</div>
				<div class="col hours-container">
					<p><strong>Hours</strong></p>
					<p>9am-5pm</p>
					<p>Monday-Friday</p>
				</div>
				<div class="col warehouse-container">
					<p><strong>Warehouse</strong></p>
					<p>7/345 Plummer St<br>
						Port Melbourne<br>
						VIC, 3064<br>
						Australia </p>
				</div>
				<div class="col email-container">
					<p><strong>Email</strong></p>
					<p>hello@elitecommcom.au</p>
					<ul>
						<li><u><a href="#">Privacy</a></u></li>
						<li><u><a href="#">Terms</a></u></li>
					</ul>
				</div>
			</div> -->
			<?php $year = date("Y"); ?>
			<div class="trademark-container"><p>Copyright <?php echo $year; ?> Limelite Lighting. All Rights Reserved.</p></div>
		</div>

	</footer>

<?php endif; // ! is_page_template( 'page-template-blank.php' ) ?>

	</div> <!-- #page-container -->

	<?php wp_footer(); ?>
<script>
	( function( $ ) {
		$( document ).ready(function() {
		jQuery( ".product-categories li ul" ).before( '<span class="accordion-toggle"></span>' );
		$(document).on('click', '.product-categories li span' ,function(){


		//$(this).removeAttr('href');
		var element = $(this).parent('li');

		if (element.hasClass('open')) {
		element.removeClass('open');
		element.find('li').removeClass('open');
		element.find('ul').slideUp();
		}
		else {
		element.addClass('open');
		element.children('ul').slideDown();
		element.siblings('li').children('ul').slideUp();
		element.siblings('li').removeClass('open');
		element.siblings('li').find('li').removeClass('open');
		element.siblings('li').find('ul').slideUp();
		}
		});

		//$('#cssmenu>ul>li.cat-parent>a').append('<span class="holder">');

		$(document).on('click','input.cat_exclude', function(){
			alert("hello");

		});

		});
		} )
	( jQuery );
</script>
</body>

</html>
