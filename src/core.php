<?php
/**
 * User: elanta https://codecanyon.net/user/elanta/portfolio
 * Date: 27.12.2018
 *
 * @package ELANTA_VIEWER/Core
 */

namespace ElantaViewerCore;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class Core of Plugin.
 *
 * @since  1.0.0
 */
class Core {

	/**
	 * Instance. Holds the plugin instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 * @var $instance
	 */
	public static $instance = null;

	/**
	 * Instance.
	 *
	 * @return Core|null
	 * @throws \Exception Exception.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();

			/**
			 * ElantaViewerCore loaded.
			 *
			 * @since 1.0.0
			 */
			do_action( 'elantaBuilder_viewer_loaded' );
		}

		return self::$instance;
	}

	/**
	 * Constructor loads API functions, defines paths and adds required wp actions
	 *
	 * @since  1.0
	 * @throws \Exception Exception.
	 */
	private function __construct() {

		// Include autoloader.php.
		require dirname( __FILE__ ) . '/autoloader.php';

		/*
		 * Register autoloader and add namespaces
		 *
		 */
		$this->register_autoloader();

		/**
		 * Init components.
		 */
		$this->init_components();

		// Load translations.
		add_action( 'after_setup_theme', array( &$this, 'load_translations' ) );

	}


	/**
	 * Register autoloader.
	 *
	 * @since  1.0.0
	 * @access private
	 * @throws \Exception Exception.
	 */
	private function register_autoloader() {

		// Get the autoloader.
		$loader = new Autoloader();

		// Register the autoloader.
		$loader->register();

		// Register the base directories for the namespace prefix.
		$loader->add_namespace( 'ElantaViewerCore', ELANTA_VIEWER_PATH . 'src' );

	}

	/**
	 * Init ElantaViewerCore components.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	public function init_components() {

		// Enqueue all scripts and styles.
		$enqueue = new Enqueue();
		$enqueue->init();

		/**
		 * ElantaViewerCore init.
		 *
		 * @since 1.0.0
		 */
		do_action( 'elantaBuilder_viewer_init' );
	}

	/**
	 * Load plugin translations
	 *
	 * @return void
	 */
	public static function load_translations() {
		load_plugin_textdomain( 'elanta-viewer-light', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
	}


}

Core::instance();
