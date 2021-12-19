<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if( ! function_exists('hotelgalaxy_add_home_shortcode') ){

	add_action('hotelgalaxy_do_homeShortcode', 'hotelgalaxy_add_home_shortcode');

	function hotelgalaxy_add_home_shortcode(){	

		if(! hotelgalaxy_get_option('is_home_shortcode_section')){
			return false;
		}

		?>
		<div id="main-home-shortcode" class="home-section wow fadeInUp">
			<div class="overlay">
				<div class="container">					

					<div class="contact-content-area home-summary clearfix">

						<?php					

						do_action('hotelgalaxy_get_home_contactform');						

						?>

					</div>
				</div>
			</div>
		</div>
		<?php

	}
}


add_action('hotelgalaxy_get_home_contactform','hotelgalaxy_add_home_contactform');

function hotelgalaxy_add_home_contactform(){
	?>
	<div class="user-contact-form">
		<!---contact_Form--->
		<div class="col-md-7 p-0 contact-form">			
			
			<?php 

			hotelgalaxy_home_section_header('shortcode');

			$shortcode = hotelgalaxy_get_option('shortcode_echo');

			if(!empty( $shortcode )){
				echo do_shortcode($shortcode );
			}
			?>

		</div>

		<!---contact_details--->
		<div class="col-md-5 contact-details p-0 content-center">
			<div class="contact-details-inner">				
				
				<figure class="my-5 address-unit">
					<figcaption>
						<span class="icon_box"> <i class="fa  fa-map-marker"></i> </span>
						<div class="inner-box">
							<?php 

							echo '<h3>'.  esc_html(hotelgalaxy_get_option('office_address_title')). '</h3>';


							echo sprintf('<p>%s</p>', wp_kses_post(hotelgalaxy_get_option('office_address')));
							?>											
						</div>
					</figcaption>
				</figure>


				<figure class="my-5 phone-unit">
					<figcaption>
						<span class="icon_box"> <i class="fa fa-phone"></i> </span>
						<div class="inner-box">

							<?php 

							echo '<h3>'.  esc_html(hotelgalaxy_get_option('office_phone_title')). '</h3>';

							echo sprintf('<p>%s</p>', wp_kses_post(hotelgalaxy_get_option('office_phone')));

							?>			

						</div>
					</figcaption>
				</figure>

				<figure class="my-5 email-unit">
					<figcaption>
						<span class="icon_box"> <i class="fa fa-envelope"></i> </span>
						<div class="inner-box">

							<?php

							echo '<h3>'.  esc_html(hotelgalaxy_get_option('office_email_title')). '</h3>';

							echo sprintf('<p>%s</p>', wp_kses_post(hotelgalaxy_get_option('office_email')));
							?>										

						</div>
					</figcaption>
				</figure>

				<figure class="my-5 hours-unit">
					<figcaption>
						<span class="icon_box"> <i class="fa fa-clock-o"></i> </span>
						<div class="inner-box">
							<?php 

							echo '<h3>'.  esc_html(hotelgalaxy_get_option('office_open_hours_title')). '</h3>';

							echo sprintf('<p>%s</p>', wp_kses_post(hotelgalaxy_get_option('office_open_hours')));
							?>											

						</div>
					</figcaption>
				</figure>


			</div>
		</div>
	</div>
	<?php

}


?>