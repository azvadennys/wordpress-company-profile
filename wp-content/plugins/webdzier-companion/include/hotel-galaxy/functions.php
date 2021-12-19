<?php
add_action('admin_enqueue_scripts', 'hotelgalaxy_admin_enqueue' );

function hotelgalaxy_admin_enqueue(){

	global $typenow;		

	$cpt = array( 'hg_slider','hg_room' );

	if ( in_array( $typenow, $cpt ) ){	
		
		wp_enqueue_style('hotelgalaxy-metabox', plugin_dir_url( __FILE__ ).'assets/css/admin-style.css',array(), WEBDZIER_HOTEL_COMPANION, false);
	}
	
}

add_action('wp_enqueue_scripts', 'hotelgalaxy_style_enqueue' );

function hotelgalaxy_style_enqueue(){

	wp_register_script('hotelgalaxy-swiper', plugin_dir_url( __FILE__ ) . 'assets/js/swiper.min.js',array('jquery'),WEBDZIER_HOTEL_COMPANION );

	wp_register_style('hotelgalaxy-swiper', plugin_dir_url( __FILE__ ).'assets/css/swiper.min.css',array(), WEBDZIER_HOTEL_COMPANION);

	wp_enqueue_style('hotelgalaxy-room', plugin_dir_url( __FILE__ ).'assets/css/room.css',array(), WEBDZIER_HOTEL_COMPANION, false);
}


if(!function_exists('hotelgalaxy_get_metabox_settings')){

	function hotelgalaxy_get_metabox_settings( $id=null, $key=null ){

		if( $id==null && $key==null ){
			return;
		}

		$generate_key = $key.$id;

		$metaboxSettings = get_post_meta( $id, $generate_key, true );

		if(!empty($metaboxSettings)){

			return hotelgalaxy_json_decode($metaboxSettings);
		}

		return false;
	}
}

if(!function_exists('hotelgalaxy_json_decode')){

	function hotelgalaxy_json_decode($str){

		if(is_serialized($str)){

			$str = unserialize($str);
		}

		return $str;
	}

}

if(! function_exists('hotelgalaxy_metabox_input')){
	
	function hotelgalaxy_metabox_input( $value, $input=null ){

		if( $input == 'checked' ||  $input == 'selected'){
			
			return ( !empty( $value ) && absint( $value ) == true )? $input : '';

		}else{

			return ( !empty( $value ) )? $value : '';
		}
		
	}	
}


if(!function_exists('hotelgalaxy_product_rent')){

	add_action('hotelgalaxy_room_rent', 'hotelgalaxy_product_rent');

	function hotelgalaxy_product_rent( $data){

		if(!empty($data['rent'])){

			echo sprintf('<p><strong class="room-rent">%1$s&nbsp;</strong><span class="hg-period">&nbsp;%2$s&nbsp;%3$s</span></p>',
				esc_attr($data['rent']),
				esc_attr($data['day']),
				esc_attr( ($data['day'] > 1) ? 'days' : 'day' )
			);
			
		}
	}
}

function hotelgalaxy_room_attributes($adults, $children, $size){
	?>

	<ul class="hg-room-type-attributes">

		<?php 

		if($adults > 0){

			echo sprintf('<li class="hg-room-type-adults-capacity" title="Adult"><span class="hg-attribute-value">%1$s</span></li>',
				esc_attr($adults)
			);

		}

		if($children > 0){

			echo sprintf('<li class="hg-room-type-children-capacity" title="Children"><span class="hg-attribute-value">%1$s</span></li>',
				esc_attr($children)
			);

		}

		if($size > 0){

			echo sprintf('<li class="hg-room-type-size" title="Size"><span class="hg-attribute-value">%1$sm²</span></li>',
				esc_attr($size)
			);

		}

		?>	
		
	</ul>
	<?php
}


if(!function_exists('hotelgalaxy_product_button')){

	add_action('hotelgalaxy_get_room_button','hotelgalaxy_product_button');

	function hotelgalaxy_product_button( $data ){		

		if( !empty( $data['button_text'] ) && $data['is_button']){

			echo apply_filters('hg_premium_read_more_button', sprintf(

				'<footer><a id="read-more" href="%1$s" target="%2$s"><i class="icon"></i>%3$s</a></footer>',

				esc_url(  get_permalink()  ),

				__( !empty($data['target']) ? '_blank' : '_self' ),

				__( $data['button_text'], 'hg-premium' )

			) );
		}
	}

}

?>