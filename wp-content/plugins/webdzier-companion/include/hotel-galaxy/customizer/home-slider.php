<?php 
if ( ! defined( 'ABSPATH' ) ) {	exit; }

add_action( 'customize_register', 'hotelgalaxy_home_slider_settings' );

function hotelgalaxy_home_slider_settings( $wp_customize ){

	if(!function_exists('hotelgalaxy_get_default')){
		return false;
	}

	$defaults = hotelgalaxy_get_default();

	// slider button
	$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[slider_button_text]', array(
		'selector' => '#hg-main-slider a#read-more',
		'render_callback' => function(){ return $defaults['slider_button_text']; },
	) );

	if ( ! $wp_customize->get_panel( 'hotelgalaxy_homepage_layout' ) ) {
		$wp_customize->add_panel( 'hotelgalaxy_homepage_layout', array(
			'priority' => 26,
			'title' => __( 'Homepage Sections', 'hotel-galaxy'),
		) );
	}

	if ( ! $wp_customize->get_section( 'slider_sec' ) ) {
		$wp_customize->add_section('slider_sec',array(
			'title' => __( 'Slider','hotel-galaxy'),
			'panel'=>'hotelgalaxy_homepage_layout',
			'capability'=>'edit_theme_options',
			'priority' => 1,

		));
	}


	//section show or hide
	$wp_customize->add_setting(	'hotel_galaxy_option[slider_button_target]',array(
		'type'    => 'option',
		'default'=>$defaults['slider_button_target'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_checkbox',	
		'capability'        => 'edit_theme_options',
	)
);

	$wp_customize->add_control( 'hotel_galaxy_option[slider_button_target]', array(
		'label'        => __( 'Link Open New Tab', 'hotel-galaxy'),
		'type'=>'checkbox',
		'priority'=> 0,
		'section'    => 'slider_sec',
		'settings'   => 'hotel_galaxy_option[slider_button_target]',
	) );


//slider btn text
	$wp_customize->add_setting('hotel_galaxy_option[slider_button_text]',array(
		'type'=>'option',
		'default'=>$defaults['slider_button_text'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_text',	
		'capability'        => 'edit_theme_options',
		
	));

	$wp_customize->add_control( 'slider_button_text', array(
		'label'        => __( 'Button Text', 'hotel-galaxy'),
		'type'=>'text',
		'priority'=> 6,	
		'section'    => 'slider_sec',	
		'settings'   => 'hotel_galaxy_option[slider_button_text]',
	));

}

?>