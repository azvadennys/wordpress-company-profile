<?php 

if ( ! defined( 'ABSPATH' ) ) {	exit; }

add_action( 'customize_register', 'hotelgalaxy_home_contact_settings' );

function hotelgalaxy_home_contact_settings( $wp_customize ){

	if(!function_exists('hotelgalaxy_get_default')){
		return false;
	}

	$defaults = hotelgalaxy_get_default();


		// contact header
	$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[home_shortcode_section_header]', array(
		'selector' => '#main-home-shortcode .section-header h2',
		'render_callback' => function(){ return $defaults['home_shortcode_section_header']; },
	) );

		// contact sub header
	$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[home_shortcode_section_sub_header]', array(
		'selector' => '#main-home-shortcode .section-header .sub-header',
		'render_callback' => function(){ return $defaults['home_shortcode_section_sub_header']; },
	) );

	if ( ! $wp_customize->get_panel( 'hotelgalaxy_homepage_layout' ) ) {
		$wp_customize->add_panel( 'hotelgalaxy_homepage_layout', array(
			'priority' => 26,
			'title' => __( 'Homepage Sections', 'hotel-galaxy'),
		) );
	}

	if(!$wp_customize->get_section('shortcode_sec')){

		$wp_customize->add_section('shortcode_sec',array(
			'title' => __( 'Contact','hotel-galaxy'),
			'description' => '',
			'panel'=>'hotelgalaxy_homepage_layout',
			'capability'=>'edit_theme_options',
			'priority' => 37,			
		));
	}

	//section show or hide
$wp_customize->add_setting(	'hotel_galaxy_option[is_home_shortcode_section]',array(
	'type'    => 'option',
	'default'=>$defaults['is_home_shortcode_section'],
	'sanitize_callback'=>'hotelgalaxy_sanitize_checkbox',	
	'capability'        => 'edit_theme_options',
	)
);
$wp_customize->add_control( 'hotel_galaxy_option[is_home_shortcode_section]', array(
	'label'        => __( 'Display Section', 'hotel-galaxy'),
	'type'=>'checkbox',
	'section'    => 'shortcode_sec',
	'settings'   => 'hotel_galaxy_option[is_home_shortcode_section]',
	'priority' => 1,
	) );

//display seprator
$wp_customize->add_setting(	'hotel_galaxy_option[is_shortcode_seprator]',array(
	'type'    => 'option',
	'default'=>$defaults['is_shortcode_seprator'],
	'sanitize_callback'=>'hotelgalaxy_sanitize_checkbox',	
	'capability'        => 'edit_theme_options',
));

$wp_customize->add_control( 'is_shortcode_seprator', array(
	'label'        => __( 'Display Seprator', 'hotel-galaxy'),
	'type'=>'checkbox',
	'priority'=> 1,
	'section'    => 'shortcode_sec',
	'settings'   => 'hotel_galaxy_option[is_shortcode_seprator]',
) );

//contact title

$wp_customize->add_setting('hotel_galaxy_option[home_shortcode_section_header]',array(
	'type'=>'option',
	'default'=>$defaults['home_shortcode_section_header'],	
	'sanitize_callback'=>'hotelgalaxy_not_sanitize',
	'capability'        => 'edit_theme_options',
	));

$wp_customize->add_control( 'hotel_galaxy_option[home_shortcode_section_header]', array(
	'label'        => __( 'Header', 'hotel-galaxy'),
	'type'=>'text',
	'section'    => 'shortcode_sec',
	'settings'   => 'hotel_galaxy_option[home_shortcode_section_header]',
	'priority'=> 1,
	));

//display header
$wp_customize->add_setting(	'hotel_galaxy_option[is_home_shortcode_header]',array(
	'type'    => 'option',
	'default'=>$defaults['is_home_shortcode_header'],
	'sanitize_callback'=>'hotelgalaxy_sanitize_checkbox',	
	'capability'        => 'edit_theme_options',

	)
);
$wp_customize->add_control( 'is_home_shortcode_header', array(
	'label'        => __( 'Display header', 'hotel-galaxy'),
	'type'=>'checkbox',
	'section'    => 'shortcode_sec',
	'settings'   => 'hotel_galaxy_option[is_home_shortcode_header]',
	'priority'=> 1,
	) );


//contact description
$wp_customize->add_setting('hotel_galaxy_option[home_shortcode_section_sub_header]',array(
	'type'=>'option',
	'default'=>$defaults['home_shortcode_section_sub_header'],	
	'sanitize_callback'=>'hotelgalaxy_not_sanitize',
	'capability'        => 'edit_theme_options',
	));

$wp_customize->add_control( 'hotel_galaxy_option[home_shortcode_section_sub_header]', array(
	'label'        => __( 'Sub Header', 'hotel-galaxy'),
	'type'=>'textarea',
	'section'    => 'shortcode_sec',
	'settings'   => 'hotel_galaxy_option[home_shortcode_section_sub_header]',
	'priority'=> 2,
	));

//display subheader
$wp_customize->add_setting(	'hotel_galaxy_option[is_home_shortcode_sub_header]',array(
	'type'    => 'option',
	'default'=>$defaults['is_home_shortcode_sub_header'],
	'sanitize_callback'=>'hotelgalaxy_sanitize_checkbox',	
	'capability'        => 'edit_theme_options',
	)
);
$wp_customize->add_control( 'is_home_shortcode_sub_header', array(
	'label'        => __( 'Display sub-header', 'hotel-galaxy'),
	'type'=>'checkbox',
	'section'    => 'shortcode_sec',
	'settings'   => 'hotel_galaxy_option[is_home_shortcode_sub_header]',
	'priority'=> 2,
	) );


//contact form 7 shortcode
$wp_customize->add_setting('hotel_galaxy_option[shortcode_echo]',array(
	'type'=>'option',
	'default'=>$defaults['shortcode_echo'],	
	'sanitize_callback'=>'hotelgalaxy_sanitize_text',
	'capability'        => 'edit_theme_options',
	));
$wp_customize->add_control( 'shortcode_echo', array(
	'label'        => __( 'Contact Form 7 Shortcode', 'hotel-galaxy'),
	'type'=>'text',
	'section'    => 'shortcode_sec',
	'settings'   => 'hotel_galaxy_option[shortcode_echo]',
	'priority'=> 3,
	));


$wp_customize->add_control(
	new Hotelgalaxy_Title_Control(
		$wp_customize,
		'hotelgalaxy_contact_information',
		array(
			'section' => 'shortcode_sec',
			'type' => 'hotelgalaxy-title-control',
			'title'	=> __( 'Contact Information', 'hotel-galaxy'),
			'priority'=> 3,
			'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
		)
	)
);

//address title
$wp_customize->add_setting(	'hotel_galaxy_option[office_address_title]',array(
	'type'    => 'option',
	'default'=>$defaults['office_address_title'],
	'sanitize_callback'=>'hotelgalaxy_sanitize_text',	
	'capability'        => 'edit_theme_options',

	)
);
$wp_customize->add_control( 'hotel_galaxy_option[office_address_title]', array(
	'label'        => __( 'Address Title', 'hotel-galaxy'),
	'type'=>'text',
	'section'    => 'shortcode_sec',
	'settings'   => 'hotel_galaxy_option[office_address_title]',
	'priority'=> 4,
	) );


// address sub-title
$wp_customize->add_setting('hotel_galaxy_option[office_address]',array(
	'type'=>'option',
	'default'=>$defaults['office_address'],
	'sanitize_callback'=>'hotelgalaxy_not_sanitize',	
	'capability'        => 'edit_theme_options',
));
$wp_customize->add_control( 'hotel_galaxy_option[office_address]', array(
	'label'        => __( 'Address Sub-title', 'hotel-galaxy' ),
	'type'=>'text',
	'section'    => 'shortcode_sec',	
	'priority'    => 4,	
	'settings'   => 'hotel_galaxy_option[office_address]',
));

$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[office_address_title]', array(
	'selector' => '#main-home-shortcode .address-unit .inner-box h3',
	'render_callback' => function(){ return $default['office_address_title']; },
) );

$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[office_address]', array(
	'selector' => '#main-home-shortcode .address-unit .inner-box p',
	'render_callback' => function(){ return $default['office_address']; },
) );


//phone title
$wp_customize->add_setting(	'hotel_galaxy_option[office_phone_title]',array(
	'type'    => 'option',
	'default'=>$defaults['office_phone_title'],
	'sanitize_callback'=>'hotelgalaxy_sanitize_text',	
	'capability'        => 'edit_theme_options',

	)
);
$wp_customize->add_control( 'hotel_galaxy_option[office_phone_title]', array(
	'label'        => __( 'Phone Title', 'hotel-galaxy'),
	'type'=>'text',
	'section'    => 'shortcode_sec',
	'settings'   => 'hotel_galaxy_option[office_phone_title]',
	'priority'=> 5,
	) );


// phone sub-title
$wp_customize->add_setting('hotel_galaxy_option[office_phone]',array(
	'type'=>'option',
	'default'=>$defaults['office_phone'],
	'sanitize_callback'=>'hotelgalaxy_not_sanitize',	
	'capability'        => 'edit_theme_options',
));
$wp_customize->add_control( 'hotel_galaxy_option[office_phone]', array(
	'label'        => __( 'phone Sub-title', 'hotel-galaxy' ),
	'type'=>'text',
	'section'    => 'shortcode_sec',	
	'priority'    => 5,	
	'settings'   => 'hotel_galaxy_option[office_phone]',
));

$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[office_phone_title]', array(
	'selector' => '#main-home-shortcode .phone-unit .inner-box h',
	'render_callback' => function(){ return $defaul3['office_phone_title']; },
) );

$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[office_phone]', array(
	'selector' => '#main-home-shortcode .phone-unit .inner-box p',
	'render_callback' => function(){ return $default['office_phone']; },
) );


//email title
$wp_customize->add_setting(	'hotel_galaxy_option[office_email_title]',array(
	'type'    => 'option',
	'default'=>$defaults['office_email_title'],
	'sanitize_callback'=>'hotelgalaxy_sanitize_text',	
	'capability'        => 'edit_theme_options',

	)
);
$wp_customize->add_control( 'hotel_galaxy_option[office_email_title]', array(
	'label'        => __( 'Email Title', 'hotel-galaxy'),
	'type'=>'text',
	'section'    => 'shortcode_sec',
	'settings'   => 'hotel_galaxy_option[office_email_title]',
	'priority'=> 6,
	) );


// email sub-title
$wp_customize->add_setting('hotel_galaxy_option[office_email]',array(
	'type'=>'option',
	'default'=>$defaults['office_email'],
	'sanitize_callback'=>'hotelgalaxy_not_sanitize',	
	'capability'        => 'edit_theme_options',
));
$wp_customize->add_control( 'hotel_galaxy_option[office_email]', array(
	'label'        => __( 'Email Sub-title', 'hotel-galaxy' ),
	'type'=>'text',
	'section'    => 'shortcode_sec',	
	'priority'    => 6,	
	'settings'   => 'hotel_galaxy_option[office_email]',
));

$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[office_email_title]', array(
	'selector' => '#main-home-shortcode .email-unit .inner-box h',
	'render_callback' => function(){ return $defaul3['office_email_title']; },
) );

$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[office_email]', array(
	'selector' => '#main-home-shortcode .email-unit .inner-box p',
	'render_callback' => function(){ return $default['office_email']; },
) );


//Office Time title
$wp_customize->add_setting(	'hotel_galaxy_option[office_open_hours_title]',array(
	'type'    => 'option',
	'default'=>$defaults['office_open_hours_title'],
	'sanitize_callback'=>'hotelgalaxy_sanitize_text',	
	'capability'        => 'edit_theme_options',

	)
);
$wp_customize->add_control( 'hotel_galaxy_option[office_open_hours_title]', array(
	'label'        => __( 'Office Time Title', 'hotel-galaxy'),
	'type'=>'text',
	'section'    => 'shortcode_sec',
	'settings'   => 'hotel_galaxy_option[office_open_hours_title]',
	'priority'=> 7,
	) );


// Office Time sub-title
$wp_customize->add_setting('hotel_galaxy_option[office_open_hours]',array(
	'type'=>'option',
	'default'=>$defaults['office_open_hours'],
	'sanitize_callback'=>'hotelgalaxy_not_sanitize',	
	'capability'        => 'edit_theme_options',
));
$wp_customize->add_control( 'hotel_galaxy_option[office_open_hours]', array(
	'label'        => __( 'Office Time Sub-title', 'hotel-galaxy' ),
	'type'=>'text',
	'section'    => 'shortcode_sec',	
	'priority'    => 7,	
	'settings'   => 'hotel_galaxy_option[office_open_hours]',
));

$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[office_open_hours_title]', array(
	'selector' => '#main-home-shortcode .hours-unit .inner-box h',
	'render_callback' => function(){ return $defaul3['office_open_hours_title']; },
) );

$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[office_open_hours]', array(
	'selector' => '#main-home-shortcode .hours-unit .inner-box p',
	'render_callback' => function(){ return $default['office_open_hours']; },
) );

}

?>