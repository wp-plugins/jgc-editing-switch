<?php
/*
Plugin Name: JGC Editing Switch
Description: This plugin allows you to quickly change page or post in the edit screen while editing.
Version: 1.0.0
Author: GalussoThemes
Author URI: http://galussothemes.com
License: GPLv2
*/

// Salir si se accede directamente
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action('init', 'jgcedsw_load_textdomain');
function jgcedsw_load_textdomain() {
	
	load_plugin_textdomain( 'jgcedsw-plugin', false, basename( dirname( __FILE__ ) ) . '/languages' );
	
}

require_once( plugin_dir_path( __FILE__ ) . 'inc/jgc-editing-switch-posts.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/jgc-editing-switch-pages.php' );

?>
