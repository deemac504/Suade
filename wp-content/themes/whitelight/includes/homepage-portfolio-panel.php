<?php
/**
 * Homepage Portfolio Panel
 */
 
	/**
 	* The Variables
 	*
 	* Setup default variables, overriding them if the "Theme Options" have been saved.
 	*/
	
	$settings = array(
					'portfolio_area_entries' => 3,
					'portfolio_area_title' => '',
					'portfolio_area_message' => '',
					'portfolio_area_link_text' => __( 'View more work', 'woothemes' ),
					'portfolio_area_link_URL' => '',
					'portfolio_area_order' => 'DESC',
					'portfolio_linkto' => 'page'
					);
					
	$settings = woo_get_dynamic_values( $settings );
	$orderby = 'date';
	if ( $settings['portfolio_area_order'] == 'rand' )
		$orderby = 'rand';
	
?>
			<section id="portfolio" class="home-section fix">
    		
    			<header class="block">
    				<h1><?php echo stripslashes( $settings['portfolio_area_title'] ); ?></h1>
    				<p><?php echo stripslashes( $settings['portfolio_area_message'] ); ?></p>
    				<a class="more" href="<?php if ( $settings['portfolio_area_link_URL'] != '' ) echo $settings['portfolio_area_link_URL']; else echo get_post_type_archive_link('portfolio'); ?>" title="<?php $settings['portfolio_area_link_text']; ?>"><?php echo $settings['portfolio_area_link_text']; ?></a>
    			</header>
    			
    			<?php 		
    			$count = 0;
    			$args = array(	
    						'post_type' => 'portfolio', 
							'numberposts' => $settings['portfolio_area_entries'], 
							'suppress_filters' => 0,
							'order' => $settings['portfolio_area_order'], 
							'orderby' => $orderby
						);
				$portfolio = get_posts( $args );	
    			?>
    			
    			<ul>
			
				<?php
					$original_post = $post;
					
					foreach( $portfolio as $post ) : setup_postdata( $post ); $count++;
				
						$rel = '';
						
    					$custom_url = get_post_meta( $post->ID, '_portfolio_url', true ); 
    					if ( $custom_url != '' )
    						$permalink = $custom_url;
    					else
    						$permalink = get_permalink( get_the_ID() );
						
						if ( $settings['portfolio_linkto'] == 'lightbox' ) {
							if ( $custom_url == '' )
								$permalink = woo_image( 'return=true&link=url' );
							$rel = ' rel="lightbox[\'home\']"';
						}
				
						$image = woo_image( 'width=240&height=180&link=img&return=true&noheight=true' ); 
						
						if ( ! has_post_thumbnail( get_the_ID() ) ) {
							$image = '<img src="'.get_template_directory_uri() . '/images/temp-portfolio.png" alt="" />';
							$rel = ''; // Prevent items without images from displaying in the lightbox.
						}
					?>
				
					<li <?php if( $count % 3 == 0 ) echo 'class="last"'; ?>>
					<article class="portfolio-item drop-shadow curved curved-hz-1">
						<a href="<?php echo $permalink; ?>" class="item"<?php echo $rel; ?>>
							<?php echo $image; ?>
							<div class="mask">
								<div class="content">
									<h2><?php the_title(); ?></h2>
																	</div>
								<img class="icon" src="<?php bloginfo('template_directory'); ?>/images/ico-portfolio-hover.png" alt="View" />
							</div>
						</a>
					</article>
					</li>
				
				<?php endforeach; ?> 
			
				</ul>
    			
    		</section>
    	
    		<?php wp_reset_query(); ?>