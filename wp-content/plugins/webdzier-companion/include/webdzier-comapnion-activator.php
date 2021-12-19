<?php

class Webdzier_Companion_Activator {

	public static function activate() {

        $item_details_page = get_option('item_details_page'); 
		$theme = wp_get_theme(); 

		$all_themes = array( 'Hotel Galaxy', 'Hotel Sydney', 'Hotel Booking', 'Hostel', 'Hotel & Restaurant', 'Hotel New York');

		if(!$item_details_page){
			
			if ( in_array( $theme->name, $all_themes ) ){

				require webdzierc_plugin_dir . 'include/hotel-galaxy/default-pages/upload-media.php';
				require webdzierc_plugin_dir . 'include/hotel-galaxy/default-pages/home-page.php';				
				require webdzierc_plugin_dir . 'include/hotel-galaxy/default-widgets/default-widget.php';
			}
			
			update_option( 'hg_details_page', 'Done' );
		}
	}

}


?>