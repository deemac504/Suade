<?php
/**
 * The default template for displaying content
 */

	global $woo_options;
 
/**
 * The Variables
 *
 * Setup default variables, overriding them if the "Theme Options" have been saved.
 */

 	$settings = array(
					'thumb_w' => 280, 
					'thumb_h' => 287, 
					'thumb_align' => 'alignleft'
					);
					
	$settings = woo_get_dynamic_values( $settings );
 
?>

	<article <?php post_class('fix'); ?>>
	
	    <!-- <?php woo_post_meta(); ?>  -->
	    
	    <?php 
		    	if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] != 'content' ) { 
		    		woo_image( 'noheight=true&width=' . $settings['thumb_w'] . '&height=' . $settings['thumb_h'] . '&class=thumbnail ' . $settings['thumb_align'] ); 
		    	} 
		    ?>
	    
	    <section class="post-body">
	    
			<header>
				<p><?php the_date() ?></p>	
				<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				<span class="post-category"><?php the_category( ', ') ?></span>
			</header>
	
			<section class="entry">
			<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' ) { the_content( __( 'Continue Reading &rarr;', 'woothemes' ) ); } else { the_excerpt(); } ?>
			</section>
	
			<footer class="post-more">      
			<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'excerpt' ) { ?>
				<span class="read-more"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;', 'woothemes' ); ?>"><?php _e( 'Continue Reading &rarr;', 'woothemes' ); ?></a></span>
			<?php } ?>
			</footer>  
		
		</section><!-- /.post-body -->

	</article><!-- /.post -->