<?php
$homepage_value = array(
	'post_title' => 'Home',
	'comment_status' => 'closed',
	'ping_status' =>  'closed' ,
	'post_author' => 1,
	'post_date' => date('Y-m-d H:i:s'),
	'post_name' => 'home',
	'post_status' => 'publish' ,	
	'post_type' => 'page',
);


// Catch post ID

if( get_page_by_title('Home') == '' ){
	
	$new_homepage =  wp_insert_post( $homepage_value );

}else{

	$new_homepage = false;
}

if ( $new_homepage && ! is_wp_error( $new_homepage ) ){

	update_post_meta( $new_homepage, '_wp_page_template', 'template-parts/template-homepage.php' );		

	$page = get_page_by_title('Home');

	update_option( 'show_on_front', 'page' );
	
	update_option( 'page_on_front', $page->ID );

}
