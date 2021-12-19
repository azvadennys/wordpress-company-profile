<?php
if ( ! defined( 'ABSPATH' ) ) {	exit; } 

register_post_type( 'hg_room',
	array(
		'labels' => array(
			'name' => __('Rooms','webdzier-companion'),
			'add_new' => __('Add New Room', 'webdzier-companion'),
			'add_new_item' => __('Add New Room','webdzier-companion'),
			'edit_item' => __('Add New Room','webdzier-companion'),
			'new_item' => __('New Link','webdzier-companion'),
			'all_items' => __('All Rooms','webdzier-companion'),
			'view_item' => __('View Link','webdzier-companion'),
			'search_items' => __('Search Links','webdzier-companion'),
			'not_found' =>  __('No Links found','webdzier-companion'),
			'not_found_in_trash' => __('No Links found in Trash','webdzier-companion'),
			'featured_image'        => __( 'Room Cover Image', 'webdzier-companion' ),
			'set_featured_image'    => __( 'Set room cover image', 'webdzier-companion' ), 
			'remove_featured_image'    => __( 'Remove cover image', 'webdzier-companion' ), 
			'use_featured_image'    => __( 'Use as cover image', 'webdzier-companion' ), 
		),
		'show_in_rest' => true,
		'supports' => array('title','thumbnail','editor','author','comments'),
		'show_in' => true,
		'show_in_nav_menus' => false,
		'rewrite' => array('slug' => 'room' ),
		'public' => true,
		'menu_position' =>20,
		'public' => true,
		'menu_icon' => 'dashicons-admin-multisite',
	)
);



if(! function_exists('hotelgalaxy_meta_room')){

	add_action('admin_init','hotelgalaxy_meta_room');

	function hotelgalaxy_meta_room(){

		add_meta_box('hg_room', __('Settings','webdzier-companion'), 'hotelgalaxy_room_settings_metabox', 'hg_room', 'normal', 'high');
	}
}

if(!function_exists('hotelgalaxy_cpt_room_defaults')){

	function hotelgalaxy_cpt_room_defaults( $filter= true ){

		$defaults = array(
			'title' => '',
			'rent' => '',			
			'rating' => 5,
			'size' => '',
			'adults' => '',
			'children' => '',
			'day' => '',			
			'is_rating' => true,		

		);

		if($filter){
			return apply_filters('hotelgalaxy_cpt_room_defaults', $defaults);
		}
		return $defaults;
	}
}

if(!function_exists('hotelgalaxy_room_settings_metabox')){

	function hotelgalaxy_room_settings_metabox( $post ){

		$meta_settings = hotelgalaxy_get_metabox_settings( $post->ID, 'hg_room_settings_' );

		$data = wp_parse_args($meta_settings, hotelgalaxy_cpt_room_defaults());
		
		?>

		<div class="hg-metabox">

			<form method="POST">

				<?php wp_nonce_field( 'hotelgalaxy_room_nonce', 'hotelgalaxy_room_nonce' ); ?>

				<input type="hidden" name="id" value="<?=$post->ID?>" />
				<input type="hidden" name="save_post" value="hg_room_settings_" />

				<div class="control">
					<label>
						<?php esc_html_e('Title &#8282;','webdzier-companion') ?> 
					</label>
					<input type="text" name="title" value="<?= hotelgalaxy_metabox_input($data['title']) ?>"/>
				</div>

				<div class="control">
					<label>
						<?php esc_html_e('Adults &#8282;','webdzier-companion') ?> 
					</label>
					<input type="number" name="adults" value="<?= hotelgalaxy_metabox_input($data['adults']) ?>"/>
				</div>

				<div class="control">
					<label>
						<?php esc_html_e('Children &#8282;','webdzier-companion') ?> 
					</label>
					<input type="number" name="children" value="<?= hotelgalaxy_metabox_input($data['children']) ?>"/>
				</div>

				<div class="control">
					<label>
						<?php esc_html_e('Size &#8282; (In meter square)','webdzier-companion') ?> 
					</label>
					<input type="number" name="size" value="<?= hotelgalaxy_metabox_input($data['size']) ?>"/>
				</div>

				<div class="control">
					<label>
						<?php esc_html_e('Day &#8282;','webdzier-companion') ?> 
					</label>
					<input type="number" name="day" value="<?= hotelgalaxy_metabox_input($data['day']) ?>"/>					
				</div>				

				<div class="control">
					<label>
						<?php esc_html_e('Rent &#8282;','webdzier-companion') ?> 
					</label>
					<input type="text" name="rent" value="<?=hotelgalaxy_metabox_input($data['rent']) ?>" />
				</div>

				
				<div class="control">
					<label>
						<?php esc_html_e('Rating &#8282;','webdzier-companion') ?> 
					</label>

					<input type="number" min="0" max="5" name="rating" value="<?= hotelgalaxy_metabox_input($data['rating']) ?>" />

				</div>			

				<div class="control">
					<label>
						<input type="checkbox" name="is_rating" value="1" <?= hotelgalaxy_metabox_input($data['is_rating'], 'checked' ) ?> />
						<span ><?php esc_html_e('Enable Rating','webdzier-companion') ?></span> 
					</label>
				</div>	

			</form>
		</div>

		<?php

	}
}


if(!function_exists('hotelgalaxy_room_metabox_save')){

	add_action('save_post','hotelgalaxy_room_metabox_save');  

	function hotelgalaxy_room_metabox_save( $id ){

		global $post;

		if( !isset( $_POST['hotelgalaxy_room_nonce'] ) || !wp_verify_nonce( $_POST['hotelgalaxy_room_nonce'], 'hotelgalaxy_room_nonce' ) ) {
			return;
		}

		if ($post->post_type != 'hg_room'){
			return;
		}

		$data =array();

		$inputNames = array('post_type','save_post','id','title','rent','rating','is_rating','image','size','adults','children','day');

		foreach ( $inputNames as $name ){

			if( $name=='image' ) {
				
				$data[$name] =array_map( 'esc_url', $_POST[ $name ] );

			}else{

				$value = ('post_type' == $name ) ? $post->post_type : $_POST[ $name ];
				$data[$name] =sanitize_text_field(stripcslashes( $value ) );
			}			
		}

		$key = 'hg_room_settings_'.$id;

		update_post_meta( $id, $key, $data );

	}
}


?>