<?php

namespace ElantaBuilder;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class InitWpbakery {

	/**
	 * Wpbakery constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {

		add_action( 'admin_init', array( &$this, 'init' ), 100 );
		add_action( 'wp', array( &$this, 'init' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) );

	}

	public function init() {

		if ( ! function_exists( 'vc_add_shortcode_param' ) ) {
			return;
		}

		$file = ELANTA_BUILDER_PATH . 'wpbakery/widget.php';
		if ( file_exists( $file ) && is_readable( $file ) ) {
			include_once $file;
		}

		vc_add_shortcode_param( 'slider', array(
			&$this,
			'slider',
		), ELANTA_BUILDER_DATA_URL . '/assets/admin/js/slider.js' );

		vc_add_shortcode_param( '_', function () {
		}, ELANTA_BUILDER_DATA_URL . '/assets/admin/js/featherlight.js' );

		vc_add_shortcode_param( '_2', function () {
		}, ELANTA_BUILDER_DATA_URL . '/assets/admin/js/admin-data.js' );

	}

	public function admin_enqueue_scripts() {
		wp_enqueue_script( 'jquery' );                    // Enque jQuery
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-slider' );

		wp_enqueue_style( 'plugin_name-admin-ui-css', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css', false, '1.0.0', false );
	}

	public function slider( $settings, $value ) {

		return '<style>.slider-group{ display: flex;}.slider-group .vc-slider{justify-content: center;align-self: center;width: 80%; margin-right: 10px;}.vc_edit_form_elements .slider-group input{width: 20%;}</style><div class="slider-group">' . '<div class="vc-slider" data-params="' . esc_attr( json_encode( $settings ) ) . '"></div>' . '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value dad-slider ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="text" value="' . $value . '"/>' . '</div>';
	}

}
