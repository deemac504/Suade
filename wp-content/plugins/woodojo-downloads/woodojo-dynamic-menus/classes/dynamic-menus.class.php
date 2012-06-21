<?php
/**
 * WooDojo Dynamic Menus Class
 *
 * All functionality pertaining to the Dynamic Menus feature.
 *
 * @package WordPress
 * @subpackage WooDojo
 * @category Downloadable
 * @author WooThemes, Tiago
 * @since 1.0.0
 *
 * TABLE OF CONTENTS
 *
 * 	var $plugin_path;
 *	var $plugin_basename;
 *	var $meta_key; 
 *
 * - __construct()
 * - meta_box()
 * - metabox_markup()
 * - save_custom_menus()
 * - get_custom_data()
 * - filter_menus()
 * - filter_nav_locations()
 */
class WooDojo_Dynamic_Menu {

	var $plugin_path;
	var $plugin_basename;
	var $meta_key;

	/**
	 * __construct function.
	 * 
	 * @since 1.0.0
	 * @return void
	 */	
	public function __construct() {
		
		// Set Plugin Path
		$this->plugin_path = dirname(__FILE__);
		
		// Set Plugin BaseName
		$this->plugin_basename = plugin_basename(__FILE__);
		
		// Set Meta Key
		$this->meta_key = '_dm_data';
		
		// Add metabox only in the backend
		if (is_admin()) {

			add_action('admin_menu', array(&$this, 'meta_box'));
			add_action('save_post', array(&$this, 'save_custom_menus'), 1, 2); // save the custom fields
		
		}
		
		// Filter the pre-menus
		add_filter('theme_mod_nav_menu_locations', array(&$this, 'filter_nav_locations') );
		
	}

	/**
	 * meta_box function.
	 * 
	 * @since 1.0.0
	 * @return void
	 */	
	function meta_box() {
				
		// Add metabox to all custom post types
		$post_types = get_post_types('','names');
		foreach ($post_types as $post_type)
			add_meta_box('dm_custom_locations', __('Custom Menus', 'woodojo'), array(&$this, 'metabox_markup'), $post_type, 'side', 'default');
			
	}

	/**
	 * metabox_markup function.
	 * 
	 * @since 1.0.0
	 * @return void
	 */	
	function metabox_markup() {
	
		global $post;
		
		// Retrive custom saved data, if any.
		if ( $this->get_custom_data($post->ID) )
			$saved_menu_options = $this->get_custom_data($post->ID);
				
		$menu_locations = get_registered_nav_menus(); // Get theme menu locations

		foreach ( $menu_locations as $k => $v ) {
		
			echo '<input type="hidden" name="dm_noncename" id="dm_noncename" value="' . wp_create_nonce( $this->plugin_basename ) . '" />';
 
			echo '<p>' . $v . '</p>'; // Menu location name
			
			$menus = wp_get_nav_menus(); // Get custom menus for select box

			echo '<select id="dm-' . $k . '" name="dm-' . $k . '">';
			echo '<option  value="#NONE#">— Select —</option>';
			
			foreach ( $menus as $menu ) {

				if ( isset($saved_menu_options) ) {
					$selected = ($saved_menu_options['dm-'.$k] == $menu->term_id ? 'selected' : '');
				} else {
					$selected = '';
				}

				echo '<option ' . $selected . ' value="' . $menu->term_id . '">' . $menu->name . '</option>';
				
			}
						
			echo '</select>';
		
		}
		
		if (count($menu_locations) == 0)
			echo '<p>' . __("Your theme doesn't seem to have any pre-defined menu locations. :(", 'woodojo') . '</p>';

	}

	/**
	 * save_custom_menus function.
	 * 
	 * @since 1.0.0
	 * @return void
	 */	
	function save_custom_menus($post_id, $post) {
				
		if ( !wp_verify_nonce( $_POST['dm_noncename'], $this->plugin_basename ))
	    	return $post->ID;
	    
	    if ( !current_user_can( 'edit_post', $post->ID ))
        	return $post->ID;
        
        // Initiate array
        $menus = array();
        
        // Look for the menus custom data
        foreach( $_POST as $k => $v )
        	if (preg_match('/dm-/', $k))
        		$menus[$k] = $v;
        	
        //unset($menus);
        
		if( get_post_meta($post->ID, $this->meta_key, FALSE) ) {
		
			delete_post_meta($post->ID, $this->meta_key); // Make it blank first. Since this is an array, WordPress adds to the end of the array instead of replacing with a new one
			
			add_post_meta($post->ID, $this->meta_key, $menus);
			
		} else { // If the custom field doesn't have a value at all
		
			add_post_meta($post->ID, $this->meta_key, $menus);
			
		}
		
		if ( count($menus) <= 0 ) delete_post_meta($post->ID, $this->meta_key);
		
	}

	/**
	 * get_custom_data function.
	 * 
	 * @since 1.0.0
	 * @param $post_id The post id
	 * @return array/boolean
	 */	
	function get_custom_data($post_id) {
		
		// Retrive custom field data from post
		if( get_post_meta($post_id, $this->meta_key, FALSE) ) {
		
			$saved_menu_options = get_post_meta($post_id, $this->meta_key, FALSE);
			$saved_menu_options = reset($saved_menu_options); // Remove outer array
			
			return $saved_menu_options;
			
		}
		
		return false;
		
	}

	/**
	 * filter_nav_locations function.
	 * 
	 * @since 1.0.0
	 * @param array $args The menu arguments 
	 * @return array $args
	 */	
	function filter_nav_locations($args) {

		global $post;
						
		// This only works in posts & pages
		if ( !is_single() && !is_page() ) 
			return $args;
				
		// No custom options, return!
		if ( !$this->get_custom_data($post->ID) )
			return $args;
		
		// Get the custom options
		$menus = $this->get_custom_data($post->ID);	

		foreach ( $menus as $k => $v ) {
			
			// Remove prefix from input fields
			$name = str_replace('dm-', '', $k);			
			$menu = wp_get_nav_menu_object( $v );
			$args[$name] = $menu->term_id;
			
		}
				
		return $args;
		
	}

}