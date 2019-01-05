<?php

namespace ElantaBuilder;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Autoloader {

	/**
	 * All classes.
	 * @since  1.0.0
	 * @access private
	 * @var $classes_map
	 */
	private static $classes_map = [
		'Parse'         => 'parse.php',
		'Converter'     => 'converter.php',
		'Loader'        => 'loader.php',
		'initElementor' => 'elementor/init.php',
		'initWpbakery'  => 'wpbakery/init.php',
	];

	/**
	 * @static
	 * @since  1.0.0
	 * @access public
	 */
	public static function run() {
		spl_autoload_register( [ __CLASS__, 'autoload' ] );
	}

	/**
	 * @static
	 * @since  1.0.0
	 * @access private
	 */
	private static function load_class( $relative_class_name ) {
		if ( isset( self::$classes_map[ $relative_class_name ] ) ) {
			$filename = ELANTA_BUILDER_PATH . '/' . self::$classes_map[ $relative_class_name ];
		} else {
			$filename = strtolower( preg_replace( [ '/([a-z])([A-Z])/', '/_/', '/\\\/' ], [
				'$1-$2',
				'-',
				DIRECTORY_SEPARATOR,
			], $relative_class_name ) );

			$filename = ELANTA_BUILDER_PATH . $filename . '.php';
		}

		if ( is_readable( $filename ) ) {
			require $filename;
		}
	}

	/**
	 * @static
	 * @since  1.0.0
	 * @access private
	 */
	private static function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ . '\\' ) ) {
			return;
		}

		$relative_class_name = preg_replace( '/^' . __NAMESPACE__ . '\\\/', '', $class );

		$final_class_name = __NAMESPACE__ . '\\' . $relative_class_name;

		if ( ! class_exists( $final_class_name ) ) {
			self::load_class( $relative_class_name );
		}
	}
}
