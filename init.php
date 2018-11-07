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
add_action('admin_enqueue_scripts','script_file');
add_action('wp_ajax_activation_key_block','activation_key_block');
add_action('wp_ajax_activation_key_unblock','activation_key_unblock');
function activation_key_block(){
	global $wpdb;
	$table_name = $wpdb->prefix.'activation_key';
	$customer_id = $_POST['customer_id'];
	$block = $wpdb->update($table_name,array('activation_key_status'=>'2'),array('id'=>$customer_id));
	if($block){
		echo json_encode(array('status'=>'1'));
		wp_die();
	}else{
		echo json_encode(array('status'=>'0'));
		wp_die();
		}
}

function activation_key_unblock(){
	global $wpdb;
	$table_name = $wpdb->prefix.'activation_key';
	$customer_id = $_POST['customer_id'];
	$previous_key_status = $_POST['previous_key_status'];
	$unblock = $wpdb->update($table_name,array('activation_key_status'=>$previous_key_status),array('id'=>$customer_id));
	if($unblock){
		echo json_encode(array('status'=>'1'));
		wp_die();
	}else{
		echo json_encode(array('status'=>'0'));
		wp_die();
		}
}


function script_file(){
	$url = plugin_dir_url(__FILE__);
	wp_enqueue_script('jquery');
	wp_enqueue_script('ajax-call',$url.'ajax-call.js');
}

function menu(){
		add_menu_page('Release Plugin','Release Plugin','manage_options','plugin_release','form_design');
		add_submenu_page( 'plugin_release','View Users','Users List','manage_options','users_list', 'users_list' );
}
function form_design(){
	$dir = plugin_dir_path(__FILE__);
	include_once $dir.'plugin_release_menu.php';

}

function users_list(){
	$dir = plugin_dir_path(__FILE__);
	include_once $dir.'users_list.php';
}

register_activation_hook(__FILE__,'activation_table');
register_deactivation_hook(__FILE__,'deactivation_table');

function activation_table(){
	global $wpdb;
	$plugin_release = $wpdb->prefix."plugin_release";	
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $plugin_release (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`slug` varchar(100) NOT NULL DEFAULT 'wp_form',
	`download_url` varchar(100) NOT NULL DEFAULT 'http://localhost/wp-form.zip',
	`version` varchar(100) NOT NULL DEFAULT '2.0',
	PRIMARY KEY (`id`)
	) $charset_collate";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	$wpdb->insert($plugin_release,array('slug'=>'wp_form','download_url'=>'http://localhost/wp-form.zip','version'=>'2.0'));

}


 function deactivation_table(){
		global $wpdb;
		$plugin_release = $wpdb->prefix."plugin_release";	
		$wpdb->query("TRUNCATE TABLE $plugin_release ");
	}