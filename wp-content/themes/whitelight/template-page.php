<?php
/**
 * Template Name: Page with Banner & Sidebar
 *
 * This template is the default page template. It is used to display content when someone is viewing a
 * singular view of a page ('page' post_type) unless another page template overrules this one.
 * @link http://codex.wordpress.org/Pages
 *
 * @package WooFramework
 * @subpackage Template
 */
	get_header();
	global $woo_options;
?>
    
    <div class="wrapper">   
    <div id="content">
    	<div class="page col-full">
    	
    		<?php if ( isset( $woo_options['woo_breadcrumbs_show'] ) && $woo_options['woo_breadcrumbs_show'] == 'true' && !is_front_page() ) { ?>
				<section id="breadcrumbs">
					<?php woo_breadcrumbs(); ?>
				</section><!--/#breadcrumbs -->
			<?php } ?> 
    	
			<section id="main" class="col-left"> 
			
			<div class="center-text">			
	
	        <?php
	        	if ( have_posts() ) { $count = 0;
	        		while ( have_posts() ) { the_post(); $count++;
	        ?>                                                           
	            <article <?php post_class(); ?>>
					
					<header>
				    	<h1><?php the_title(); ?></h1>
					</header>
					
	                <section class="entry">
	                	<?php the_content(); ?>
	
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) ); ?>
	               	</section><!-- /.entry -->
	
					<?php edit_post_link( __( '{ Edit }', 'woothemes' ), '<span class="small">', '</span>' ); ?>
	                
	            </article><!-- /.post -->
	            
	            <?php
	            	// Determine wether or not to display comments here, based on "Theme Options".
	            	if ( isset( $woo_options['woo_comments'] ) && in_array( $woo_options['woo_comments'], array( 'page', 'both' ) ) ) {
	            		comments_template();
	            	}
	
					} // End WHILE Loop
				} else {
			?>
				<article <?php post_class(); ?>>
	            	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
	            </article><!-- /.post -->
	        <?php } // End IF Statement ?>  
	        
	        </div>
			
			</section><!-- /#main -->
	
	        <?php if( is_page( array ( 173,178,199,5 ) ) ) : ?>
<?php get_sidebar('cases'); ?>
<?php else : ?>
<?php get_sidebar(); ?>
<?php endif; ?>
		</div>
		
    </div><!-- /#content -->
    </div><!-- /.wrapper -->
    
		
<?php get_footer(); ?>