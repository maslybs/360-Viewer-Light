<?php
/**
 *
 * Init Elementor page builder.
 *
 * @package ElantaBuilder
 */

namespace ElantaBuilder;

use Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Init class.
 */
class InitElementor {

	/**
	 * Elementor constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {

		add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
	}

	/**
	 * Require and instantiate Elementor Widgets.
	 *
	 * @param $widgets_manager
	 */
	public function widgets_registered( $widgets_manager ) {

		// We check if the Elementor plugin has been installed / activated.
		if ( defined( 'ELEMENTOR_PATH' ) && class_exists( 'Elementor\Widget_Base' ) ) {

			$file = ELANTA_BUILDER_PATH . 'elementor/widget.php';

			if ( file_exists( $file ) && is_readable( $file ) ) {
				include_once $file;

				$widget = new Elementor\ElantaBuilder_Widget();
				$widgets_manager->register_widget_type( $widget );

			}

		}

	}
}
