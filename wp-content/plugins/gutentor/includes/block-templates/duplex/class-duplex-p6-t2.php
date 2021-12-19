<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Gutentor_Duplex_P6_T2' ) ) {

	/**
	 * Gutentor_Duplex_P6_T2 Class For Gutentor
	 *
	 * @package Gutentor
	 * @since 2.0.0
	 */
	class Gutentor_Duplex_P6_T2 extends Gutentor_Query_Elements {

		/**
		 * Gets an instance of this object.
		 * Prevents duplicate instances which avoid artefacts and improves performance.
		 *
		 * @static
		 * @access public
		 * @return object
		 * @since 2.0.0
		 */
		public static function get_instance() {
			// Store the instance locally to avoid private static replication
			static $instance = null;

			// Only run these methods if they haven't been ran previously
			if ( null === $instance ) {
				$instance = new self();
			}

			// Always return the instance
			return $instance;

		}

		/**
		 * Run Block
		 *
		 * @access public
		 * @return void
		 * @since 2.0.0
		 */
		public function run() {
			add_filter( 'gutentor_post_module_p6_query_data', array( $this, 'template_data' ), 999, 3 );
		}


		/**
		 * Get Featured Single item data
		 *
		 * @param {string} $data
		 * @param {array}  $post
		 * @param {array}  $attributes
		 * @return {mix}
		 */
		public function p6_template2_featured_single_article( $post, $attributes, $index ) {
			$output                = '';
			$enable_avatar         = isset( $attributes['pFPOnAvatar'] ) && $attributes['pFPOnAvatar'];
			$avatar_pos            = isset( $attributes['pFPAvatarPos'] ) ? $attributes['pFPAvatarPos'] : false;
			$query_sorting         = array_key_exists( 'blockFPSortableItems', $attributes ) ? $attributes['blockFPSortableItems'] : false;
			$enable_featured_image = isset( $attributes['pOnFPFImg'] ) && $attributes['pOnFPFImg'];
			$enable_post_format    = isset( $attributes['pOnFPPostFormatOpt'] ) && $attributes['pOnFPPostFormatOpt'];
			$post_format_pos       = isset( $attributes['pFPPostFormatPos'] ) ? $attributes['pFPPostFormatPos'] : false;
			$cat_pos               = ( isset( $attributes['pFPCatPos'] ) ) ? $attributes['pFPCatPos'] : false;
			$enable_featured_cat   = isset( $attributes['pOnFPFeaturedCat'] ) && $attributes['pOnFPFeaturedCat'];
			$thumb_class           = ( has_post_thumbnail() && $enable_featured_image ) ? '' : 'gutentor-post-no-thumb';
			$output               .= "<article class='" . apply_filters( 'gutentor_post_module_article_class', gutentor_concat_space( 'gutentor-post', 'gutentor-post-featured', $thumb_class, 'gutentor-post-item-' . $index ), $attributes ) . "'>";
			$output               .= '<div class="gutentor-post-featured-item">';
			if ( $enable_featured_image && gutentor_has_post_featured($post)) {
                $output .= "<div class='" . apply_filters( 'gutentor_p6_fp_post_module_post_image_box', 'gutentor-post-image-box',$post, $attributes ) . "'>";
                $output .= $this->get_featured_post_featured_image( $post, $attributes );
				if ( $enable_avatar && $this->avatar_fp_on_image_condition( $avatar_pos ) ) {
					$output .= $this->get_fp_avatar_data( $post, $attributes );
				}
				if ( $enable_post_format && $this->featured_post_format_on_image_condition( $post_format_pos ) ) {
					$output .= $this->get_featured_post_format_data( $post, $attributes );
				}
				if ( $enable_featured_cat && $this->featured_post_categories_on_image_condition( $cat_pos ) ) {
					$output .= $this->get_featured_post_module_badges_collection( $post, $attributes );
				}
				$output .= '</div>';
			}
			$output .= '<div class="gutentor-post-content">';
			if ( $query_sorting ) :
				foreach ( $query_sorting as $element ) :
					if ( ! ( array_key_exists( 'itemValue', $element ) ) ) {
						return $output;
					}
					switch ( $element['itemValue'] ) {
						case 'title':
							if ( $cat_pos === 'gutentor-fp-cat-pos-before-title' || $post_format_pos === 'gutentor-fp-pf-pos-before-title' ) {
								$output .= '<div class="gutentor-post-title-data-wrap">';
								if ( $enable_post_format && $post_format_pos === 'gutentor-fp-pf-pos-before-title' ) {

									$output .= $this->get_featured_post_format_data( $post, $attributes );
								}
								if ( $enable_featured_cat && $cat_pos === 'gutentor-fp-cat-pos-before-title' ) {

									$output .= $this->get_featured_post_module_badges_collection( $post, $attributes );
								}
								$output .= $this->get_featured_post_title( $post, $attributes );
								$output .= '</div>';
							} else {

								$output .= $this->get_featured_post_title( $post, $attributes );
							}
							break;
						case 'primary-entry-meta':
							$output .= $this->get_featured_post_primary_meta( $post, $attributes );
							break;
						case 'secondary-entry-meta':
							$output .= $this->get_featured_post_secondary_meta( $post, $attributes );
							break;
						case 'avatar':
							$output .= $this->get_fp_avatar_data( $post, $attributes );
							break;
						case 'description':
							if ( $cat_pos === 'gutentor-fp-cat-pos-before-ct-box' || $post_format_pos === 'gutentor-fp-pf-pos-before-ct-box' ) {
								$output .= '<div class="gutentor-post-desc-data-wrap">';
								if ( $enable_post_format && $post_format_pos === 'gutentor-fp-pf-pos-before-ct-box' ) {

									$output .= $this->get_featured_post_format_data( $post, $attributes );
								}
								if ( $enable_featured_cat && $cat_pos === 'gutentor-fp-cat-pos-before-ct-box' ) {

									$output .= $this->get_featured_post_module_badges_collection( $post, $attributes );
								}
								$output .= $this->get_featured_post_description( $post, $attributes );
								$output .= '</div>';
							} else {

								$output .= $this->get_featured_post_description( $post, $attributes );
							}
							break;
						case 'button':
							if ( $cat_pos === 'gutentor-fp-cat-pos-before-button' || $post_format_pos === 'gutentor-fp-pf-pos-before-button' ) {
								$output .= '<div class="gutentor-post-desc-data-wrap">';
								if ( $enable_post_format && $post_format_pos === 'gutentor-fp-pf-pos-before-button' ) {

									$output .= $this->get_featured_post_format_data( $post, $attributes );
								}
								if ( $enable_featured_cat && $cat_pos === 'gutentor-fp-cat-pos-before-button' ) {

									$output .= $this->get_featured_post_module_badges_collection( $post, $attributes );
								}
								$output .= $this->get_featured_post_button( $post, $attributes );
								$output .= '</div>';
							} else {

								$output .= $this->get_featured_post_button( $post, $attributes );
							}
							break;
						default:
							$output .= '';
							break;
					}
				endforeach;
			endif;
			$output .= '</div>';/*.gutentor-post-content*/
			$output .= '</div>';/*.gutentor-post-featured-item*/
			$output .= '</article>';/*.article*/
			return $output;

		}

		/**
		 * Get Featured Woo Single item data
		 *
		 * @param {string} $data
		 * @param {array}  $post
		 * @param {array}  $attributes
		 * @return {mix}
		 */
		public function p6_template2_fp_woo_single_article( $post, $attributes, $index ) {
			$output = '';
			if ( ! gutentor_is_woocommerce_active() ) {
				return $output;
			}

			$product               = wc_get_product( $post->ID );
			$rating                = $product->get_average_rating();
			$count                 = $product->get_rating_count();
			$rating_html           = wc_get_rating_html( $rating, $count );
			$enable_avatar         = isset( $attributes['pFPOnAvatar'] ) && $attributes['pFPOnAvatar'];
			$avatar_pos            = ( isset( $attributes['pFPAvatarPos'] ) ) ? $attributes['pFPAvatarPos'] : false;
			$query_sorting         = array_key_exists( 'blockFPSortableItems', $attributes ) ? $attributes['blockFPSortableItems'] : false;
			$enable_featured_image = isset( $attributes['pOnFPFImg'] ) && $attributes['pOnFPFImg'];
			$enable_post_format    = isset( $attributes['pOnFPPostFormatOpt'] ) && $attributes['pOnFPPostFormatOpt'];
			$post_format_pos       = ( isset( $attributes['pFPPostFormatPos'] ) ) ? $attributes['pFPPostFormatPos'] : false;
			$cat_pos               = ( isset( $attributes['pFPCatPos'] ) ) ? $attributes['pFPCatPos'] : false;
			$enable_featured_cat   = isset( $attributes['pOnFPFeaturedCat'] ) && $attributes['pOnFPFeaturedCat'];
			$output               .= "<article class='" . apply_filters( 'gutentor_post_module_article_class', gutentor_concat_space( 'gutentor-post', 'gutentor-post-featured', 'gutentor-post-item-' . $index ), $attributes ) . "'>";
			$output               .= '<div class="gutentor-post-featured-item">';
			if ( $enable_featured_image ) {
                $output .= "<div class='" . apply_filters( 'gutentor_p6_fp_post_module_post_image_box', 'gutentor-post-image-box',$post, $attributes ) . "'>";
                $output .= $this->p6_fp_get_woo_product_thumbnail( $post, $product, $attributes );
				if ( $enable_avatar && $this->avatar_fp_on_image_condition( $avatar_pos ) ) {
					$output .= $this->get_fp_avatar_data( $post, $attributes );
				}
				if ( $enable_post_format && $this->featured_post_format_on_image_condition( $post_format_pos ) ) {
					$output .= $this->p6_fp_new_badge_product( $post, $product );
				}
				if ( $enable_featured_cat && $this->featured_post_categories_on_image_condition( $cat_pos ) ) {
					$output .= $this->p6_fp_get_woo_badge( $post, $product, $attributes );
				}
				$output .= '</div>';
			}
			$output .= '<div class="gutentor-post-content">';
			if ( $query_sorting ) :
				foreach ( $query_sorting as $element ) :
					if ( ! ( array_key_exists( 'itemValue', $element ) ) ) {
						return $output;
					}
					switch ( $element['itemValue'] ) {
						case 'title':
							if ( $cat_pos === 'gutentor-fp-cat-pos-before-title' || $post_format_pos === 'gutentor-fp-pf-pos-before-title' ) {
								$output .= '<div class="gutentor-post-title-data-wrap">';
								if ( $enable_post_format && $post_format_pos === 'gutentor-fp-pf-pos-before-title' ) {

									$output .= $this->p6_fp_new_badge_product( $post, $product );
								}
								if ( $enable_featured_cat && $cat_pos === 'gutentor-fp-cat-pos-before-title' ) {

									$output .= $this->p6_fp_get_woo_badge( $post, $product, $attributes );

								}
								$output .= $this->get_featured_post_title( $post, $attributes );
								$output .= '</div>';
							} else {

								$output .= $this->get_featured_post_title( $post, $attributes );
							}
							break;
						case 'primary-entry-meta':
							$output .= $this->get_featured_post_primary_meta( $post, $attributes );
							break;
						case 'secondary-entry-meta':
							$output .= $this->get_featured_post_secondary_meta( $post, $attributes );
							break;
						case 'price':
							$output .= $this->p6_featured_wc_price( $post, $product, $attributes );
							break;
						case 'rating':
							if ( isset( $attributes['fpWooOnRating'] ) && $attributes['fpWooOnRating'] ) {
								if ( $rating_html ) {
									$output .= '<div class="gutentor-fp-wc-rating">';
									$output .= $rating_html;
									$output .= '</div>';
								}
							}
							break;
						case 'avatar':
							$output .= $this->get_fp_avatar_data( $post, $attributes );
							break;
						case 'description':
							if ( $cat_pos === 'gutentor-fp-cat-pos-before-ct-box' || $post_format_pos === 'gutentor-fp-pf-pos-before-ct-box' ) {
								$output .= '<div class="gutentor-post-desc-data-wrap">';
								if ( $enable_post_format && $post_format_pos === 'gutentor-fp-pf-pos-before-ct-box' ) {

									$output .= $this->p6_fp_new_badge_product( $post, $product );
								}
								if ( $enable_featured_cat && $cat_pos === 'gutentor-fp-cat-pos-before-ct-box' ) {

									$output .= $this->p6_fp_get_woo_badge( $post, $product, $attributes );

								}
								$output .= $this->get_featured_post_description( $post, $attributes );
								$output .= '</div>';
							} else {

								$output .= $this->get_featured_post_description( $post, $attributes );
							}
							break;
						case 'button':
							if ( $cat_pos === 'gutentor-fp-cat-pos-before-button' || $post_format_pos === 'gutentor-fp-pf-pos-before-button' ) {
								$output .= '<div class="gutentor-post-desc-data-wrap">';
								if ( $enable_post_format && $post_format_pos === 'gutentor-fp-pf-pos-before-button' ) {

									$output .= $this->p6_fp_new_badge_product( $post, $product );
								}
								if ( $enable_featured_cat && $cat_pos === 'gutentor-fp-cat-pos-before-button' ) {

									$output .= $this->p6_fp_get_woo_badge( $post, $product, $attributes );

								}
								if ( isset( $attributes['pOnFPBtn'] ) && $attributes['pOnFPBtn'] ) {
									$output .= '<div class="gutentor-woo-add-to-cart wc-block-grid__product-add-to-cart">';
									ob_start();
									woocommerce_template_loop_add_to_cart(
										array(
											'gutentor-attributes' => $attributes,
											'gutentor-btn-type' => 'featured',
										)
									);
									$output .= ob_get_clean();
									$output .= '</div>';
								}
								$output .= '</div>';
							} else {

								if ( isset( $attributes['pOnFPBtn'] ) && $attributes['pOnFPBtn'] ) {
									$output .= '<div class="gutentor-woo-add-to-cart wc-block-grid__product-add-to-cart">';
									ob_start();
									woocommerce_template_loop_add_to_cart(
										array(
											'gutentor-attributes' => $attributes,
											'gutentor-btn-type' => 'featured',
										)
									);
									$output .= ob_get_clean();
									$output .= '</div>';
								}
							}
							break;
						default:
							$output .= '';
							break;
					}
				endforeach;
			endif;
			$output .= '</div>';/*.gutentor-post-content*/
			$output .= '</div>';/*.gutentor-post-featured-item*/
			$output .= '</article>';/*.article*/
			return $output;

		}

		/**
		 * Get Featured Edd Single item data
		 *
		 * @param {string} $data
		 * @param {array}  $post
		 * @param {array}  $attributes
		 * @return {mix}
		 */
		public function p6_template2_fp_edd_single_article( $post, $attributes, $index ) {
			if ( ! gutentor_is_edd_active() ) {
				return '';
			}
			$download = edd_get_download( $post->ID );

			$output                = '';
			$enable_avatar         = isset($attributes['pFPOnAvatar']) && $attributes['pFPOnAvatar'];
			$avatar_pos            = ( isset( $attributes['pFPAvatarPos'] ) ) ? $attributes['pFPAvatarPos'] : false;
			$query_sorting         = array_key_exists( 'blockFPSortableItems', $attributes ) ? $attributes['blockFPSortableItems'] : false;
			$enable_featured_image = isset($attributes['pOnFPFImg']) && $attributes['pOnFPFImg'];
			$enable_post_format    = isset($attributes['pOnFPPostFormatOpt']) && $attributes['pOnFPPostFormatOpt'];
			$post_format_pos       = ( isset( $attributes['pFPPostFormatPos'] ) ) ? $attributes['pFPPostFormatPos'] : false;
			$output               .= "<article class='" . apply_filters( 'gutentor_post_module_article_class', gutentor_concat_space( 'gutentor-post', 'gutentor-post-featured', 'gutentor-post-item-' . $index ), $attributes ) . "'>";
			$output               .= '<div class="gutentor-post-featured-item">';
			if ( $enable_featured_image ) {
                $output .= "<div class='" . apply_filters( 'gutentor_p6_fp_post_module_post_image_box', 'gutentor-post-image-box',$post, $attributes ) . "'>";
                $output .= $this->p6_fp_get_edd_thumbnail( $post, $attributes );
				if ( $enable_avatar && $this->avatar_fp_on_image_condition( $avatar_pos ) ) {
					$output .= $this->get_fp_avatar_data( $post, $attributes );
				}
				if ( $enable_post_format && $this->featured_post_format_on_image_condition( $post_format_pos ) ) {
					$output .= $this->p6_fp_edd_new_badge_product( $post, $download );

				}
				$output .= '</div>';
			}
			$output .= '<div class="gutentor-post-content">';
			if ( $query_sorting ) :
				foreach ( $query_sorting as $element ) :
					if ( ! ( array_key_exists( 'itemValue', $element ) ) ) {
						return $output;
					}
					switch ( $element['itemValue'] ) {
						case 'title':
							if ( $post_format_pos === 'gutentor-fp-pf-pos-before-title' ) {
								$output .= '<div class="gutentor-post-title-data-wrap">';
								if ( $enable_post_format && $post_format_pos === 'gutentor-fp-pf-pos-before-title' ) {
									$output .= $this->p6_fp_edd_new_badge_product( $post, $download );
								}
								$output .= $this->get_featured_post_title( $post, $attributes );
								$output .= '</div>';
							} else {

								$output .= $this->get_featured_post_title( $post, $attributes );
							}
							break;
						case 'primary-entry-meta':
							$output .= $this->get_featured_post_primary_meta( $post, $attributes );
							break;
						case 'secondary-entry-meta':
							$output .= $this->get_featured_post_secondary_meta( $post, $attributes );
							break;
						case 'price':
							$output .= $this->p6_featured_edd_price( $post, $attributes );
							break;
						case 'rating':
							if ( isset( $attributes['fpWooOnRating'] ) && $attributes['fpWooOnRating'] ) {
								if ( gutentor_custom_edd_review( $post->ID ) ) {
									$output .= '<div class="gutentor-fp-edd-rating">';
									$output .= gutentor_custom_edd_review( $post->ID );
									$output .= '</div>';
								}
							}
							break;
						case 'avatar':
							$output .= $this->get_fp_avatar_data( $post, $attributes );
							break;
						case 'description':
							if ( $post_format_pos === 'gutentor-fp-pf-pos-before-ct-box' ) {
								$output .= '<div class="gutentor-post-desc-data-wrap">';
								if ( $enable_post_format && $post_format_pos === 'gutentor-fp-pf-pos-before-ct-box' ) {
									$output .= $this->p6_fp_edd_new_badge_product( $post, $download );
								}
								$output .= $this->get_featured_post_description( $post, $attributes );
								$output .= '</div>';
							} else {

								$output .= $this->get_featured_post_description( $post, $attributes );
							}
							break;
						case 'wishlist':
							$output .= $this->get_fp_edd_wish_list( $post, $attributes );
							break;
						case 'button':
							if ( $post_format_pos === 'gutentor-fp-pf-pos-before-button' ) {
								$output .= '<div class="gutentor-post-button-data-wrap">';
								if ( $enable_post_format && $post_format_pos === 'gutentor-fp-pf-pos-before-button' ) {
									$output .= $this->p6_fp_edd_new_badge_product( $post, $download );
								}
								$output .= $this->p6_get_fp_edd_button( $post, $attributes );
								$output .= '</div>';
							} else {
								$output .= $this->p6_get_fp_edd_button( $post, $attributes );

							}
							break;
						default:
							$output .= '';
							break;
					}
					endforeach;
			endif;
			$output .= '</div>';/*.gutentor-post-content*/
			$output .= '</div>';/*.gutentor-post-featured-item*/
			$output .= '</article>';/*.article*/
			return $output;

		}

		/**
		 * Content On Image Template 1
		 *
		 * @param {string} $data
		 * @param {array}  $post
		 * @param {array}  $attributes
		 * @return {mix}
		 */
		public function template_data( $output, $the_query, $attributes ) {
			$template    = $attributes['p6Temp'] ? $attributes['p6Temp'] : '';
			$post_number = $attributes['postsToShow'] ? $attributes['postsToShow'] : '';
			$post_type   = ( isset( $attributes['pPostType'] ) ) ? $attributes['pPostType'] : 'post';

			if ( $template !== 'gutentor_p6_template2' ) {
				return $output;
			}
			$index = 0;
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				if ( $index === 0 ) {
					$output .= "<div class='" . apply_filters( 'gutentor_post_module_p6_grid_column_class', 'grid-lg-6 grid-md-6 grid-12', $attributes ) . "'>";
					if ( $post_type === 'product' ) {
						$output .= $this->p6_template2_fp_woo_single_article( get_post(), $attributes, $index );
					} elseif ( $post_type === 'download' ) {
						$output .= $this->p6_template2_fp_edd_single_article( get_post(), $attributes, $index );
					} else {
						$output .= $this->p6_template2_featured_single_article( get_post(), $attributes, $index );
					}
					$output .= '</div>';
				}
				if ( $index === 1 ) {
					$output .= "<div class='" . apply_filters( 'gutentor_post_module_grid_column_class', 'grid-lg-6 grid-md-6 grid-12', $attributes ) . "'>";
				}
				if ( $index > 0 && $index < $post_number ) {
					if ( $post_type === 'product' ) {
						$output .= $this->p6_woo_single_article( get_post(), $attributes, $index );
					} elseif ( $post_type === 'download' ) {
						$output .= $this->p6_edd_single_article( get_post(), $attributes, $index );
					} else {
						$output .= $this->p6_single_article( get_post(), $attributes, $index );
					}
				}
				if ( $index + 1 === $post_number ) {
					$output .= '</div>';

				}
				$index++;
			endwhile;
			return $output;
		}
	}
}
Gutentor_Duplex_P6_T2::get_instance()->run();
