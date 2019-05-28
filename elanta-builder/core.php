<?php

namespace ElantaBuilder;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

define( 'ELANTA_BUILDER_VERSION', '1.0.0' );
define( 'ELANTA_BUILDER__FILE__', __FILE__ );
define( 'ELANTA_BUILDER_PATH', wp_normalize_path( dirname( ELANTA_BUILDER__FILE__ ) ) . '/' );
define( 'ELANTA_BUILDER_PARENT', dirname( ELANTA_BUILDER_PATH ) . '/' );
define( 'ELANTA_BUILDER_DATA', ELANTA_BUILDER_PARENT . 'data/' );
define( 'ELANTA_BUILDER_DATA_URL', plugins_url( '/data/', ELANTA_BUILDER_DATA ) );

/**
 * Main plugin class.
 */
class Core {

	/**
	 * Instance.
	 *
	 * @var Core
	 */
	public static $instance = null;


	/**
	 * @static
	 * @return Plugin
	 * @since  1.0.0
	 * @access public
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			do_action( 'elantabuilder/loaded' );
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

		do_action( 'elantabuilder/init' );
	}

	/**
	 * @since  1.0.0
	 * @access private
	 */
	private function init_components() {

		new Autoloader();
		new Parse();
		new Loader();
		new Converter();
		new InitElementor();
		new InitWpbakery();

	}


	/**
	 * Register autoloader.
	 *
	 * @since  1.6.0
	 * @access private
	 */
	private function register_autoloader() {

		require ELANTA_BUILDER_PATH . 'autoloader.php';

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
