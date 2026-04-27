<?php
/*
	Plugin Name: WooCommerce Easy Checkout Fields Editor
	Plugin URI: https://woomatrix.com
	Description: lets you Add/edit/delete checkout fields for woocoomerce. 
    Version: 1.8.4
	Author: woomatrix
	Author URI: https://woomatrix.com
	
	Text Domain: pcfme
	Domain Path: /languages
	Requires at least: 3.3
    Tested up to: 5.2.2
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


 if( !defined( 'pcfme_PLUGIN_URL' ) )
define( 'pcfme_PLUGIN_URL', plugin_dir_url( __FILE__ ) );



load_plugin_textdomain( 'pcfme', false, basename( dirname(__FILE__) ).'/languages' );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if (is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	
  include dirname( __FILE__ ) . '/include/pcmfe_core_functions.php';
  include dirname( __FILE__ ) . '/include/update_checkout_fields_class.php';
  include dirname( __FILE__ ) . '/include/add_order_meta_fields_class.php';
  include dirname( __FILE__ ) . '/include/manage_extrafield_class.php';
  include dirname( __FILE__ ) . '/include/add_fields_to_myaccount.php';
  include dirname( __FILE__ ) . '/include/admin/pcfme_admin_settings.php';

}


?>