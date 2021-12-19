<?php
function homepage_service_section( $wp_customize ){
	
	/* Service Settings */
	$wp_customize->add_section( 'service_section' , array(
		'title'      => __('Service', 'business-a' ),
		'panel'  => 'frontpage',
		'description'=> 'Show your services in your front page. First you setup your front page. <a target="_blank" href="'.esc_url( admin_url('options-reading.php') ).'">Click Here!</a>',
	) );
		
		// service section enable/disable
		$wp_customize->add_setting( 'business_option[service_section_enable]' , array(
		'default'    => true,
		'sanitize_callback' => 'business_a_sanitize_checkbox',
		'type'=>'option'
		));

		$wp_customize->add_control('business_option[service_section_enable]' , array(
		'label' => __('Enable Service Section','business-a' ),
		'section' => 'service_section',
		'type'=>'checkbox',
		) );
	
		// service section title
		$wp_customize->add_setting( 'business_option[service_section_title]' , array(
		'default'    => '',
		'sanitize_callback' => 'sanitize_text_field',
		'type'=>'option'
		));
		$wp_customize->add_control('business_option[service_section_title]' , array(
		'label' => __('Service Section Title','business-a' ),
		'section' => 'service_section',
		'type'=>'text',
		) );
		$wp_customize->selective_refresh->add_partial( 'business_option[service_section_title]', array(
			'selector' => '#service .section-title',
			'settings' => 'business_option[service_section_title]',
		) );
		
		// service section description
		$wp_customize->add_setting( 'business_option[service_section_description]' , array(
		'default'    => '',
		'sanitize_callback' => 'sanitize_text_field',
		'type'=>'option'
		));
		$wp_customize->add_control('business_option[service_section_description]' , array(
		'label' => __('Service Section Description','business-a' ),
		'section' => 'service_section',
		'type'=>'text',
		) );
		$wp_customize->selective_refresh->add_partial( 'business_option[service_section_description]', array(
			'selector' => '#service .section-desc',
			'settings' => 'business_option[service_section_description]',
		) );
		
		// service section background color
		$wp_customize->add_setting( 'business_option[service_section_backgorund_color]' , array(
		'default'    => '#ffffff',
		'sanitize_callback' => 'sanitize_text_field',
		'type'=>'option'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize , 'business_option[service_section_backgorund_color]' , array(
		'label' => __('Section Background Color','business-a' ),
		'section' => 'service_section',
		'settings'=>'business_option[service_section_backgorund_color]'
		) ) );
		
		// service section image
		$wp_customize->add_setting( 'business_option[service_section_image]' , array(
		'default' => '',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
		'type'=>'option'
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'business_option[service_section_image]' ,
		array(
		'label'          => __( 'Service Section Image', 'business-a' ),
		'description'=> __('Upload your background image minimum size ( 1600 x 900 ).','business-a'),
		'section'        => 'service_section',
	    ) )	);
		
		$wp_customize->add_setting( 'business_option[service_section_image_repeat]', array(
			'default'        => 'repeat',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
		) );
		$wp_customize->add_control(
			'business_option[service_section_image_repeat]', 
			array(
				'label'    => __( 'Background Repeat', 'business-a' ),
				'section'  => 'service_section',
				'settings' => 'business_option[service_section_image_repeat]',
				'type'     => 'select',
				'choices'  => array(
					'no-repeat'  => __('No Repeat','business-a'),
					'repeat'     => __('Tile','business-a'),
					'repeat-x'   => __('Tile Horizontally','business-a'),
					'repeat-y'   => __('Tile Vertically','business-a'),
				),
			)
		);

    if ( class_exists( 'Businessa_Repeater' ) ) {
        $wp_customize->add_setting(  'service_section_contents', array(
                'sanitize_callback' => 'businessa_repeater_sanitize',
                'transport'         => 'postMessage',
            )
        );
        $wp_customize->add_control(   new Businessa_Repeater(  $wp_customize, 'service_section_contents', array(
                    'label' => esc_html__( 'Service Content', 'business-a' ),
                    'section'=> 'service_section',
                    'add_field_label' => esc_html__( 'Add new Service', 'business-a' ),
                    'item_name' => esc_html__( 'Service', 'business-a' ),
                    'max_item' => 3,
                    'customizer_repeater_icon_control'  => true,
                    'customizer_repeater_title_control' => true,
                    'customizer_repeater_text_control'  => true,
                    'customizer_repeater_link_control'  => true,
                    'customizer_repeater_color_control' => false,
                )
            )
        );
    }
}
add_action( 'customize_register', 'homepage_service_section' );