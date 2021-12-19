<?php 

if ( ! defined( 'ABSPATH' ) ) {	exit; } 

add_action( 'customize_register', 'hotelgalaxy_above_bar_setting' );
function hotelgalaxy_above_bar_setting( $wp_customize ){

	if(!function_exists('hotelgalaxy_get_default')){
		return false;
	}

	$defaults = hotelgalaxy_get_default();

	$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[information_title_1]', array(
		'selector' => '#info-1',
		'render_callback' => function(){ return $defaults['information_title_1']; },
	) );

	$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[information_title_2]', array(
		'selector' => '#info-2',
		'render_callback' => function(){ return $defaults['information_title_2']; },
	) );

	$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[socialmedia_icon_1]', array(
		'selector' => '.info-bar .user-social',
		'render_callback' => function(){ return $defaults['socialmedia_icon_1']; },
	) );

		// menu search icon

	$wp_customize->selective_refresh->add_partial( 'hotel_galaxy_option[is_menubar_search_icon]', array(
		'selector' => 'a.header_search_btn',
		'render_callback' => function(){ return $defaults['is_menubar_search_icon']; },
	) );

	

	if ( ! $wp_customize->get_panel( 'hotelgalaxy_theme_layout' ) ) {
		$wp_customize->add_panel( 'hotelgalaxy_theme_layout', array(
			'priority' => 27,
			'title' => __( 'Layout', 'hotel-galaxy'),
		) );
	}

	if ( ! $wp_customize->get_section( 'infobar_section' ) ) {

		$wp_customize->add_section('infobar_section',array(
			'title' => __( 'Above Information Bar','hotel-galaxy'),
			'panel'=>'hotelgalaxy_theme_layout',
			'capability'=>'edit_theme_options',
			'priority' => 3,			
		));

	}


//section show or hide
	$wp_customize->add_setting(	'hotel_galaxy_option[is_information_bar]',array(
		'type'    => 'option',
		'default'=>$defaults['is_information_bar'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_checkbox',	
		'capability'        => 'edit_theme_options',
	)
);

	$wp_customize->add_control( 'is_information_bar', array(
		'label'        => __( 'Display Section', 'hotel-galaxy'),
		'type'=>'checkbox',
		'priority'=> 1,
		'section'    => 'infobar_section',
		'settings'   => 'hotel_galaxy_option[is_information_bar]',
	) );

// social media

	$wp_customize->add_control(
		new Hotelgalaxy_Title_Control(
			$wp_customize,
			'hotelgalaxy_infobar_information_title',
			array(
				'section' => 'infobar_section',
				'priority' => 1,
				'type' => 'hotelgalaxy-title-control',
				'title'	=> __( 'Above Bar Settings', 'hotel-galaxy'),
				'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
			)
		)
	);

	
// info 1

	$wp_customize->add_control(
		new Hotelgalaxy_Title_Control(
			$wp_customize,
			'hotelgalaxy_infobar_information_title_1',
			array(
				'section' => 'infobar_section',
				'type' => 'hotelgalaxy-title-control',
				'title'	=> __( 'Information 1', 'hotel-galaxy'),
				'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
			)
		)
	);

	// icon  
	$wp_customize->add_setting(
		'hotel_galaxy_option[information_title_1]',
		array(
			'default'=> esc_html( $defaults['information_title_1']),
			'type'=>'option',
			'sanitize_callback' => 'hotelgalaxy_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( new Hotelgalaxy_Icon_Picker_Control($wp_customize, 
		'hotel_galaxy_option[information_title_1]',
		array(
			'label'   		=>  null,
			'section' 		=> 'infobar_section',		
			'settings'   =>'hotel_galaxy_option[information_title_1]',
		))  
);	

// text
	$wp_customize->add_setting('hotel_galaxy_option[information_text_1]',array(
		'type'=>'option',
		'default'=> esc_html( $defaults['information_text_1']),	
		'sanitize_callback'=>'hotelgalaxy_sanitize_text',
		'capability'        => 'edit_theme_options',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control('hotel_galaxy_option[information_text_1]', array(
		'label'        => null,
		'description' => __( 'Text','hotel-galaxy'),
		'type'=>'text',
		'section'    => 'infobar_section',
		'settings'   => 'hotel_galaxy_option[information_text_1]',

	) );


// info 2

	$wp_customize->add_control(
		new Hotelgalaxy_Title_Control(
			$wp_customize,
			'hotelgalaxy_infobar_information_title_2',
			array(
				'section' => 'infobar_section',
				'type' => 'hotelgalaxy-title-control',
				'title'	=> __( 'Information 2', 'hotel-galaxy'),
				'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
			)
		)
	);

	// icon  
	$wp_customize->add_setting(
		'hotel_galaxy_option[information_title_2]',
		array(
			'default'=> esc_html( $defaults['information_title_2']),
			'type'=>'option',
			'sanitize_callback' => 'hotelgalaxy_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( new Hotelgalaxy_Icon_Picker_Control($wp_customize, 
		'hotel_galaxy_option[information_title_2]',
		array(
			'label'   		=>  null,
			'section' 		=> 'infobar_section',		
			'settings'   =>'hotel_galaxy_option[information_title_2]',
		))  
);	

// text
	$wp_customize->add_setting('hotel_galaxy_option[information_text_2]',array(
		'type'=>'option',
		'default'=> esc_html( $defaults['information_text_2']),	
		'sanitize_callback'=>'hotelgalaxy_sanitize_text',
		'capability'        => 'edit_theme_options',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control('hotel_galaxy_option[information_text_2]', array(
		'label'        => null,
		'description' => __( 'Text','hotel-galaxy'),
		'type'=>'text',
		'section'    => 'infobar_section',
		'settings'   => 'hotel_galaxy_option[information_text_2]',

	) );





// social media

	$wp_customize->add_control(
		new Hotelgalaxy_Title_Control(
			$wp_customize,
			'hotelgalaxy_infobar_socialmedia_title',
			array(
				'section' => 'infobar_section',
				'type' => 'hotelgalaxy-title-control',
				'title'	=> __( 'Social Media Settings', 'hotel-galaxy'),
				'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
			)
		)
	);

// social icons 1

	$wp_customize->add_control(
		new Hotelgalaxy_Title_Control(
			$wp_customize,
			'hotelgalaxy_infobar_socialmedia_title_1',
			array(
				'section' => 'infobar_section',
				'type' => 'hotelgalaxy-title-control',
				'title'	=> esc_html( 'Icon 1'),
				'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
			)
		)
	);	

	// icon 1
	$wp_customize->add_setting(
		'hotel_galaxy_option[socialmedia_icon_1]',
		array(
			'default'=>$defaults['socialmedia_icon_1'],
			'type'=>'option',
			'sanitize_callback' => 'hotelgalaxy_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( new Hotelgalaxy_Icon_Picker_Control( $wp_customize, 
		'hotel_galaxy_option[socialmedia_icon_1]',
		array(
			'label'   		=>  null,
			'section' 		=> 'infobar_section',		
			'settings'   => 'hotel_galaxy_option[socialmedia_icon_1]',
		))  
);	
	
	// icon url 1
	$wp_customize->add_setting('hotel_galaxy_option[socialmedia_url_1]',array(
		'type'=>'option',
		'default'=>$defaults['socialmedia_url_1'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_URL',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( 'hotel_galaxy_option[socialmedia_url_1]', array(
		'label'        => null,
		'description' => __( 'URL Ex:- https://facebook.com','hotel-galaxy'),
		'type'=>'text',
		'section'    => 'infobar_section',
		'settings'   => 'hotel_galaxy_option[socialmedia_url_1]',

	) );

	$wp_customize->add_control(
		new Hotelgalaxy_Title_Control(
			$wp_customize,
			'hotelgalaxy_infobar_socialmedia_title_2',
			array(
				'section' => 'infobar_section',
				'type' => 'hotelgalaxy-title-control',
				'title'	=> esc_html( 'Icon 2'),
				'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
			)
		)
	);	

	// icon 2
	$wp_customize->add_setting(
		'hotel_galaxy_option[socialmedia_icon_2]',
		array(
			'default'=>$defaults['socialmedia_icon_2'],
			'type'=>'option',
			'sanitize_callback' => 'hotelgalaxy_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( new Hotelgalaxy_Icon_Picker_Control( $wp_customize, 
		'hotel_galaxy_option[socialmedia_icon_2]',
		array(
			'label'   		=>  null,
			'section' 		=> 'infobar_section',		
			'settings'   => 'hotel_galaxy_option[socialmedia_icon_2]',
		))  
);	
	
	// icon url 2
	$wp_customize->add_setting('hotel_galaxy_option[socialmedia_url_2]',array(
		'type'=>'option',
		'default'=>$defaults['socialmedia_url_2'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_URL',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( 'hotel_galaxy_option[socialmedia_url_2]', array(
		'label'        => null,
		'description' => __( 'URL Ex:- https://facebook.com','hotel-galaxy'),
		'type'=>'text',
		'section'    => 'infobar_section',
		'settings'   => 'hotel_galaxy_option[socialmedia_url_2]',

	) );

	$wp_customize->add_control(
		new Hotelgalaxy_Title_Control(
			$wp_customize,
			'hotelgalaxy_infobar_socialmedia_title_3',
			array(
				'section' => 'infobar_section',
				'type' => 'hotelgalaxy-title-control',
				'title'	=> esc_html( 'Icon 3'),
				'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
			)
		)
	);	

	// icon 3
	$wp_customize->add_setting(
		'hotel_galaxy_option[socialmedia_icon_3]',
		array(
			'default'=>$defaults['socialmedia_icon_3'],
			'type'=>'option',
			'sanitize_callback' => 'hotelgalaxy_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( new Hotelgalaxy_Icon_Picker_Control( $wp_customize, 
		'hotel_galaxy_option[socialmedia_icon_3]',
		array(
			'label'   		=>  null,
			'section' 		=> 'infobar_section',		
			'settings'   => 'hotel_galaxy_option[socialmedia_icon_3]',
		))  
);	
	
	// icon url 3
	$wp_customize->add_setting('hotel_galaxy_option[socialmedia_url_3]',array(
		'type'=>'option',
		'default'=>$defaults['socialmedia_url_3'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_URL',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( 'hotel_galaxy_option[socialmedia_url_3]', array(
		'label'        => null,
		'description' => __( 'URL Ex:- https://facebook.com','hotel-galaxy'),
		'type'=>'text',
		'section'    => 'infobar_section',
		'settings'   => 'hotel_galaxy_option[socialmedia_url_3]',

	) );

	$wp_customize->add_control(
		new Hotelgalaxy_Title_Control(
			$wp_customize,
			'hotelgalaxy_infobar_socialmedia_title_4',
			array(
				'section' => 'infobar_section',
				'type' => 'hotelgalaxy-title-control',
				'title'	=> esc_html( 'Icon 4'),
				'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
			)
		)
	);	

	// icon 4
	$wp_customize->add_setting(
		'hotel_galaxy_option[socialmedia_icon_4]',
		array(
			'default'=>$defaults['socialmedia_icon_4'],
			'type'=>'option',
			'sanitize_callback' => 'hotelgalaxy_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( new Hotelgalaxy_Icon_Picker_Control( $wp_customize, 
		'hotel_galaxy_option[socialmedia_icon_4]',
		array(
			'label'   		=>  null,
			'section' 		=> 'infobar_section',		
			'settings'   => 'hotel_galaxy_option[socialmedia_icon_4]',
		))  
);	
	
	// icon url 4
	$wp_customize->add_setting('hotel_galaxy_option[socialmedia_url_4]',array(
		'type'=>'option',
		'default'=>$defaults['socialmedia_url_4'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_URL',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( 'hotel_galaxy_option[socialmedia_url_4]', array(
		'label'        => null,
		'description' => __( 'URL Ex:- https://facebook.com','hotel-galaxy'),
		'type'=>'text',
		'section'    => 'infobar_section',
		'settings'   => 'hotel_galaxy_option[socialmedia_url_4]',

	) );

	$wp_customize->add_control(
		new Hotelgalaxy_Title_Control(
			$wp_customize,
			'hotelgalaxy_infobar_socialmedia_title_5',
			array(
				'section' => 'infobar_section',
				'type' => 'hotelgalaxy-title-control',
				'title'	=> esc_html( 'Icon 5'),
				'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname',
			)
		)
	);	

	// icon 5
	$wp_customize->add_setting(
		'hotel_galaxy_option[socialmedia_icon_5]',
		array(
			'default'=>$defaults['socialmedia_icon_5'],
			'type'=>'option',
			'sanitize_callback' => 'hotelgalaxy_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( new Hotelgalaxy_Icon_Picker_Control( $wp_customize, 
		'hotel_galaxy_option[socialmedia_icon_5]',
		array(
			'label'   		=>  null,
			'section' 		=> 'infobar_section',		
			'settings'   => 'hotel_galaxy_option[socialmedia_icon_5]',
		))  
);	
	
	// icon url 5
	$wp_customize->add_setting('hotel_galaxy_option[socialmedia_url_5]',array(
		'type'=>'option',
		'default'=>$defaults['socialmedia_url_5'],
		'sanitize_callback'=>'hotelgalaxy_sanitize_URL',
		'capability'        => 'edit_theme_options',
	));

	$wp_customize->add_control( 'hotel_galaxy_option[socialmedia_url_5]', array(
		'label'        => null,
		'description' => __( 'URL Ex:- https://facebook.com','hotel-galaxy'),
		'type'=>'text',
		'section'    => 'infobar_section',
		'settings'   => 'hotel_galaxy_option[socialmedia_url_5]',

	) );
	

}



?>