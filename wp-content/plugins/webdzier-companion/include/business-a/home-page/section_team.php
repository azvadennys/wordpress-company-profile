<?php
if ( !function_exists( 'business_a_homepage_team' ) ) :
	function business_a_homepage_team(){ 

		$business_obj = new business_a_settings_array();
		$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() );

		$default_content = false;
		$default_content = businessa_get_team_default();
		$businessa_team_content  = get_theme_mod( 'team_section_contents', $default_content );
		?>
		<?php if($option['team_section_enable']==true): ?>
			<section id="team" style="background:url('<?php echo $option['team_section_image']; ?>') fixed center <?php echo $option['team_section_image_repeat']; ?> <?php echo $option['team_section_backgorund_color']; ?>;">
				<div class="overlay <?php if( $option['team_section_image'] != '' ){ echo 'dark'; } ?>">
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<?php if($option['team_section_title']!=''): ?>
								<h2 class="section-title wow animated fadeInUp">
									<?php 
									if( function_exists('pll_register_string')){
										echo pll_e( $option['team_section_title'] );
									}else{
										echo wp_kses_post( $option['team_section_title'] );
									}
									?></h2>
								<?php endif; ?>
								<?php if($option['team_section_description']!=''): ?>
								<p class="section-desc wow animated fadeInUp"><?php 
									if( function_exists('pll_register_string')){
										echo pll_e( $option['team_section_description'] );
									}else{
										echo wp_kses_post( $option['team_section_description'] );
									}
									?></p>
								<?php endif; ?>
							</div>
						</div>

		                <?php businessa_team_content( $businessa_team_content );  ?>

					</div>
				</div>
			</section><!-- #rdn-team -->
		<?php endif;
	}
endif;

if ( function_exists( 'business_a_homepage_team' ) ) {
	$section_priority = apply_filters( 'business_a_section_priority', 3, 'business_a_homepage_team' );
	add_action( 'business_a_sections', 'business_a_homepage_team', absint( $section_priority ) );
}