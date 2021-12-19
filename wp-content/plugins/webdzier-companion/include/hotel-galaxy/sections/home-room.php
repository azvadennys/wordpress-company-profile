<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if( ! function_exists('hotelgalaxy_add_home_room') ){

	add_action('hotelgalaxy_do_homeRoom', 'hotelgalaxy_add_home_room');

	function hotelgalaxy_add_home_room(){

		if( hotelgalaxy_get_option('is_home_room_section') ){

			?>

			<div id="main-home-room" class="home-section wow bounceInUp ">
				<div class="overlay">
					<div class="container">
						<?php hotelgalaxy_home_section_header('room');	?>

						<div class="room-content-area home-summary clearfix">

							<?php hotelgalaxy_construct_home_room() ?>
							
						</div>

					</div>
				</div>
			</div>
			
			<?php
		}

	}

}

if(!function_exists( 'hotelgalaxy_construct_home_room' )){

	function hotelgalaxy_construct_home_room(){

		if( defined( 'HG_ROOM_ADDON_VERSION' ) ){

			do_action('hg_premium_home_room');

		}else{
			do_action('hotelgalaxy_add_room');
			
		}
	}
}


// 

if(!function_exists('hotelgalaxy_const_add_room')){

	add_action('hotelgalaxy_add_room','hotelgalaxy_const_add_room');

	function hotelgalaxy_const_add_room(){		

		$arg = array('post_type'=>'hg_room' );

		$room = new WP_Query($arg);

		if( $room->have_posts() ){				

			while( $room->have_posts() ) : $room->the_post();

				$data = hotelgalaxy_get_metabox_settings( get_the_ID(), 'hg_room_settings_' );				

				hotelgalaxy_room_item( $data );

			endwhile;	
		}else{

			$demo_room_one = array(
				'id'=> '',
				'title' => esc_html__('Deluxe Contrast Room', 'hotel-galaxy'),
				'rent' => esc_html__('$100', 'hotel-galaxy'),			
				'rating' => 5,
				'size' => esc_html__('75', 'hotel-galaxy'),
				'adults' => esc_html__('2', 'hotel-galaxy'),
				'children' =>esc_html__('1', 'hotel-galaxy'),
				'day' => esc_html__('2', 'hotel-galaxy'),			
				'is_rating' => true,	
				'img' => 4,	
			);

			$demo_room_two = array(
				'id'=> '',
				'title' => esc_html__('Deluxe Contrast Room', 'hotel-galaxy'),
				'rent' => esc_html__('$130', 'hotel-galaxy'),			
				'rating' => 5,
				'size' => esc_html__('75', 'hotel-galaxy'),
				'adults' => esc_html__('2', 'hotel-galaxy'),
				'children' =>esc_html__('1', 'hotel-galaxy'),
				'day' => esc_html__('2', 'hotel-galaxy'),			
				'is_rating' => true,	
				'img' => 5,	
			);

			$demo_room_three = array(
				'id'=> '',
				'title' => esc_html__('Deluxe Contrast Room', 'hotel-galaxy'),
				'rent' => esc_html__('$500', 'hotel-galaxy'),			
				'rating' => 5,
				'size' => esc_html__('75', 'hotel-galaxy'),
				'adults' => esc_html__('2', 'hotel-galaxy'),
				'children' =>esc_html__('1', 'hotel-galaxy'),
				'day' => esc_html__('2', 'hotel-galaxy'),			
				'is_rating' => true,	
				'img' => 6,	
			);

			hotelgalaxy_demo_room_item( $demo_room_one );
			hotelgalaxy_demo_room_item( $demo_room_two );
			hotelgalaxy_demo_room_item( $demo_room_three );
		}

	}
}



// 

if(!function_exists('hotelgalaxy_room_item')){

	function hotelgalaxy_room_item( $data ){

		if(empty($data)){ 
			return false;
		}		

		$is_button = hotelgalaxy_get_option( 'room_is_button'); 
		$is_target = hotelgalaxy_get_option( 'room_is_target'); 
		$button_text = hotelgalaxy_get_option( 'room_button_text'); 
		$first_before = '<div class="hg-room-grid-top">';
		$second_before = '<div class="hg-room-grid-bottom ">';
		$after = '</div>';

		?>
		<div <?php hotelgalaxy_add_class('home_room_column') ?>>

			<div class="hg-room-content">				

				<?php do_action( 'hotelgalaxy_posts_featured_image' ); ?>				

				<div class="hg-caption clearfix">

					<?php 				

					echo $first_before;	

					echo '<div class="entry-meta">';
					do_action('hotelgalaxy_room_rent', array( 'rent'=> $data['rent'],'day'=> $data['day']));
					echo "</div>";	

					the_title( sprintf( '<h4 class="entry-title" itemprop="headline"><a href="%1$s" target="%2$s" rel="bookmark">', 
						esc_url( get_permalink() ), 
						(!empty( $data['target'] ) ? '_blank' : '_self' ) ), 
					'</a></h4>' );

					hotelgalaxy_room_attributes( $data['adults'], $data['children'], $data['size']);
					echo $after;

					echo $second_before;

					do_action('hotelgalaxy_get_room_button', array( 'button_text'=> $button_text, 'target' => $is_target, 'is_button' => $is_button ) );

					do_action('hotelgalaxy_add_rating', array( 'rating' => $data['rating'], 'is_rating'=> $data['is_rating']));


					echo $after;

					?>

				</div>
			</div>
		</div>

		<?php
	}

}

if(!function_exists('hotelgalaxy_demo_room_item')){

	function hotelgalaxy_demo_room_item( $data ){

		if(empty($data)){ 
			return false;
		}		

		$is_button = true; 
		$is_target = false; 
		$button_text = hotelgalaxy_get_option( 'room_button_text'); 
		$first_before = '<div class="hg-room-grid-top">';
		$second_before = '<div class="hg-room-grid-bottom ">';
		$after = '</div>';

		$MediaId = get_option('hg_media_id');

		$img_atts = wp_get_attachment_image_src($MediaId[$data['img']], 'full');

		?>
		<div <?php hotelgalaxy_add_class('home_room_column') ?>>

			<div class="hg-room-content">				

				<div class="post-image">
					<img class="img-responsive" src="<?php echo esc_url($img_atts[0]); ?>">	
				</div>					

				<div class="hg-caption clearfix">

					<?php 				

					echo $first_before;	

					echo '<div class="entry-meta">';
					do_action('hotelgalaxy_room_rent', array( 'rent'=> $data['rent'],'day'=> $data['day']));
					echo "</div>";	

					?>

					<h4 class="entry-title" itemprop="headline"><a href="#"><?php echo esc_html($data['title']) ?></a></h4>

					<?php					

					hotelgalaxy_room_attributes( $data['adults'], $data['children'], $data['size']);
					echo $after;

					echo $second_before;

					do_action('hotelgalaxy_get_room_button', array( 'button_text'=> $button_text, 'target' => $is_target, 'is_button' => $is_button ) );

					do_action('hotelgalaxy_add_rating', array( 'rating' => $data['rating'], 'is_rating'=> $data['is_rating']));


					echo $after;

					?>

				</div>
			</div>
		</div>

		<?php
	}

}



?>