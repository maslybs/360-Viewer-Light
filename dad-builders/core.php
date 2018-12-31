<?php

namespace DadBuilders;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DADBUILDERS_VERSION', '1.0.0' );
define( 'DADBUILDERS__FILE__', __FILE__ );
define( 'DADBUILDERS_PATH', wp_normalize_path( dirname( DADBUILDERS__FILE__ ) ) . '/' );
define( 'DADBUILDERS_PARENT', dirname( DADBUILDERS_PATH ) . '/' );
define( 'DADBUILDERS_DATA', DADBUILDERS_PARENT . 'data/' );
define( 'DADBUILDERS_DATA_URL', plugins_url( '/data/', DADBUILDERS_DATA ) );

/**
 * Main plugin class.
 */
class Core {

	/**
	 * @var Core
	 */
	public static $instance = null;


	/**
	 * @static
	 * @since  1.0.0
	 * @access public
	 * @return Plugin
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			do_action( 'dadBuilders/loaded' );
		}

		return self::$instance;
	}

	/**
	 * Init
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function init() {

		$this->init_components();

		do_action( 'dadBuilders/init' );
	}

	/**
	 * @since  1.0.0
	 * @access private
	 */
	private function init_components() {
		$this->parse     = new Parse();
		$this->loader    = new Loader();
		$this->converter = new Converter();
		$this->elementor = new initElementor();


		$this->wpbakery = new initWpbakery();
	}


	/**
	 * @since  1.6.0
	 * @access private
	 */
	private function register_autoloader() {

		require DADBUILDERS_PATH . 'autoloader.php';

		Autoloader::run();
	}

	/**
	 * Plugin constructor.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function __construct() {
		$this->register_autoloader();
		$this->init();
	}


}

Core::instance();
