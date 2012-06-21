<?php
/**
 * Module Name: WooDojo - Dynamic Menus
 * Module Description: Dynamically select a custom menu for the available Menu Locations in your posts, pages and custom post types.
 * Module Version: 1.0.0
 *
 * @package WooDojo
 * @subpackage Downloadable
 * @author Tiago
 * @since 1.0.0
*/

 /* Instantiate The Feature */
 if ( class_exists( 'WooDojo' ) ) {
 	require_once( 'classes/dynamic-menus.class.php' );
 	$woodojo_dynamic_menus = new WooDojo_Dynamic_Menu;
 }
 
?>