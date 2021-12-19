<?php
if ( !function_exists( 'business_a_homepage_shop' ) ) :
	function business_a_homepage_shop(){ 

		if ( ! class_exists( 'woocommerce' ) )
			return;

		$business_obj = new business_a_settings_array();
		$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() ); 

		$shop_no_of_show = $option['shop_no_of_show'];
		?>

		<?php if( $option['shop_section_enable'] == true ) : ?>
			<section id="shop" style="background:url('<?php echo esc_url( $option['shop_section_image'] ); ?>') fixed center <?php echo esc_attr( $option['shop_section_image_repeat'] ); ?> <?php echo esc_attr( $option['shop_section_backgorund_color'] ); ?>;">
				<div class="rdn-section-body">
					<div class="container">
					
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<?php if($option['shop_section_title']!=''): ?>
								<h1 class="section-title wow animated fadeInUp">
									<?php 
									if( function_exists('pll_register_string')){
										echo pll_e( $option['shop_section_title'] );
									}else{
										echo wp_kses_post( $option['shop_section_title'] );
									}
									?>								
								</h1>
								<?php endif; ?>
								<?php if($option['shop_section_description']!=''): ?>
								<p class="section-desc wow animated fadeInUp">
									<?php 
									if( function_exists('pll_register_string')){
										echo pll_e( $option['shop_section_description'] );
									}else{
										echo wp_kses_post( $option['shop_section_description'] );
									}							
									?>								
									</p>
								<?php endif; ?>
							</div>
						</div>
						
						<?php business_a_shop_content( $shop_no_of_show ); ?>
						
					</div>
				</div>
			</section><!-- #rdn-shop -->
		<?php endif;
	}
endif;

if ( function_exists( 'business_a_homepage_shop' ) ) {
	$section_priority = apply_filters( 'business_a_section_priority', 3, 'business_a_homepage_shop' );
	add_action( 'business_a_sections', 'business_a_homepage_shop', absint( $section_priority ) );
}