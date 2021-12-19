<?php
/**
 * Businesss a team contents
 */
function businessa_team_content( $businessa_team_content, $is_callback = false ) {
	
	$business_obj = new business_a_settings_array();
	$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() );
	
	if( $option['team_image_align'] != ''){
		$imageclass = 'text-' . $option['team_image_align'];
	}

    if ( ! empty( $businessa_team_content ) ) :
        $businessa_team_content = json_decode( $businessa_team_content );

        if ( ! empty( $businessa_team_content ) ) {

            $i = 1;
            echo '<div class="row">';
            foreach ( $businessa_team_content as $team_item ) :
                $image = ! empty( $team_item->image_url ) ? apply_filters( 'businessa_translate_single_string', $team_item->image_url, 'Team section' ) : '';
                $title = ! empty( $team_item->title ) ? apply_filters( 'businessa_translate_single_string', $team_item->title, 'Team section' ) : '';
                $subtitle = ! empty( $team_item->subtitle ) ? apply_filters( 'businessa_translate_single_string', $team_item->subtitle, 'Team section' ) : '';
                $text = ! empty( $team_item->text ) ? apply_filters( 'businessa_translate_single_string', $team_item->text, 'Team section' ) : '';
                $link = ! empty( $team_item->link ) ? apply_filters( 'businessa_translate_single_string', $team_item->link, 'Team section' ) : '';
				
				if(!$title){ return false; }
                ?>
                <div class="col-md-4 col-sm-6">
                    <div class="rdn-team-area wow flipInX animated team-size-<?php echo esc_attr( $option['team_image_size'] ); ?>">
                        <div class="team-thumbnail <?php echo $imageclass; ?>">
                            <?php if ( ! empty( $image ) ) : ?>
                                <?php
                                if ( ! empty( $link ) ) :
                                    $link_html = '<a href="' . esc_url( $link ) . '" title="'.esc_attr( $title ).'"';
                                    if ( function_exists( 'businessa_is_external_url' ) ) {
                                        $link_html .= businessa_is_external_url( $link );
                                    }
                                    $link_html .= '>';
                                    echo wp_kses_post( $link_html );
                                endif;
                                ?>
                                <img class="img"
                                     src="<?php echo esc_url( $image ); ?>"
                                    <?php
                                    if ( ! empty( $title ) ) :
                                        ?>
                                        alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
                                <?php if ( ! empty( $link ) ) : ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="team-body text-center">
                            <?php if ( ! empty( $title ) ) : ?>
                                <a class="team-title" href="<?php echo esc_url( $link ); ?>" title="<?php echo esc_attr( $title );?>"><h5><?php echo esc_html( $title ); ?></h5></a>
                            <?php endif; ?>

                             <?php if ( ! empty( $subtitle ) ) : ?>
                            <h4 class="team-degignation"><?php echo esc_html( $subtitle ); ?></h4>
                             <?php endif; ?>

                            <div class="entry-content text-center">

                                <?php if ( ! empty( $text ) ) : ?>
									<p><?php echo wp_kses_post( html_entity_decode( $text ) ); ?></p>
                                <?php endif; ?>
								
                                <?php if ( ! empty( $link ) ) : ?>
                                <p class="team-more">
                                    <a class="team-more-link" href="<?php echo esc_url( $link ); ?>" title="<?php echo esc_attr( $title );?>"><i class="fa fa-angle-double-right"></i> <?php _e('Read More','business-a') ?></a>
                                </p>
                                <?php endif; ?>

                            </div>

                        </div>
                    </div>
                </div>
                <?php
                if ( $i % 3 == 0 ) {
                    echo '</div><!-- /.row -->';
                    echo '<div class="row">';
                }
                $i++;
            endforeach;
            echo '</div>';

        }// End if().
    endif;
}

function businessa_get_team_default() {
    return apply_filters(
        'businessa_team_default_content', json_encode(
            array(
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Madison', 'business-a' ),
                    'subtitle'        => esc_html__( 'Founder', 'business-a' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c56',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb908674e06',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9148530ft',
                                'link' => 'plus.google.com',
                                'icon' => 'fa-google-plus',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9148530fc',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9150e1e89',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                        )
                    ),
                ),
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Liam', 'business-a' ),
                    'subtitle'        => esc_html__( 'Founder', 'business-a' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c66',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9155a1072',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9160ab683',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9160ab484',
                                'link' => 'pinterest.com',
                                'icon' => 'fa-pinterest',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb916ddffc9',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                        )
                    ),
                ),
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Emma', 'business-a' ),
                    'subtitle'        => esc_html__( 'Founder', 'business-a' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c76',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb917e4c69e',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb91830825c',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb918d65f2e',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb918d65f2x',
                                'link' => 'dribbble.com',
                                'icon' => 'fa-dribbble',
                            ),
                        )
                    ),
                ),

            )
        )
    );
}

/**
 * Businesss a testimonial contents
 */
function businessa_testimonial_content( $businessa_testimonial_content, $is_callback = false ) {
	$business_obj = new business_a_settings_array();
	$option = wp_parse_args(  get_option( 'business_option', array() ), $business_obj->default_data() );
	
	if( $option['testimonial_image_align'] != '' ){
    $imageclass = 'text-' . $option['testimonial_image_align'];
	}

	if( $option['testimonial_image_size'] ){
		$imageclass = $imageclass . ' test-imgsize-' . $option['testimonial_image_size'];
	}

    if ( ! empty( $businessa_testimonial_content ) ) :
        $businessa_testimonial_content = json_decode( $businessa_testimonial_content );

        if ( ! empty( $businessa_testimonial_content ) ) {

            $i = 1;
            echo '<div class="row">';
            foreach ( $businessa_testimonial_content as $item ):
			
                $image = ! empty( $item->image_url ) ? apply_filters( 'businessa_translate_single_string', $item->image_url, 'Testimonial section' ) : '';
                $title = ! empty( $item->title ) ? apply_filters( 'businessa_translate_single_string', $item->title, 'Testimonial section' ) : '';
                $subtitle = ! empty( $item->subtitle ) ? apply_filters( 'businessa_translate_single_string', $item->subtitle, 'Testimonial section' ) : '';
                $text = ! empty( $item->text ) ? apply_filters( 'businessa_translate_single_string', $item->text, 'Testimonial section' ) : '';
                $link = ! empty( $item->link ) ? apply_filters( 'businessa_translate_single_string', $item->link, 'Testimonial section' ) : '';
				if(!$title){ return false; }
                ?>
                <div class="col-md-4 col-sm-6">
                    <div class="rdn-testimonial-area flipInX animated">						
						<?php if ( ! empty( $image ) ) : ?>
                        <div class="rdn-testimonial-image <?php echo $imageclass; ?>">
							<img
								 src="<?php echo esc_url( $image ); ?>"
								<?php
								if ( ! empty( $title ) ) :
									?>
									alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
                        </div>
						<?php endif; ?>
						
                        <div class="testimonial-content text-center">
							<span class="testimonial-pos">- <?php echo $subtitle; ?></span>
							<div class="testimonial-review">
								<?php if(!empty($link)){ ?>
								<a class="testimonial-title" href="<?php echo esc_url( $link ); ?>" title="<?php echo esc_attr( $title );?>">
								<?php } ?>
									<h3><?php echo esc_html($title); ?></h3>
								<?php if(!empty($link)){ ?>
								</a>
								<?php } ?>
								
								<p class="review-content"><i class="fa fa-quote-left"></i> <?php echo esc_html( $text ); ?></p>
							</div>
                        </div>
                    </div>
                </div>
                <?php
                if ( $i % 3 == 0 ) {
                    echo '</div><!-- /.row -->';
                    echo '<div class="row">';
                }
                $i++;
            endforeach;
            echo '</div>';

        }// End if().
    endif;
}
function businessa_get_testimonial_default() {
    return apply_filters(
        'businessa_testimonial_default_content', json_encode(
            array(
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Jackson', 'business-a' ),
                    'subtitle'        => esc_html__( 'Designer', 'business-a' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c56',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb908674e06',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9148530ft',
                                'link' => 'plus.google.com',
                                'icon' => 'fa-google-plus',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9148530fc',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9150e1e89',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                        )
                    ),
                ),
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Addison', 'business-a' ),
                    'subtitle'        => esc_html__( 'Developer', 'business-a' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c66',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9155a1072',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9160ab683',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9160ab484',
                                'link' => 'pinterest.com',
                                'icon' => 'fa-pinterest',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb916ddffc9',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                        )
                    ),
                ),
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'John', 'business-a' ),
                    'subtitle'        => esc_html__( 'CEO', 'business-a' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c76',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb917e4c69e',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb91830825c',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb918d65f2e',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb918d65f2x',
                                'link' => 'dribbble.com',
                                'icon' => 'fa-dribbble',
                            ),
                        )
                    ),
                ),

            )
        )
    );
}


/**
 * Businesss a service contents
 */
function businessa_service_content( $businessa_service_content, $is_callback = false ) {

    if ( ! empty( $businessa_service_content ) ) :
        $businessa_service_content = json_decode( $businessa_service_content );

        if ( ! empty( $businessa_service_content ) ) {

            $i = 1;
            echo '<div class="row">';
            foreach ( $businessa_service_content as $features_item ) :
                $icon = ! empty( $features_item->icon_value ) ? apply_filters( 'businessa_translate_single_string', $features_item->icon_value, 'Service section' ) : '';
                $image = ! empty( $features_item->image_url ) ? apply_filters( 'businessa_translate_single_string', $features_item->image_url, 'Service section' ) : '';
                $title = ! empty( $features_item->title ) ? apply_filters( 'businessa_translate_single_string', $features_item->title, 'Service section' ) : '';
                $text = ! empty( $features_item->text ) ? apply_filters( 'businessa_translate_single_string', $features_item->text, 'Service section' ) : '';
                $link = ! empty( $features_item->link ) ? apply_filters( 'businessa_translate_single_string', $features_item->link, 'Service section' ) : '';
                $color = ! empty( $features_item->color ) ? $features_item->color : '';
                $choice = ! empty( $features_item->choice ) ? $features_item->choice : 'customizer_repeater_icon';
				
				if(!$title){ return false; }
                ?>
                <div class="col-md-4 col-sm-6">
                    <div class="rdn-service-area wow flipInX animated text-center">

                        <?php if( !empty( $icon ) ){ ?>
                        <div class="rdn-service-icon-area">
                            <a class="rdn-service-icon" href="<?php echo esc_url( $link ); ?>" title="<?php echo esc_attr( $title );?>"><i class="fa <?php echo esc_html(  $icon ); ?>"></i></a>
                        </div>
                        <?php } ?>

                        <h3 class="rdn-service-title">
                            <a href="<?php echo esc_url( $link ); ?>" title="<?php echo esc_attr( $title );?>">
                                <?php echo esc_html( $title ); ?>	
							</a>
                        </h3>

                         <?php if ( ! empty( $text ) ) { ?>
                        <p><?php echo wp_kses_post( html_entity_decode( $text ) ); ?></p>
                        <?php } ?>

                        <?php if( !empty( $link ) ){ ?>
                        <a class="rdn-service-btn" href="<?php echo esc_url( $link ); ?>" title="<?php echo esc_attr( $title );?>"><?php printf(sprintf(__('Read More%s','business-a'),'<span class="screen-reader-text">'.esc_html( $title ).'</span>'));?></a>
                        <?php } ?>
                </div>
                </div>
                <?php
                if ( $i % 3 == 0 ) {
                    echo '</div><!-- /.row -->';
                    echo '<div class="row">';
                }
                $i++;
            endforeach;
            echo '</div>';

        }// End if().
    endif;
}
function businessa_get_service_default() {
    return apply_filters(
        'businessa_service_default_content', json_encode(
            array(
                array(
                    'icon_value' => 'fa-desktop',
                    'title'      => esc_html__( 'Responsive', 'business-a' ),
                    'text'       => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'link'       => '#',
                    'color'      => '#e91e63',
                ),
                array(
                    'icon_value' => 'fa-cog',
                    'title'      => esc_html__( 'Woo-commerce', 'business-a' ),
                    'text'       => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'link'       => '#',
                    'color'      => '#00bcd4',
                ),
                array(
                    'icon_value' => 'fa-paper-plane-o',
                    'title'      => esc_html__( 'Easy Customizable', 'business-a' ),
                    'text'       => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-a' ),
                    'link'       => '#',
                    'color'      => '#4caf50',
                ),
            )
        )
    );
}