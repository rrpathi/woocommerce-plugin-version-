<?php 
/*
Plugin Name:  WP Notify
Plugin URI:   https://developer.wordpress.org/plugins/the-basics/
Description:  Basic WordPress Plugin Header Comment
version:      2.0
Author:       WordPress.org
Author URI:   https://developer.wordpress.org/
*/
add_action('admin_menu','menu');

function menu(){
		add_menu_page('Release Plugin','Release Plugin','manage_options','plugin_release','form_design');
}
function form_design(){
	$dir = plugin_dir_path(__FILE__);
	include_once $dir.'plugin_release_menu.php';

}

register_activation_hook(__FILE__,'activation_table');
register_deactivation_hook(__FILE__,'deactivation_table');

function activation_table(){
	global $wpdb;
	$plugin_release = $wpdb->prefix."plugin_release";	
	$sql = "CREATE TABLE $plugin_release (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`slug` varchar(100) NOT NULL DEFAULT 'wp_form',
	`download_url` varchar(100) NOT NULL DEFAULT 'http://localhost/wp-form.zip',
	`version` varchar(100) NOT NULL DEFAULT '2.0',
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	$wpdb->insert($plugin_release,array('slug'=>'wp_form','download_url'=>'http://localhost/wp-form.zip','version'=>'2.0'));

}


 function deactivation_table(){
		global $wpdb;
		$plugin_release = $wpdb->prefix."plugin_release";	
		$wpdb->query("TRUNCATE TABLE $plugin_release ");
	}