<?php
function homepage_shop_section( $wp_customize ){

	if ( class_exists( 'woocommerce' ) ){

		/* shop Settings */
		$wp_customize->add_section( 'shop_sections' , array(
			'title'      => __('Shop', 'business-a' ),
			'panel'  => 'frontpage'
		) );

			// shop section enable/disable
			$wp_customize->add_setting( 'business_option[shop_section_enable]' , array(
			'default'    => true,
			'sanitize_callback' => 'business_a_sanitize_checkbox',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[shop_section_enable]' , array(
			'label' => __('Enable Shop Section','business-a' ),
			'section' => 'shop_sections',
			'type'=>'checkbox',
			) );
		
			// shop section title
			$wp_customize->add_setting( 'business_option[shop_section_title]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));
			$wp_customize->add_control('business_option[shop_section_title]' , array(
			'label' => __('Section Title','business-a' ),
			'section' => 'shop_sections',
			'type'=>'text',
			) );
			$wp_customize->selective_refresh->add_partial( 'business_option[shop_section_title]', array(
				'selector' => '#shop .section-title',
				'settings' => 'business_option[shop_section_title]',
			) );
			
			// shop section description
			$wp_customize->add_setting( 'business_option[shop_section_description]' , array(
			'default'    => '',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));
			$wp_customize->add_control('business_option[shop_section_description]' , array(
			'label' => __('Section Subtitle','business-a' ),
			'section' => 'shop_sections',
			'type'=>'text',
			) );
			$wp_customize->selective_refresh->add_partial( 'business_option[shop_section_description]', array(
				'selector' => '#shop .section-desc',
				'settings' => 'business_option[shop_section_description]',
			) );
			
			// shop no of show
			$wp_customize->add_setting( 'business_option[shop_no_of_show]' , array(
			'default'    => 4,
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));

			$wp_customize->add_control('business_option[shop_no_of_show]' , array(
			'label' => __('Products No Of Show','business-a' ),
			'section' => 'shop_sections',
			'type'=>'number',
			) );
		
			// shop section background color
			$wp_customize->add_setting( 'business_option[shop_section_backgorund_color]' , array(
			'default'    => '#ffffff',
			'sanitize_callback' => 'sanitize_text_field',
			'type'=>'option'
			));
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize , 'business_option[shop_section_backgorund_color]' , array(
			'label' => __('Section Background Color','business-a' ),
			'section' => 'shop_sections',
			'settings'=>'business_option[shop_section_backgorund_color]'
			) ) );
			
			// Shop section image
			$wp_customize->add_setting( 'business_option[shop_section_image]' , array(
			'default' => '',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
			'type'=>'option'
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'business_option[shop_section_image]' ,
			array(
			'label'          => __( 'Shop Section Image', 'business-a' ),
			'section'        => 'shop_sections',
		    ) )	);
			
			$wp_customize->add_setting( 'business_option[shop_section_image_repeat]', array(
				'default'        => 'repeat',
				'sanitize_callback' => 'sanitize_text_field',
				'type'=>'option'
			) );
			$wp_customize->add_control(
				'business_option[shop_section_image_repeat]', 
				array(
					'label'    => __( 'Background Repeat', 'business-a' ),
					'section'  => 'shop_sections',
					'settings' => 'business_option[shop_section_image_repeat]',
					'type'     => 'select',
					'choices'  => array(
						'no-repeat'  => __('No Repeat','business-a'),
						'repeat'     => __('Tile','business-a'),
						'repeat-x'   => __('Tile Horizontally','business-a'),
						'repeat-y'   => __('Tile Vertically','business-a'),
					),
				)
			);
			
	}
	
}
add_action( 'customize_register', 'homepage_shop_section' );