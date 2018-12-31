<?php
/**
 * Plugin Name: 360 Viewer Light for Elementor & WPBakery
 * Plugin URI: https://demo.pro-app.com.ua
 * Description: Add 360 images for your website. It works for Elementor and WPBakery.
 * Author: elantawp
 * Author URI: https://profiles.wordpress.org/elantawp
 * Version: 1.0.0
 * Text Domain: 360-viewer-light
 *
 * @package PVIEWER
 */

// If this file is accessed directory, then abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PVR_PATH', dirname( __FILE__ ) . '/' );
define( 'PVR_URL', plugin_dir_url( __FILE__ ) );

/*
 * Include core.
 */
require PVR_PATH . 'dad-builders/core.php';

/*
 * Include additional functions.
 */
require PVR_PATH . 'src/functions.php';

/*
 * Include core of plugin
 */
require PVR_PATH . 'src/core.php';
