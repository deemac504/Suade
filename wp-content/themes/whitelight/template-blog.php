<?php
/**
 * Template Name: Blog
 *
 * The blog page template displays the "blog-style" template on a sub-page. 
 *
 * @package WooFramework
 * @subpackage Template
 */

 global $woo_options;
 get_header();
 
/**
 * The Variables
 *
 * Setup default variables, overriding them if the "Theme Options" have been saved.
 */
	
	$settings = array();
					
	$settings = woo_get_dynamic_values( $settings );
?>
    <!-- #content Starts -->
    <div class="wrapper">
    
    <div id="content">
    
    	<div class="container">
    	
    		<?php if ( isset( $woo_options['woo_breadcrumbs_show'] ) && $woo_options['woo_breadcrumbs_show'] == 'true' ) { ?>
				<section id="breadcrumbs">
					<?php woo_breadcrumbs(); ?>
				</section><!--/#breadcrumbs -->
			<?php } ?> 
    
	        <!-- #main Starts -->
	        <section id="main" class="col-left">       
		        
	        <?php
	        	if ( get_query_var( 'paged') ) { $paged = get_query_var( 'paged' ); } elseif ( get_query_var( 'page') ) { $paged = get_query_var( 'page' ); } else { $paged = 1; }
	        	
	        	$query_args = array(
	        						'post_type' => 'post', 
	        						'paged' => $paged
	        					);
	        	
	        	$query_args = apply_filters( 'woo_blog_template_query_args', $query_args ); // Do not remove. Used to exclude categories from displaying here.
	        	
	        	remove_filter( 'pre_get_posts', 'woo_exclude_categories_homepage' );
	        	
	        	query_posts( $query_args );
	        	
	        	if ( have_posts() ) {
	        		$count = 0;
	        		while ( have_posts() ) { the_post(); $count++;
	        ?>                                                            
	            <?php
				    /* Include the Post-Format-specific template for the content.
				     * If you want to overload this in a child theme then include a file
				     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				     */
				    get_template_part( 'content', get_post_format() );
				?>
	                                                
	        <?php
	        		} // End WHILE Loop
	        	
	        	} else {
	        ?>
	            <article <?php post_class(); ?>>
	                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
	            </article><!-- /.post -->
	        <?php } // End IF Statement ?>  
	    
	            <?php woo_pagenav(); ?>
				<?php wp_reset_query(); ?>                
	
	        </section><!-- /#main -->
	            
			<?php get_sidebar(); ?>
		
		</div>

    </div><!-- /#content -->   
    
    </div><!-- /.wrapper   --> 
		
<?php get_footer(); ?>