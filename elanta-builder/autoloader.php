<?php
/**
 * User: elanta https://codecanyon.net/user/elanta/portfolio
 * Date: 27.12.2018
 *
 * @package ElantaBuilder/Autoloader
 */

namespace ElantaBuilder;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Builder Autoloader.
 *
 * @since  1.0.0
 */
class Autoloader {

	/**
	 * All classes.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var $classes_map
	 */
	public static $classes_map = array(
		'Parse'         => 'parse.php',
		'Converter'     => 'converter.php',
		'Loader'        => 'loader.php',
		'InitElementor' => 'elementor/init.php',
		'InitWpbakery'  => 'wpbakery/init.php',
	);

	/**
	 * Run Autoload.
	 *
	 * @static
	 * @throws \Exception Exception.
	 * @since  1.0.0
	 * @access public
	 */
	public function init() {

		spl_autoload_register( array( __CLASS__, 'autoload' ) );

	}

	/**
	 *
	 * Load class.
	 *
	 * @static
	 *
	 * @param string $relative_class_name Class name.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private static function load_class( $relative_class_name ) {

		if ( isset( self::$classes_map[ $relative_class_name ] ) ) {
			$filename = ELANTA_BUILDER_PATH . self::$classes_map[ $relative_class_name ];
		} else {

			$filename = strtolower(
				preg_replace(
					array( '/([a-z])([A-Z])/', '/_/', '/\\\/' ),
					array(
						'$1-$2',
						'-',
						DIRECTORY_SEPARATOR,
					),
					$relative_class_name
				)
			);

			$filename = ELANTA_BUILDER_PATH . $filename . '.php';

		}

		$filename = strtolower( $filename );

		if ( is_readable( $filename ) ) {
			require $filename;
		}
	}

	/**
	 * Spl autoload.
	 *
	 * @static
	 *
	 * @param string $class Class name.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected static function autoload( $class ) {
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

$loader = new Autoloader();
$loader->init();
