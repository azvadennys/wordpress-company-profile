<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( ! function_exists('hotelgalaxy_add_home_service') ){

	add_action('hotelgalaxy_do_homeService', 'hotelgalaxy_add_home_service');

	function hotelgalaxy_add_home_service(){	


		if( hotelgalaxy_get_option('is_home_service_section') ){
			?>

			<div id="main-home-service" class="home-section wow fadeInUp">

				<div class="overlay">

					<div class="container">

						<?php hotelgalaxy_home_section_header('service');	?>

						<div class="service-content-area home-summary clearfix">
							<?php 
							if ( is_active_sidebar( 'home-services' ) ) {
								dynamic_sidebar( 'home-services' );
							}
							?>
						</div>
					</div>
				</div>
			</div>

			<?php
		}
	}
}
