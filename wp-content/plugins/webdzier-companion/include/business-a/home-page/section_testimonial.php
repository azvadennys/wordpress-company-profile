<?php
if ( !function_exists( 'business_a_homepage_testimonial' ) ) :
	function business_a_homepage_testimonial(){ 

		$business_obj = new business_a_settings_array();
		$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() );

		$default_content = false;
		$default_content = businessa_get_testimonial_default();
		$businessa_testimonial_content  = get_theme_mod( 'testimonial_section_contents', $default_content );
		if($option['testimonial_section_enable']==true): ?>
			<section id="testimonial" style="background:url('<?php echo $option['testimonial_section_image']; ?>') fixed center <?php echo $option['testimonial_section_image_repeat']; ?> <?php echo $option['testimonial_section_backgorund_color']; ?>;">
			<div class="overlay <?php if( $option['testimonial_section_image'] != '' ){ echo 'dark'; } ?>">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<?php if($option['testimonial_section_title']!=''): ?>
							<h2 class="section-title wow animated fadeInUp"><?php 
							if( function_exists('pll_register_string')){
								echo pll_e( $option['testimonial_section_title'] );
							}else{
								echo wp_kses_post( $option['testimonial_section_title'] );
							} 
							?></h2>
							<?php endif; ?>
							<?php if($option['testimonial_section_description']!=''): ?>
							<p class="section-desc wow animated fadeInUp"><?php 
							if( function_exists('pll_register_string')){
								echo pll_e( $option['testimonial_section_description'] );
							}else{
								echo wp_kses_post( $option['testimonial_section_description'] );
							}
							?></p>
							<?php endif; ?>
						</div>
					</div>

		            <?php businessa_testimonial_content( $businessa_testimonial_content );  ?>

			</div>
			</section><!-- #rdn-testimonial -->
		<?php endif;
	}
endif;

if ( function_exists( 'business_a_homepage_testimonial' ) ) {
	$section_priority = apply_filters( 'business_a_section_priority', 4, 'business_a_homepage_testimonial' );
	add_action( 'business_a_sections', 'business_a_homepage_testimonial', absint( $section_priority ) );
}