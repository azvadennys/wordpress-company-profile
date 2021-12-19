<?php 

if ( ! defined( 'ABSPATH' ) ) {	exit; }

add_action( 'customize_register', 'hotelgalaxy_home_blog_settings' );

function hotelgalaxy_home_blog_settings( $wp_customize ){

	if(!function_exists('hotelgalaxy_get_default')){
		return false;
	}

	$defaults = hotelgalaxy_get_default();

	// blog header
	$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[home_blog_section_header]', array(
		'selector' => '#main-home-blog .section-header h2',
		'render_callback' => function(){ return $defaults['home_blog_section_header']; },
	) );

	// blog sub header
	$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[home_blog_section_sub_header]', array(
		'selector' => '#main-home-blog .section-header .sub-header',
		'render_callback' => function(){ return $defaults['home_blog_section_sub_header']; },
	) );

	if ( ! $wp_customize->get_panel( 'hotelgalaxy_homepage_layout' ) ) {
		$wp_customize->add_panel( 'hotelgalaxy_homepage_layout', array(
			'priority' => 26,
			'title' => __( 'Homepage Sections', 'hotel-galaxy'),
		) );
	}

	if ( ! $wp_customize->get_section( 'home_blog_section' ) ) {
		$wp_customize->add_section('home_blog_section',array(
			'title' => __( 'Blog','hotel-galaxy'),
			'description' => '',
			'panel'=>'hotelgalaxy_homepage_layout',
			'capability'=>'edit_theme_options',
			'priority' => 4,			
		));
	}

	//section show or hide
	$wp_customize->add_setting(	'hotel_galaxy_option[is_home_blog_section]',array(
		'type'    => 'option',
		'default'=>$defaults['is_home_blog_section'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_checkbox',	
		'capability'        => 'edit_theme_options',
	)
);

	$wp_customize->add_control( 'hotel_galaxy_option[is_home_blog_section]', array(
		'label'        => __( 'Display Section', 'hotel-galaxy'),
		'type'=>'checkbox',
		'priority'=> 1,
		'section'    => 'home_blog_section',
		'settings'   => 'hotel_galaxy_option[is_home_blog_section]',
	) );

//display seprator
	$wp_customize->add_setting(	'hotel_galaxy_option[is_blog_seprator]',array(
		'type'    => 'option',
		'default'=>$defaults['is_blog_seprator'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_checkbox',	
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( 'is_blog_seprator', array(
		'label'        => __( 'Display Seprator', 'hotel-galaxy'),
		'type'=>'checkbox',
		'priority'=> 1,
		'section'    => 'home_blog_section',
		'settings'   => 'hotel_galaxy_option[is_blog_seprator]',
	) );


//Blog title
	$wp_customize->add_setting('hotel_galaxy_option[home_blog_section_header]',array(
		'type'=>'option',
		'default'=>$defaults['home_blog_section_header'],	
		'sanitize_callback'=>'hotelgalaxy_not_sanitize',
		'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control( 'hotel_galaxy_option[home_blog_section_header]', array(
		'label'        => __( 'Header', 'hotel-galaxy'),
		'type'=>'text',
		'priority'=> 2,
		'section'    => 'home_blog_section',
		'settings'   => 'hotel_galaxy_option[home_blog_section_header]',
	));

//display header
	$wp_customize->add_setting(	'hotel_galaxy_option[is_home_blog_header]',array(
		'type'    => 'option',
		'default'=>$defaults['is_home_blog_header'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_checkbox',	
		'capability'        => 'edit_theme_options',
	)
);

	$wp_customize->add_control( 'hotel_galaxy_option[is_home_blog_header]', array(
		'label'        => __( 'Display Header', 'hotel-galaxy'),
		'type'=>'checkbox',
		'priority'=> 2,
		'section'    => 'home_blog_section',
		'settings'   => 'hotel_galaxy_option[is_home_blog_header]',
	) );

//Blog description
	$wp_customize->add_setting('hotel_galaxy_option[home_blog_section_sub_header]',array(
		'type'=>'option',
		'default'=>$defaults['home_blog_section_sub_header'],	
		'sanitize_callback'=>'hotelgalaxy_not_sanitize',
		'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control( 'hotel_galaxy_option[home_blog_section_sub_header]', array(
		'label'        => __( 'Sub Header', 'hotel-galaxy'),
		'type'=>'textarea',
		'priority'=> 3,
		'section'    => 'home_blog_section',
		'settings'   => 'hotel_galaxy_option[home_blog_section_sub_header]',
	));

//display subheader
	$wp_customize->add_setting(	'hotel_galaxy_option[is_home_blog_sub_header]',array(
		'type'    => 'option',
		'default'=>$defaults['is_home_blog_sub_header'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_checkbox',	
		'capability'        => 'edit_theme_options',
	)
);

	$wp_customize->add_control( 'hotel_galaxy_option[is_home_blog_sub_header]', array(
		'label'        => __( 'Display sub-header', 'hotel-galaxy'),
		'type'=>'checkbox',
		'priority'=> 3,
		'section'    => 'home_blog_section',
		'settings'   => 'hotel_galaxy_option[is_home_blog_sub_header]',
	) );

// column

	$wp_customize->add_setting(
		'hotel_galaxy_option[home_blog_column]',
		array(
			'default' => $defaults['home_blog_column'],
			'type' => 'option',
			'sanitize_callback' => 'hotelgalaxy_sanitize_selectbox'
		)
	);

	$wp_customize->add_control(
		'hotel_galaxy_option[home_blog_column]',
		array(
			'type' => 'select',
			'label' => esc_html__( 'Column', 'hotel-galaxy'),
			'section' => 'home_blog_section',
			'priority'=> 4,
			'choices' => array(
				'col-md-6' => esc_html__( '2 column', 'hotel-galaxy'),
				'col-md-4' => esc_html__( '3 column', 'hotel-galaxy'),
				'col-md-3' => esc_html__( '4 column', 'hotel-galaxy'),
			),
			'settings' => 'hotel_galaxy_option[home_blog_column]',
		)
	);

	$wp_customize->add_setting('hotel_galaxy_option[home_blog_category]',array(
		'default' =>$defaults['home_blog_category'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'hotel_galaxy_room_sanitize',
		'type'=>'option',
	) );

	$wp_customize->add_control( new Hotelgalaxy_RoomCategory_Dropdown_Control( $wp_customize, 'hotel_galaxy_option[home_blog_category]', array(
		'label'   => __('Select Category to Show','hotel-galaxy'),
		'section' => 'home_blog_section',
		'priority'=> 5,	
		'settings'   =>  'hotel_galaxy_option[home_blog_category]',
	) ) );


}

?>