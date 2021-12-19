<?php 

register_post_type( 'hg_slider',
	array(
		'labels' => array(
			'name' => __('Slider','hotel-galaxy'),
			'add_new' => __('Add New Image', 'hotel-galaxy'),
			'add_new_item' => __('Add New Image','hotel-galaxy'),
			'edit_item' => __('Add New Image','hotel-galaxy'),
			'new_item' => __('New Link','hotel-galaxy'),
			'all_items' => __('All Images','hotel-galaxy'),
			'view_item' => __('View Link','hotel-galaxy'),
			'search_items' => __('Search Links','hotel-galaxy'),
			'not_found' =>  __('No Links found','hotel-galaxy'),
			'not_found_in_trash' => __('No Links found in Trash','hotel-galaxy'), 
			'featured_image'        => __( 'Slider image', 'hotel-galaxy' ),
			'set_featured_image'    => __( 'Set slider image', 'hotel-galaxy' ), 
			'remove_featured_image'    => __( 'Remove slider image', 'hotel-galaxy' ), 
			'use_featured_image'    => __( 'Use slider image', 'hotel-galaxy' ), 
		),
		'supports' => array('title','thumbnail','author'),
		'show_in' => true,
		'show_in_nav_menus' => false,
		'rewrite' => array('slug' => 'slider'),
		'public' => true,
		'menu_position' =>20,
		'public' => true,
		'menu_icon' =>'dashicons-images-alt2',
	)
);


if(!function_exists('hotelgalaxy_slider_meta_title')){

	add_action( 'admin_head', 'hotelgalaxy_slider_meta_title' );

	function hotelgalaxy_slider_meta_title() {
		
		remove_meta_box( 'postimagediv', 'hg_slider', 'side' );
		add_meta_box('postimagediv', __('Slider image'), 'post_thumbnail_meta_box', 'hg_slider', 'side', 'high');
	}

}

if(! function_exists('hotelgalaxy_meta_slider')){

	add_action('admin_init','hotelgalaxy_meta_slider');

	function hotelgalaxy_meta_slider(){

		add_meta_box('hg_slider', __('Settings','hotel-galaxy'), 'hotelgalaxy_slider_settings_metabox', 'hg_slider', 'normal', 'high');
	}
}

if(!function_exists('hotelgalaxy_slider_defaults')){

	function hotelgalaxy_slider_defaults( $filter= true ){

		$defaults = array(
			'title' => '',
			'description' => '',
			'url' => '',
			'rating' => 5,
			'is_rating' => true,
			'is_button' => true,

		);

		if($filter){
			return apply_filters('hotelgalaxy_slider_defaults', $defaults);
		}
		return $defaults;
	}
}

if( !function_exists('hotelgalaxy_slider_settings_metabox') ){

	function hotelgalaxy_slider_settings_metabox($post){		 

		$meta_settings = hotelgalaxy_get_metabox_settings( $post->ID, 'hg_slider_settings_' );

		$data = wp_parse_args($meta_settings, hotelgalaxy_slider_defaults());

		?>
		<div class="hg-metabox">

			<form method="POST">

				<?php wp_nonce_field( 'hoelgalaxy_slider_nonce', 'hoelgalaxy_slider_nonce' ); ?>

				<input type="hidden" name="id" value="<?=$post->ID?>" />

				<div class="control">
					<label>
						<?php esc_html_e('Title &#8282;','hotel-galaxy') ?> 
					</label>
					<input type="text" name="title" value="<?= hotelgalaxy_metabox_input	($data['title']) ?>"/>
				</div>

				<div class="control">
					<label>
						<?php esc_html_e('Description &#8282;','hotel-galaxy') ?>	
					</label> 

					<textarea name="description" rows="3" cols="10"><?= hotelgalaxy_metabox_input	($data['description']) ?></textarea> 
				</div>

				<div class="control">
					<label>
						<?php esc_html_e('Button URL &#8282;','hotel-galaxy') ?> 
					</label>
					<input type="text" name="url" value="<?=hotelgalaxy_metabox_input	($data['url']) ?>" />
				</div>

				<div class="control">
					<label>
						<?php esc_html_e('Rating &#8282;','hotel-galaxy') ?> 
					</label>

					<input type="number" min="0" max="5" name="rating" value="<?= hotelgalaxy_metabox_input	($data['rating']) ?>" />

				</div>

				<div class="control">
					<label>
						<input type="checkbox" name="is_rating" value="1" <?= hotelgalaxy_metabox_input	($data['is_rating'], 'checked' ) ?> />
						<span ><?php esc_html_e('Enable Rating','hotel-galaxy') ?></span> 
					</label>
				</div>

				<div class="control">
					<label>
						<input type="checkbox" name="is_button" value="1" <?= hotelgalaxy_metabox_input	($data['is_button'], 'checked' ) ?> />
						<span ><?php esc_html_e('Enable Button','hotel-galaxy') ?></span> 
					</label>
				</div>			

			</form>
		</div>




		<?php
	}

}


if(!function_exists('hotelgalaxy_slider_metabox_save')){

	add_action('save_post','hotelgalaxy_slider_metabox_save');  

	function hotelgalaxy_slider_metabox_save( $id ){

		global $post;

		if( !isset( $_POST['hoelgalaxy_slider_nonce'] ) || !wp_verify_nonce( $_POST['hoelgalaxy_slider_nonce'], 'hoelgalaxy_slider_nonce' ) ) {
			return;
		}

		if ($post->post_type != 'hg_slider'){
			return;
		}

		$data =array();

		$inputNames = array('id','title','description','url','rating','is_rating','is_button');

		foreach ( $inputNames as $name ){

			$data[$name] =sanitize_text_field(stripcslashes( $_POST[$name] ) );
		}

		$key = 'hg_slider_settings_'.$id;

		update_post_meta( $id, $key, $data );

	}
}



?>