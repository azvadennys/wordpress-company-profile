<?php
$activate = array(
	'sidebar-primary' => array(
		'search-1',
		'recent-posts-1',
		'archives-1',
	),
	'footer-widget-area' => array(
		'text-1',
		'categories-1',
		'archives-1',
		'search-1',
	),

	'home-services' => array(
		'hotel_galaxy_service_widget-1',
		'hotel_galaxy_service_widget-2',
		'hotel_galaxy_service_widget-3',
	)
);

update_option('widget_text', array(
	1 => array('title' => 'About Us',
		'text'=>'Lorem ipsum dolor sit amet, consectetur dipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat
		'), 	
	2 => array('title' => 'Categories'), 
));

update_option('widget_categories', array(
	1 => array('title' => 'Categories'), 
	2 => array('title' => 'Categories')));

update_option('widget_archives', array(
	1 => array('title' => 'Archives'), 
	2 => array('title' => 'Archives')));

update_option('widget_search', array(
	1 => array('title' => 'Search'), 
	2 => array('title' => 'Search')));	

update_option('widget_hotel_galaxy_service_widget', array(
	1 => array(
		'title' => 'Free Parking',
		'icon' => 'fa-car',
		'btn_url' => '#',
		'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.',
	),

	2 => array(
		'title' => 'Free Delivery',
		'icon' => 'fa-bicycle',
		'btn_url' => '#',
		'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.',
	),

	3 => array(
		'title' => 'Free Wifi',
		'icon' => 'fa-wifi',
		'btn_url' => '#',
		'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.',
	),
	

	));	

update_option('sidebars_widgets',  $activate);
