<?php
/**
 * Plugin Name: WooSidebars
 * Plugin URI: http://woothemes.com/
 * Description: Replace widget areas in your theme for specific pages, archives and other sections of WordPress.
 * Author: WooThemes
 * Author URI: http://woothemes.com/
 * Version: 1.1.1
 * Stable tag: 1.1.1
 * License: GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
 if ( ! class_exists( 'Woo_Conditions' ) ) {
 	require_once( 'classes/class.wooconditions.php' );
 }
 require_once( 'classes/class.woosidebars.php' );
 
 // Third-party integrations.
 if ( class_exists( 'Woocommerce' ) ) require_once( 'integrations/integration-woocommerce.php' );

 global $woosidebars;
 $woosidebars = new Woo_Sidebars( __FILE__ );
 $woosidebars->version = '1.1.1';
 $woosidebars->init();
?>