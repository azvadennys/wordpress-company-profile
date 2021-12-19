<?php
function homepage_testimonial_section( $wp_customize ){
	
	/* Testimonial Settings */
    $wp_customize->add_section( 'testimonial_section' , array(
        'title'      => __('Testimonial', 'business-a'),
        'panel'  => 'frontpage'
    ) );

        $wp_customize->add_setting( 'business_option[testimonial_section_enable]' , array(
            'default'    => true,
            'sanitize_callback' => 'sanitize_text_field',
            'type'=>'option'
        ));
        $wp_customize->add_control('business_option[testimonial_section_enable]' , array(
            'label' => __('Enable Testimonial Section','business-a'),
            'section' => 'testimonial_section',
            'type'=>'checkbox',
        ) );

        $wp_customize->add_setting( 'business_option[testimonial_section_title]' , array(
            'default'    => '',
            'sanitize_callback' => 'sanitize_text_field',
            'type'=>'option'
        ));
        $wp_customize->add_control('business_option[testimonial_section_title]' , array(
            'label' => __('Section Title','business-a'),
            'section' => 'testimonial_section',
            'type'=>'text',
        ) );
        $wp_customize->selective_refresh->add_partial( 'business_option[testimonial_section_title]', array(
            'selector' => '#testimonial .section-title',
            'settings' => 'business_option[testimonial_section_title]',
        ) );
        
        $wp_customize->add_setting( 'business_option[testimonial_section_description]' , array(
            'default'    => '',
            'sanitize_callback' => 'sanitize_text_field',
            'type'=>'option'
        ));
        $wp_customize->add_control('business_option[testimonial_section_description]' , array(
            'label' => __('Section Subtitle','business-a'),
            'section' => 'testimonial_section',
            'type'=>'textarea',
        ) );
        $wp_customize->selective_refresh->add_partial( 'business_option[testimonial_section_description]', array(
            'selector' => '#testimonial .section-desc',
            'settings' => 'business_option[testimonial_section_description]',
        ) );
        
        $wp_customize->add_setting( 'business_option[testimonial_section_backgorund_color]' , array(
            'default'    => '#ffffff',
            'sanitize_callback' => 'sanitize_text_field',
            'type'=>'option'
        ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize , 'business_option[testimonial_section_backgorund_color]' , array(
            'label' => __('Background Color','business-a'),
            'section' => 'testimonial_section',
            'settings'=>'business_option[testimonial_section_backgorund_color]'
        ) ) );
        $wp_customize->add_setting( 'business_option[testimonial_section_image]' , array(
            'default' => '',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
            'type'=>'option'
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'business_option[testimonial_section_image]' ,
            array(
                'label'          => __( 'Background Image', 'business-a' ),
                'section'        => 'testimonial_section',
            ) ) );
        $wp_customize->add_setting( 'business_option[testimonial_section_image_repeat]', array(
            'default'        => 'repeat',
            'sanitize_callback' => 'sanitize_text_field',
            'type'=>'option'
        ) );
        $wp_customize->add_control(
            'business_option[testimonial_section_image_repeat]',
            array(
                'label'    => __( 'Background Repeat', 'business-a' ),
                'section'  => 'testimonial_section',
                'settings' => 'business_option[testimonial_section_image_repeat]',
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
            $wp_customize->add_setting(  'testimonial_section_contents', array(
                    'sanitize_callback' => 'businessa_repeater_sanitize',
                    'transport'         => 'postMessage',
                )
            );
            $wp_customize->add_control(   new Businessa_Repeater(  $wp_customize, 'testimonial_section_contents', array(
                        'label'                                => esc_html__( 'Testimonial Content', 'business-a' ),
                        'section'                              => 'testimonial_section',
                        'add_field_label'                      => esc_html__( 'Add new Testimonial', 'business-a' ),
                        'item_name'                            => esc_html__( 'Testimonial', 'business-a' ),
                        'max_item' => 3,
                        'customizer_repeater_image_control'    => true,
                        'customizer_repeater_title_control'    => true,
                        'customizer_repeater_subtitle_control' => true,
                        'customizer_repeater_text_control'     => true,
                        'customizer_repeater_link_control'     => true,
                        'customizer_repeater_repeater_control' => false,
                    )
                )
            );
        }
}
add_action( 'customize_register', 'homepage_testimonial_section' );