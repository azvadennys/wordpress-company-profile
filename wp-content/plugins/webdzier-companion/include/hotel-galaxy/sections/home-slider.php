<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !function_exists('hotelgalaxy_add_home_slider') ){
	
	add_action('hotelgalaxy_do_homeSlider','hotelgalaxy_add_home_slider');

	function hotelgalaxy_add_home_slider(){

		if( defined( 'HG_SLIDER_ADDON_VERSION' ) ){

			do_action('hotelgalaxy_get_premium_slider');

		}else{

			$slider_layout = hotelgalaxy_get_option('slider_layout');

			if('two' == $slider_layout ){

				do_action('hotelgalaxy_child_home_slider_two');

			}else{

				do_action('hotelgalaxy_home_slider');
			}			
		}
		
	}	
}

add_action('hotelgalaxy_home_slider', 'hotelgalaxy_construct_slider_one');

if( ! function_exists('hotelgalaxy_construct_slider_one')){

	function hotelgalaxy_construct_slider_one(){	

		?>

		<div id="hg-main-slider" <?php hotelgalaxy_add_class( 'slider_layout' ) ?>>		

			<?php 

			$arg = array('post_type'=>'hg_slider');

			$slider = new WP_Query($arg);

			if( $slider->have_posts() ){

				$index = 0;

				while( $slider->have_posts() ) : $slider->the_post();

					$data = hotelgalaxy_get_metabox_settings( get_the_ID(), 'hg_slider_settings_' );				

					hotelgalaxy_get_home_slider( $data );

					$index++;

				endwhile;
			}else{

				$demo_slider_one = array(
					'id' => '',
					'title' => esc_html__('Hotel Galaxy', 'hotel-galaxy'),
					'description' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','hotel-galaxy'),
					'url' => esc_html__('#','hotel-galaxy'),
					'rating' => 5,
					'is_rating' => true,
					'is_button' => true,
					'img' => webdzierc_plugin_url.'include/hotel-galaxy/images/slider/slide-01.jpg',
				);	

				$demo_slider_two = array(
					'id' => '',
					'title' => esc_html__('Our Best Room', 'hotel-galaxy'),
					'description' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','hotel-galaxy'),
					'url' => esc_html__('#','hotel-galaxy'),
					'rating' => 5,
					'is_rating' => true,
					'is_button' => true,
					'img' => webdzierc_plugin_url.'include/hotel-galaxy/images/slider/slide-02.jpg',
				);	

				hotelgalaxy_home_slider_demo( $demo_slider_one );

				hotelgalaxy_home_slider_demo( $demo_slider_two );
			}
			?>
		</div>
		<?php		

	}
}


if(!function_exists('hotelgalaxy_get_home_slider')){

	function hotelgalaxy_get_home_slider( $data ){		

		if(empty($data)){ 
			return false;
		}	

		$before = '<div class="item">';
		$after = '</div>';

		if ( ! has_post_thumbnail() ) {
			return;
		}		

		echo $before;
		the_post_thumbnail('full', array(
			'itemprop' => 'image',
			'class'=>'img-responsive',
		));

		echo '<div class="container"> <div class="carousel-caption">';

		do_action('hotelgalaxy_add_rating', array( 'rating' => $data['rating'], 'is_rating'=> $data['is_rating'])); 

		echo '<h2>'.esc_html__( $data['title']).'</h2>';

		echo hotelgalaxy_trim_words( $data['id'], $data['description'], $data['url'], $data['is_button'] ); 

		echo '</div> </div>';
		echo $after;

	}
}

if(!function_exists('hotelgalaxy_home_slider_demo')){

	function hotelgalaxy_home_slider_demo( $data ){		

		if(empty($data)){ 
			return false;
		}	

		$MediaId = get_option('hg_media_id');

		$before = '<div class="item">';
		$after = '</div>';			

		echo $before;	 

		?>

		<img class="img-responsive" src="<?php echo esc_url($data['img']); ?>">
		<?php	

		echo '<div class="container"> <div class="carousel-caption">';

		do_action('hotelgalaxy_add_rating', array( 'rating' => $data['rating'], 'is_rating'=> $data['is_rating'])); 

		echo '<h2>'.esc_html__( $data['title']).'</h2>';

		echo hotelgalaxy_trim_words( $data['id'], $data['description'], $data['url'], $data['is_button'] ); 

		echo '</div> </div>';
		echo $after;

	}
}


if(!function_exists('hotelgalaxy_trim_words')){	

	function hotelgalaxy_trim_words( $id, $content, $URL=null, $is_readmore = true ){			

		$slider_btn = hotelgalaxy_get_option('slider_button_text');		
		$excerpt_word = hotelgalaxy_get_option('slider_excerpt_word');		
		$target = hotelgalaxy_get_option('slider_button_target') ? '_blank' : '_self';		

		$args= '';

		if( !empty( $slider_btn ) && absint( $is_readmore ) == true){

			$args = apply_filters('hotelgalaxy_slider_more_button', sprintf(

				'<footer style="margin-bottom:20px;"><a id="read-more" href="%1$s" target="%2$s"><i class="icon"></i>%3$s</a></footer>',

				esc_url( (empty($URL)) ? get_permalink( $id ) : $URL ),

				esc_attr( $target ),

				esc_html( $slider_btn )

			) );

		}

		$html_trim = wp_trim_words( strip_shortcodes( wp_strip_all_tags( $content ) ), $excerpt_word );

		$html_out = sprintf('<p>%1$s</p>%2$s',$html_trim, $args);

		return $html_out;
	}
}

?>