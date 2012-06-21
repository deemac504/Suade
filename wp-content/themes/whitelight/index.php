<?php
/**
 * Index Template
 *
 * Here we setup all logic and XHTML that is required for the index template, used as both the homepage
 * and as a fallback template, if a more appropriate template file doesn't exist for a specific context.
 *
 * @package WooFramework
 * @subpackage Template
 */
	get_header();
	
	/**
 	* The Variables
 	*
 	* Setup default variables, overriding them if the "Theme Options" have been saved.
 	*/
	
	$settings = array(
					'featured' => 'false',
					'custom_intro_message' => 'true',
					'custom_intro_message_text' => '',
					'features_area' => 'true',
					'portfolio_area' => 'true',
					'blog_area' => 'false',
					'alt_blog_area' => 'false'
					);
					
	$settings = woo_get_dynamic_values( $settings );
	
?>
		
	<?php if ( !$paged && $settings['custom_intro_message'] == "true" ) { ?>
	<section id="intro">
    	<div class="container">
        	<h1><?php echo stripslashes( $settings['custom_intro_message_text'] ); ?></h1>
    	</div>
    </section>
    <?php } ?>
    
    <div class="wrapper">
    <section id="clients">
    		<div class="container">
    			<h3>Our Latest Clients</h3>
    			<div class="logos">
    				<img src="http://localhost:8888/suadellc-2013/wp-content/uploads/2012/06/logos-transparent.png" alt="Client Logos" />
    			</div>
    		</div>
    </section><!-- /#clients -->
	
    <div id="content">
    	<div class="container">
    	
    	<?php
    	/* Make sure we switch to the selected layout if a custom layout isn't set. */
		if ( ! is_active_sidebar( 'homepage' ) ) {
		
			// Output the Features Area	
			if ( !$paged && $settings['features_area'] == 'true' ) { get_template_part( 'includes/homepage-features-panel' ); } 
			
			// Output the Portfolio Area	
			if ( !$paged && $settings['portfolio_area'] == 'true' ) { get_template_part( 'includes/homepage-portfolio-panel' ); } 
			
			// Output the Blog Area	
			if ( $settings['alt_blog_area'] == 'true' ) { get_template_part( 'includes/homepage-blog-alt-panel' ); } 

			// Output the Content Area	
			if ( $settings['blog_area'] == 'true' ) { get_template_part( 'includes/homepage-blog-panel' ); } 
		
		} else {
			
			// Output the Widgetized Area
			dynamic_sidebar( 'homepage' );
		
		} // End If Statement
		?>
    	
		</div><!-- /.col-full -->
    </div><!-- /#content -->
    </div><!-- /.wrapper -->
		
<?php get_footer(); ?>