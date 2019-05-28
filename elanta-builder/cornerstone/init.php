<?php

namespace ElantaBuilder;

if ( ! defined( 'WPINC' ) ) {
	exit; // Exit if accessed directly.
}

class initCornerstone {

	/**
	 * Cornerstone constructor.
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {

		add_action( 'cornerstone_register_elements', array( &$this, 'register_elements' ) );
		add_filter( 'converter_results', array( &$this, 'select_value_params' ), 100 );
		add_filter( 'cornerstone_icon_map', array( &$this, 'addons_cs_icon_map' ) );
	}

	/**
	 * @return ElantaBuilder\Loader
	 */
	private function loader() {
		return new Loader( 'wpbakery', 'cornerstone' );
	}

	public function register_elements() {

		// We check if the Cornerstone plugin has been installed / activated.
		if ( function_exists( 'cornerstone_plugin_init' ) ) {
			if ( is_dir( ELANTA_BUILDER_PATH . 'cornerstone/shortcode' ) ) {
				cornerstone_register_element( 'ElantaBuilder_Shortcode', $this->loader()->getSlug(), ELANTA_BUILDER_PATH . 'cornerstone/shortcode' );
			}

		}
	}

	public function select_value_params( $value_param ) {
		foreach ( $value_param as &$param ) {
			if ( ! empty( $param['type'] ) && 'select' == $param['type'] ) {
				$options = $param['options'];
				unset( $param['options'] );

				foreach ( $options as $key => $option ) {
					$param['options']['choices'][] = array( 'value' => $key, 'label' => $option );
				}
			}
		}

		return $value_param;
	}

	public function addons_cs_icon_map( $icon_map ) {
		$icon_map['elenta-icons'] = PANORAMAVIEWER_URL . 'data/assets/svg/icons.svg';

		return $icon_map;
	}
}
