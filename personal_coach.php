<?php
/*
 * Plugin Name: Personal Coach
 * Description: Personal coach system
 * Version: 1.0
 * Author: Victor Crespo
 * Author URI: https://victorcrespo.net
 * Text Domain: coach
*/

if( !function_exists( 'add_action' ) ){
 exit;
}

//Setup
define( 'PC_PLUGIN_URL', __FILE__ );

//Includes
include( 'includes/pc_activate_plugin.php' );
include( 'includes/pc_enqueue.php' );
include( 'includes/pc_admin_view_shortcode.php' );
include( 'includes/pc_admin_view.php' );
include( 'includes/pc_user_view_shortcode.php' );
include( 'includes/pc_user_registration.php' );
include( 'includes/pc_customer_info.php' );
include( 'includes/pc_customer_progress.php' );
include( 'includes/pc_customer_progress_view.php' );
include( 'includes/pc_customer_weekly_follow_up.php' );

//Hooks
register_activation_hook( PC_PLUGIN_URL, 'pc_activate_plugin' );
add_action( 'wp_enqueue_scripts', 'pc_enqueue', 10 );
add_action( 'wp_ajax_pc_user_registration', 'pc_user_registration' );
add_action( 'wp_ajax_nopriv_pc_user_registration', 'pc_user_registration' );
add_action( 'wp_ajax_pc_admin_view_info', 'pc_admin_view_info' );
add_action( 'wp_ajax_nopriv_pc_admin_view_info', 'pc_admin_view_info' );
add_action( 'wp_ajax_pc_customer_progress_view', 'pc_customer_progress_view' );
add_action( 'wp_ajax_nopriv_pc_customer_progress_view', 'pc_customer_progress_view' );
add_action( 'wp_ajax_pc_admin_view_follow_up', 'pc_admin_view_follow_up' );
add_action( 'wp_ajax_nopriv_pc_admin_view_follow_up', 'pc_admin_view_follow_up' );
add_action( 'wp_ajax_pc_weekly_follow_up_registration', 'pc_weekly_follow_up_registration' );
add_action( 'wp_ajax_nopriv_pc_weekly_follow_up_registration', 'pc_weekly_follow_up_registration' );
add_action( 'wp_ajax_pc_inactive_customer', 'pc_inactive_customer' );
add_action( 'wp_ajax_nopriv_pc_inactive_customer', 'pc_inactive_customer' );

//Shortcodes
add_shortcode( 'admin_view', 'pc_admin_view_shortcode' );
add_shortcode( 'user_view', 'pc_user_view_shortcode' );
