<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( ! function_exists('hotelgalaxy_add_home_blog') ){

	add_action('hotelgalaxy_do_homeBlog', 'hotelgalaxy_add_home_blog');

	function hotelgalaxy_add_home_blog(){

		if( hotelgalaxy_get_option('is_home_blog_section')  ){

			?>

			<div id="main-home-blog" class="home-section">
				<div class="overlay">

					<div class="container">

						<?php hotelgalaxy_home_section_header('blog');	?>

						<div class="blog-content-area home-summary clearfix">

							<?php hotelgalaxy_blog_loop();	?>

						</div>
					</div>
				</div>
			</div>

			<?php
		}
	}
}


// 

if(!function_exists('hotelgalaxy_blog_loop')){

	function hotelgalaxy_blog_loop(){				

		if(have_posts()):	

			$args = array( 
				'post_type' => 'post',
				'cat'=> absint( hotelgalaxy_get_option('home_blog_category') ),
				'posts_per_page'=>absint( hotelgalaxy_get_option('home_blog_posts_per_page'))
			);		

			$posts = new WP_Query( $args );

			while ( $posts->have_posts()): $posts->the_post();

				hotelgalaxy_blog_item($posts );

			endwhile;

			wp_reset_postdata(); 

		endif; 
	}
}

// 

if(!function_exists('hotelgalaxy_blog_item')){

	function hotelgalaxy_blog_item( $posts ){

		?>

		<div <?php hotelgalaxy_add_class('home_blog_column') ?> >

			<div class="hg-thumbnail wow fadeInUp">

				<?php do_action( 'hotelgalaxy_posts_featured_image' ); ?>

				<div class="hg-caption">

					<?php 

					the_title( sprintf( '<h4 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );					
					?>

					<div class="entry-meta">						
						<?php 

						echo apply_filters( 'the_content', esc_html( wp_trim_words( get_the_content(), 20, '...' ) ) ); 
						?>

						<footer>

							<?php 

							echo sprintf('%1$s&nbsp;<a href="%2$s" class="">%3$s</a>',						 
								get_avatar( get_the_author_meta( 'ID' ), 16 ),
								esc_url(get_the_permalink()),
								esc_html(get_the_author())								

							);

							echo sprintf('<i class="fa fa-clock-o"></i><a href="%1$s" class="">%2$s</a>',
								esc_url(get_permalink()),							
								esc_html(get_the_date())
							);							

							?>				

						</footer>
					</div>
				</div>

			</div>
		</div>

		<?php

	}
}
?>
