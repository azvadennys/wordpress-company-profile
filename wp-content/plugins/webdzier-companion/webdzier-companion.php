<?php
/*
Plugin Name: Webdzier Companion
Description: Enhances webdzier themes with additional functionality.
Version: 1.8
Author: webdzier
Author URI: https://webdzier.com
Text Domain: webdzier-companion
*/

define( 'webdzierc_plugin_url', plugin_dir_url( __FILE__ ) );
define( 'webdzierc_plugin_dir', plugin_dir_path( __FILE__ ) );

if( !function_exists('webdzierc_init') ){
	function webdzierc_init(){
		$current_theme_data = wp_get_theme(); // getting current theme data
		$current_theme = $current_theme_data->name;
		$current_theme = strtolower( $current_theme );
		$current_theme = str_replace( ' ','-', $current_theme );		
		
		if(file_exists( webdzierc_plugin_dir . "include/$current_theme/init.php")){
			require("include/$current_theme/init.php");
		}	

		if($current_theme=='construct-line'){
			require("include/business-idea/init.php");
		}
		
		if($current_theme=='hotel-galaxy'){
			require_once("include/hotel-galaxy/hotel-galaxy.php");
			
		}
		
		if($current_theme=='hotel-sydney'){

			require_once("include/hotel-galaxy/hotel-galaxy.php");
			
		}

		if($current_theme=='hotel-booking'){
			require_once("include/hotel-galaxy/hotel-galaxy.php");
			
		}

		if($current_theme=='hostel'){
			require_once("include/hotel-galaxy/hotel-galaxy.php");
			
		}

		if($current_theme=='hotel-restaurant'){
			require_once("include/hotel-galaxy/hotel-galaxy.php");			
		}

		if( $current_theme=='hotel-new-york' ){

			require_once("include/hotel-galaxy/hotel-galaxy.php");			
		}
	}
}
add_action( 'init', 'webdzierc_init' );

// 
function webdzier_companion_activated() {

	require_once plugin_dir_path( __FILE__ ) . 'include/webdzier-comapnion-activator.php';

	Webdzier_Companion_Activator::activate();	
}

register_activation_hook( __FILE__, 'webdzier_companion_activated' );

?>