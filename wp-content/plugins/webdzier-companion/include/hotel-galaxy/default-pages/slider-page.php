<?php 

hotelgalaxy_default_slider_page( 'hg_slider','Slider Image One', 1);
hotelgalaxy_default_slider_page( 'hg_slider','Slider Image Two', 2);
hotelgalaxy_default_slider_page( 'hg_slider','Slider Image Three', 3);

function hotelgalaxy_default_slider_page(  $post_type, $title, $image ){	

	if( post_type_exists( $post_type ) ){

		$page = array(
			'post_title' => esc_html($title),
			'comment_status' => 'closed',
			'ping_status' =>  'closed' ,
			'post_author' => 1,
			'post_date' => date('Y-m-d H:i:s'),	
			'post_status' => 'publish' ,	
			'post_type' => $post_type,
		);

		$page_id = post_exists( $title ) or wp_insert_post( $page );

		if ( $page_id && ! is_wp_error( $page_id ) ){

			$MediaId = get_option('hg_media_id');

			set_post_thumbnail( $page_id, $MediaId[$image] );		

			$data = array(
				'id' => $page_id,
				'title' => esc_html($title),
				'description' => 'This is my first slider',
				'url' => '#',
				'rating'=> true,
				'is_rating'=> true,
				'is_button' => true
			);	

			$key = 'hg_slider_settings_'.$page_id;

			update_post_meta( $page_id, $key, $data );
		}

	}

}



?>