<?php 

if ( ! defined( 'ABSPATH' ) ) {	exit; }

add_action( 'customize_register', 'hotelgalaxy_color_settings' );

function hotelgalaxy_color_settings( $wp_customize ){

	if(!function_exists('hotelgalaxy_color_defaults')){
		return false;
	}

	$default = hotelgalaxy_color_defaults();

	if ( ! $wp_customize->get_panel( 'hotelgalaxy_colors_panel' ) ) {

		$wp_customize->add_panel( 'hotelgalaxy_colors_panel', array(
			'priority'       => 30,
			'theme_supports' => '',
			'title'          => __( 'Colors', 'hotel-galaxy'),
			'description'    => '',
		) );
	}


	if(! defined('HG_COLOR_ADDON_VERSION')){

		// service color

		if(!$wp_customize->get_section('service_color_section')){

			$wp_customize->add_section(
				'service_color_section',
				array(
					'title' => __( 'Service', 'hotel-galaxy' ),
					'capability' => 'edit_theme_options',
					'priority' => 2,
					'panel' => 'hotelgalaxy_colors_panel'
				)
			);
		}

	// background
		$wp_customize->add_setting(
			'hotel_galaxy_option[home_service_background_color]', array(
				'capability'     => 'edit_theme_options',
				'default' => $default['home_service_background_color'],
				'type' => 'option',	
				'sanitize_callback'=>'hotelgalaxy_sanitize_hex_color',	
			)
		);

		$wp_customize->add_control(	new WP_Customize_Color_Control(	$wp_customize,'hotel_galaxy_option[home_service_background_color]', 
			array(
				'label'      => __( 'Background', 'hotel-galaxy'),
				'section'    => 'service_color_section',			
				'settings'   => 'hotel_galaxy_option[home_service_background_color]',
			) )
	);

	// Header color
		$wp_customize->add_setting(
			'hotel_galaxy_option[home_service_header_title_color]', array(
				'capability'     => 'edit_theme_options',
				'default' => $default['home_service_header_title_color'],
				'type' => 'option',	
				'sanitize_callback'=>'hotelgalaxy_sanitize_hex_color',	
			)
		);

		$wp_customize->add_control(	new WP_Customize_Color_Control(	$wp_customize,'hotel_galaxy_option[home_service_header_title_color]', 
			array(
				'label'      => __( 'Header', 'hotel-galaxy'),
				'section'    => 'service_color_section',			
				'settings'   => 'hotel_galaxy_option[home_service_header_title_color]',
			) )
	);

	// sub header color
		$wp_customize->add_setting(
			'hotel_galaxy_option[home_service_header_description_color]', array(
				'capability'     => 'edit_theme_options',
				'default' => $default['home_service_header_description_color'],
				'type' => 'option',	
				'sanitize_callback'=>'hotelgalaxy_sanitize_hex_color',	
			)
		);

		$wp_customize->add_control(	new WP_Customize_Color_Control(	$wp_customize,'hotel_galaxy_option[home_service_header_description_color]', 
			array(
				'label'      => __( 'Sub Header', 'hotel-galaxy'),
				'section'    => 'service_color_section',			
				'settings'   => 'hotel_galaxy_option[home_service_header_description_color]',
			) )
	);



// room bg color

		if(!$wp_customize->get_section('room_color_section')){

			$wp_customize->add_section(
				'room_color_section',
				array(
					'title' => __( 'Room', 'hotel-galaxy' ),
					'capability' => 'edit_theme_options',
					'priority' => 2,
					'panel' => 'hotelgalaxy_colors_panel'
				)
			);
		}

	// background
		$wp_customize->add_setting(
			'hotel_galaxy_option[home_room_background_color]', array(
				'capability'     => 'edit_theme_options',
				'default' => $default['home_room_background_color'],
				'type' => 'option',	
				'sanitize_callback'=>'hotelgalaxy_sanitize_hex_color',	
			)
		);

		$wp_customize->add_control(	new WP_Customize_Color_Control(	$wp_customize,'hotel_galaxy_option[home_room_background_color]', 
			array(
				'label'      => __( 'Background', 'hotel-galaxy'),
				'section'    => 'room_color_section',			
				'settings'   => 'hotel_galaxy_option[home_room_background_color]',
			) )
	);

	// Header color
		$wp_customize->add_setting(
			'hotel_galaxy_option[home_room_header_title_color]', array(
				'capability'     => 'edit_theme_options',
				'default' => $default['home_room_header_title_color'],
				'type' => 'option',	
				'sanitize_callback'=>'hotelgalaxy_sanitize_hex_color',	
			)
		);

		$wp_customize->add_control(	new WP_Customize_Color_Control(	$wp_customize,'hotel_galaxy_option[home_room_header_title_color]', 
			array(
				'label'      => __( 'Header', 'hotel-galaxy'),
				'section'    => 'room_color_section',			
				'settings'   => 'hotel_galaxy_option[home_room_header_title_color]',
			) )
	);

	// sub header color
		$wp_customize->add_setting(
			'hotel_galaxy_option[home_room_header_description_color]', array(
				'capability'     => 'edit_theme_options',
				'default' => $default['home_room_header_description_color'],
				'type' => 'option',	
				'sanitize_callback'=>'hotelgalaxy_sanitize_hex_color',	
			)
		);

		$wp_customize->add_control(	new WP_Customize_Color_Control(	$wp_customize,'hotel_galaxy_option[home_room_header_description_color]', 
			array(
				'label'      => __( 'Sub Header', 'hotel-galaxy'),
				'section'    => 'room_color_section',			
				'settings'   => 'hotel_galaxy_option[home_room_header_description_color]',
			) )
	);

		// contact color


		if(!$wp_customize->get_section('shortcode_color_section')){

			$wp_customize->add_section('shortcode_color_section',
				array(
					'title' => __( 'Contact', 'hotel-galaxy' ),
					'capability' => 'edit_theme_options',
					'priority' => 2,
					'panel' => 'hotelgalaxy_colors_panel'
				)
			);
		}
	// background
		$wp_customize->add_setting(
			'hotel_galaxy_option[home_shortcode_background_color]', array(
				'capability'     => 'edit_theme_options',
				'default' => $default['home_shortcode_background_color'],
				'type' => 'option',	
				'sanitize_callback'=>'hotelgalaxy_sanitize_hex_color',	
			)
		);

		$wp_customize->add_control(	new WP_Customize_Color_Control(	$wp_customize,'hotel_galaxy_option[home_shortcode_background_color]', 
			array(
				'label'      => __( 'Background', 'hotel-galaxy'),
				'section'    => 'shortcode_color_section',			
				'settings'   => 'hotel_galaxy_option[home_shortcode_background_color]',
			) )
	);

	// Header color
		$wp_customize->add_setting(
			'hotel_galaxy_option[home_shortcode_header_title_color]', array(
				'capability'     => 'edit_theme_options',
				'default' => $default['home_shortcode_header_title_color'],
				'type' => 'option',	
				'sanitize_callback'=>'hotelgalaxy_sanitize_hex_color',	
			)
		);

		$wp_customize->add_control(	new WP_Customize_Color_Control(	$wp_customize,'hotel_galaxy_option[home_shortcode_header_title_color]', 
			array(
				'label'      => __( 'Header', 'hotel-galaxy'),
				'section'    => 'shortcode_color_section',			
				'settings'   => 'hotel_galaxy_option[home_shortcode_header_title_color]',
			) )
	);

	// sub header color
		$wp_customize->add_setting(
			'hotel_galaxy_option[home_shortcode_header_description_color]', array(
				'capability'     => 'edit_theme_options',
				'default' => $default['home_shortcode_header_description_color'],
				'type' => 'option',	
				'sanitize_callback'=>'hotelgalaxy_sanitize_hex_color',	
			)
		);

		$wp_customize->add_control(	new WP_Customize_Color_Control(	$wp_customize,'hotel_galaxy_option[home_shortcode_header_description_color]', 
			array(
				'label'      => __( 'Sub Header', 'hotel-galaxy'),
				'section'    => 'shortcode_color_section',			
				'settings'   => 'hotel_galaxy_option[home_shortcode_header_description_color]',
			) )
	);

	}

}
?>