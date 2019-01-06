<?php
/**
 * Plugin Name: 360 Viewer Light for Elementor & WPBakery
 * Plugin URI: https://demo.pro-app.com.ua
 * Description: Add 360 images for your website. It works for Elementor and WPBakery.
 * Author: elantawp
 * Author URI: https://profiles.wordpress.org/elantawp
 * Version: 1.0.1
 * Text Domain: elanta-viewer-light
 *
 * @package ELANTA_VIEWER
 */

// If this file is accessed directory, then abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

define( 'ELANTA_VIEWER_PATH', dirname( __FILE__ ) . '/' );
define( 'ELANTA_VIEWER_URL', plugin_dir_url( __FILE__ ) );

/*
 * Include core.
 */
if ( ! class_exists( 'ElantaBuilder\\Core' ) ) {
	require ELANTA_VIEWER_PATH . 'elanta-builder/core.php';
}

/*
 * Include additional functions.
 */
require ELANTA_VIEWER_PATH . 'src/functions.php';

/*
 * Include core of plugin
 */
if ( ! class_exists( 'ElantaViewerCore\\Core' ) ) {
	require ELANTA_VIEWER_PATH . 'src/core.php';
}
