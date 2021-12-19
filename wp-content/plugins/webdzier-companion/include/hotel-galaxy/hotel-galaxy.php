<?php 

define( 'WEBDZIER_HOTEL_COMPANION', '1.5' );

add_filter('hotelgalaxy_default_settings', 'hotelgalaxy_base_setting');

function hotelgalaxy_base_setting( $default ){

	$default['information_title_1'] = esc_html__('fa-home', 'hotel-galaxy');
	$default['information_text_1'] = esc_html__('California, United States', 'hotel-galaxy');
	$default['information_title_2'] = esc_html__('fa-phone', 'hotel-galaxy');
	$default['information_text_2'] = esc_html__('+00-1234567890', 'hotel-galaxy');

	$default['socialmedia_icon_1'] = esc_html__('fa-facebook', 'hotel-galaxy');
	$default['socialmedia_url_1'] = esc_html__('#', 'hotel-galaxy');
	$default['socialmedia_icon_2'] = esc_html__('fa-twitter', 'hotel-galaxy');
	$default['socialmedia_url_2'] = esc_html__('#', 'hotel-galaxy');
	$default['socialmedia_icon_3'] = esc_html__('fa-skype', 'hotel-galaxy');
	$default['socialmedia_url_3'] = esc_html__('#', 'hotel-galaxy');
	$default['socialmedia_icon_4'] = esc_html__('fa-instagram', 'hotel-galaxy');
	$default['socialmedia_url_4'] = esc_html__('#', 'hotel-galaxy');
	$default['socialmedia_icon_5'] = esc_html__('fa-youtube', 'hotel-galaxy');
	$default['socialmedia_url_5'] = esc_html__('#', 'hotel-galaxy');

	$default['slider_button_text'] = esc_html__('View Details', 'hotel-galaxy');
	$default['room_button_text'] = esc_html__('Book Now', 'hotel-galaxy');	

	$default['home_service_section_header'] = 'Our Best <span>Services</span> ';
	$default['home_service_section_sub_header'] = esc_html__('Excepteur sint occaecat cupidatat', 'hotel-galaxy');

	$default['home_room_section_header'] = 'Our Favorite <span>Room</span>';
	$default['home_room_section_sub_header'] = esc_html__('Excepteur sint occaecat cupidatat', 'hotel-galaxy');

	$default['home_blog_section_header'] = '<span>Latest</span> Hotel News';
	$default['home_blog_section_sub_header'] = esc_html__('Excepteur sint occaecat cupidatat', 'hotel-galaxy');

	$default['home_shortcode_section_header'] = '<span>Contact</span> US';
	$default['home_shortcode_section_sub_header'] = esc_html__('Excepteur sint occaecat cupidatat', 'hotel-galaxy');

	$default['office_address_title'] =  esc_html__('Address', 'hotel-galaxy');
	$default['office_address'] = esc_html__('California, United States', 'hotel-galaxy');

	$default['office_phone_title'] = esc_html__('Phone', 'hotel-galaxy');
	$default['office_phone'] = esc_html__('+00-1234567890', 'hotel-galaxy');

	$default['office_email_title'] = esc_html__('Email', 'hotel-galaxy');
	$default['office_email'] = esc_html__('info@example.com', 'hotel-galaxy');

	$default['office_open_hours_title'] = esc_html__('Office Time', 'hotel-galaxy');
	$default['office_open_hours'] = esc_html__('Mon to Sat: 10:00-18:00', 'hotel-galaxy');

	$default['footer_collout_title_1'] = esc_html__('Free Parking', 'hotel-galaxy');
	$default['footer_collout_icon_1'] = esc_html__('fa-car', 'hotel-galaxy');

	$default['footer_collout_title_2'] = esc_html__('Free Wifi', 'hotel-galaxy');
	$default['footer_collout_icon_2'] = esc_html__('fa-wifi', 'hotel-galaxy');

	$default['footer_collout_title_3'] = esc_html__('Free Delivery', 'hotel-galaxy');
	$default['footer_collout_icon_3'] = esc_html__('fa-bicycle', 'hotel-galaxy');

	$default['footer_collout_title_4'] = esc_html__('Deluxe Bad Room', 'hotel-galaxy');
	$default['footer_collout_icon_4'] = esc_html__('fa-bed', 'hotel-galaxy');

	return $default;
}

require_once webdzierc_plugin_dir . 'include/hotel-galaxy/functions.php';
require_once webdzierc_plugin_dir . 'include/hotel-galaxy/sections/home-slider.php';
require_once webdzierc_plugin_dir . 'include/hotel-galaxy/sections/home-service.php';
require_once webdzierc_plugin_dir . 'include/hotel-galaxy/sections/home-room.php';
require_once webdzierc_plugin_dir . 'include/hotel-galaxy/sections/home-blogs.php';
require_once webdzierc_plugin_dir . 'include/hotel-galaxy/sections/home-contact.php';


require_once webdzierc_plugin_dir . 'include/hotel-galaxy/customizer/customizer.php';


if( !defined('HG_PREMIUM_VERSION') ){

	require_once webdzierc_plugin_dir . 'include/hotel-galaxy/features/slider.php';
	require_once webdzierc_plugin_dir . 'include/hotel-galaxy/features/room.php';

}


?>