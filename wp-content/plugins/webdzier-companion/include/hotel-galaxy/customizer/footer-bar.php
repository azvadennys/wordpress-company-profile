<?php 
if ( ! defined( 'ABSPATH' ) ) {	exit; } 

add_action( 'customize_register', 'hotelgalaxy_footer_bar_setting' );

function hotelgalaxy_footer_bar_setting( $wp_customize ){

	if(!function_exists('hotelgalaxy_get_default')){
		return false;
	}

	$defaults = hotelgalaxy_get_default();


	$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[footer_collout_title_1]', array(
		'selector' => '.icon-callout-area #footer-icon-callout-1',
		'render_callback' => function(){ return $defaults['footer_collout_title_1']; },
	) );

	$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[footer_collout_title_2]', array(
		'selector' => '.icon-callout-area #footer-icon-callout-2',
		'render_callback' => function(){ return $defaults['footer_collout_title_2']; },
	) );

	$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[footer_collout_title_3]', array(
		'selector' => '.icon-callout-area #footer-icon-callout-3',
		'render_callback' => function(){ return $defaults['footer_collout_title_3']; },
	) );

	$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[footer_collout_title_4]', array(
		'selector' => '.icon-callout-area #footer-icon-callout-4',
		'render_callback' => function(){ return $defaults['footer_collout_title_4']; },
	) );

	if ( ! $wp_customize->get_panel( 'hotelgalaxy_theme_layout' ) ) {
		$wp_customize->add_panel( 'hotelgalaxy_theme_layout', array(
			'priority' => 27,
			'title' => __( 'Layout', 'hotel-galaxy'),
		) );
	}

	if ( ! $wp_customize->get_section( 'icon_callout_section' ) ) {

		$wp_customize->add_section('icon_callout_section',array(

			'title' => __( 'Footer Icon Bar ','hotel-galaxy'),
			'panel'=>'hotelgalaxy_theme_layout',
			'capability'=>'edit_theme_options',
			'priority' => 22,			

		));
	}

	// footer icon 1

	$wp_customize->add_control(
		new Hotelgalaxy_Title_Control(
			$wp_customize,
			'hotelgalaxy_footer_callout_title_1',
			array(
				'section' => 'icon_callout_section',
				'type' => 'hotelgalaxy-title-control',
				'title'	=>esc_html__('Icon 1', 'hotel-galaxy'),
				'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
			)
		)
	);

	// 
	$wp_customize->add_setting(
		'hotel_galaxy_option[footer_collout_icon_1]',
		array(
			'default'=> esc_html($defaults['footer_collout_icon_1']),
			'type'=>'option',
			'sanitize_callback' => 'hotelgalaxy_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( new Hotelgalaxy_Icon_Picker_Control($wp_customize, 
		'hotel_galaxy_option[footer_collout_icon_1]',
		array(
			'label'   		=>  null,
			'section' 		=> 'icon_callout_section',		
			'settings'   => 'hotel_galaxy_option[footer_collout_icon_1]',
		))  
);	
	// 
	$wp_customize->add_setting('hotel_galaxy_option[footer_collout_title_1]',array(
		'type'=>'option',
		'default'=>$defaults['footer_collout_title_1'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_text',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( 'hotel_galaxy_option[footer_collout_title_1]', array(
		'label'        => null,
		'description' => __( 'Enter Title','hotel-galaxy'),
		'type'=>'text',
		'section'    => 'icon_callout_section',
		'settings'   => 'hotel_galaxy_option[footer_collout_title_1]',
		
	) );


	// footer icon 2

	$wp_customize->add_control(
		new Hotelgalaxy_Title_Control(
			$wp_customize,
			'hotelgalaxy_footer_callout_title_2',
			array(
				'section' => 'icon_callout_section',
				'type' => 'hotelgalaxy-title-control',
				'title'	=>esc_html__('Icon 2', 'hotel-galaxy'),
				'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
			)
		)
	);

	// 
	$wp_customize->add_setting(
		'hotel_galaxy_option[footer_collout_icon_2]',
		array(
			'default'=> esc_html($defaults['footer_collout_icon_2']),
			'type'=>'option',
			'sanitize_callback' => 'hotelgalaxy_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( new Hotelgalaxy_Icon_Picker_Control($wp_customize, 
		'hotel_galaxy_option[footer_collout_icon_2]',
		array(
			'label'   		=>  null,
			'section' 		=> 'icon_callout_section',		
			'settings'   => 'hotel_galaxy_option[footer_collout_icon_2]',
		))  
);	
	// 
	$wp_customize->add_setting('hotel_galaxy_option[footer_collout_title_2]',array(
		'type'=>'option',
		'default'=>$defaults['footer_collout_title_2'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_text',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( 'hotel_galaxy_option[footer_collout_title_2]', array(
		'label'        => null,
		'description' => __( 'Enter Title','hotel-galaxy'),
		'type'=>'text',
		'section'    => 'icon_callout_section',
		'settings'   => 'hotel_galaxy_option[footer_collout_title_2]',
		
	) );

	// footer icon 3

	$wp_customize->add_control(
		new Hotelgalaxy_Title_Control(
			$wp_customize,
			'hotelgalaxy_footer_callout_title_3',
			array(
				'section' => 'icon_callout_section',
				'type' => 'hotelgalaxy-title-control',
				'title'	=>esc_html__('Icon 3', 'hotel-galaxy'),
				'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
			)
		)
	);

	// 
	$wp_customize->add_setting(
		'hotel_galaxy_option[footer_collout_icon_3]',
		array(
			'default'=> esc_html($defaults['footer_collout_icon_3']),
			'type'=>'option',
			'sanitize_callback' => 'hotelgalaxy_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( new Hotelgalaxy_Icon_Picker_Control($wp_customize, 
		'hotel_galaxy_option[footer_collout_icon_3]',
		array(
			'label'   		=>  null,
			'section' 		=> 'icon_callout_section',		
			'settings'   => 'hotel_galaxy_option[footer_collout_icon_3]',
		))  
);	
	// 
	$wp_customize->add_setting('hotel_galaxy_option[footer_collout_title_3]',array(
		'type'=>'option',
		'default'=>$defaults['footer_collout_title_3'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_text',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( 'hotel_galaxy_option[footer_collout_title_3]', array(
		'label'        => null,
		'description' => __( 'Enter Title','hotel-galaxy'),
		'type'=>'text',
		'section'    => 'icon_callout_section',
		'settings'   => 'hotel_galaxy_option[footer_collout_title_3]',
		
	) );

	// footer icon 4

	$wp_customize->add_control(
		new Hotelgalaxy_Title_Control(
			$wp_customize,
			'hotelgalaxy_footer_callout_title_4',
			array(
				'section' => 'icon_callout_section',
				'type' => 'hotelgalaxy-title-control',
				'title'	=>esc_html__('Icon 4', 'hotel-galaxy'),
				'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
			)
		)
	);

	// 
	$wp_customize->add_setting(
		'hotel_galaxy_option[footer_collout_icon_4]',
		array(
			'default'=> esc_html($defaults['footer_collout_icon_4']),
			'type'=>'option',
			'sanitize_callback' => 'hotelgalaxy_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( new Hotelgalaxy_Icon_Picker_Control($wp_customize, 
		'hotel_galaxy_option[footer_collout_icon_4]',
		array(
			'label'   		=>  null,
			'section' 		=> 'icon_callout_section',		
			'settings'   => 'hotel_galaxy_option[footer_collout_icon_4]',
		))  
);	
	// 
	$wp_customize->add_setting('hotel_galaxy_option[footer_collout_title_4]',array(
		'type'=>'option',
		'default'=>$defaults['footer_collout_title_4'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_text',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( 'hotel_galaxy_option[footer_collout_title_4]', array(
		'label'        => null,
		'description' => __( 'Enter Title','hotel-galaxy'),
		'type'=>'text',
		'section'    => 'icon_callout_section',
		'settings'   => 'hotel_galaxy_option[footer_collout_title_4]',
		
	) );


}

?>