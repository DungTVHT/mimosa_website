<?php
/**
 * Plugin Name:       Booking Tour
 * Plugin URI:        https://willgroup.net/
 * Description:       Add book to your woocommerce.
 * Version:           1.0.0
 * Author:            Willgroup
 * Author URI:        https://willgroup.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       willgroup
 * Domain Path:       /languages
 */

/**
 * If this file is called directly, abort.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'WILLGROUP_BOOK_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'WILLGROUP_BOOK_DIR_URL', plugin_dir_url( __FILE__ ) );

/**
 * The ACF class doesn't exist, so you can probably redefine your functions here
 */
if ( !class_exists('ACF') ) {
	/**
	 * 1. Customize ACF path
	 */
	add_filter('acf/settings/path', 'willgroup_book_acf_settings_path');
	function willgroup_book_acf_settings_path( $path ) {
		$path = WILLGROUP_BOOK_DIR_PATH . 'inc/acf/';
		return $path;
	}

	/**
	 * 2. Customize ACF dir
	 */
	add_filter('acf/settings/dir', 'willgroup_book_acf_settings_dir');
	function willgroup_book_acf_settings_dir( $dir ) {
		$dir = WILLGROUP_BOOK_DIR_URL . 'inc/acf/';
		return $dir;
	}

	/**
	 * 3. Hide ACF field group menu item
	 */
	add_filter('acf/settings/show_admin', '__return_false');

	/**
	 * 4. Intergrate ACF to plugin
	 */
	require WILLGROUP_BOOK_DIR_PATH . 'inc/acf/acf.php';
}

/**
 * The code that create options page
 */
require WILLGROUP_BOOK_DIR_PATH . 'inc/options-page.php';

/**
 * The code that create post type book
 */
require WILLGROUP_BOOK_DIR_PATH . 'inc/book.php';

/**
 * The code that make functions
 */
require WILLGROUP_BOOK_DIR_PATH . 'inc/functions.php';

/**
 * The code that make ajax
 */
require WILLGROUP_BOOK_DIR_PATH . 'inc/ajax.php';

/**
 * The code that create shortcodes
 */
require WILLGROUP_BOOK_DIR_PATH . 'inc/shortcodes.php';

/**
 * Enqueue scripts and styles.
 */
function willgroup_book_enqueue_scripts() {
	wp_enqueue_style( 'willgroup-book-icon', WILLGROUP_BOOK_DIR_URL . 'css/all.min.css' );
	wp_enqueue_style( 'willgroup-book-lightpick', WILLGROUP_BOOK_DIR_URL . 'css/lightpick.min.css' );
	wp_enqueue_style( 'willgroup-book-style', WILLGROUP_BOOK_DIR_URL . 'css/style.css' );
	wp_enqueue_script( 'willgroup-book-lightpick', WILLGROUP_BOOK_DIR_URL . 'js/lightpick.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'willgroup-book-script', WILLGROUP_BOOK_DIR_URL . 'js/script.js', array('jquery'), '', true );
	wp_localize_script( 'willgroup-book-script', 'ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'willgroup_book_enqueue_scripts' );