<?php

hotelgalaxy_default_room_page( 'hg_room','Child Room', 4);
hotelgalaxy_default_room_page( 'hg_room','Honeymoon Room', 5);
hotelgalaxy_default_room_page( 'hg_room','Simple Room', 6);

function hotelgalaxy_default_room_page(  $post_type, $title, $image ){

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
				'rent' => '$100',			
				'rating'=> 5,
				'size'=> 500,
				'adults' => 2,
				'children' => 2,
				'day' => 1,
				'is_rating' => true,
				'image' => '',
			);	

			$key = 'hg_room_settings_'.$page_id;

			update_post_meta( $page_id, $key, $data );
		}

	}

}



?>