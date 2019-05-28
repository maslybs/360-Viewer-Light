<?php

namespace ElantaBuilder;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


/**
 * Converter of params.
 */
class Converter {

	/**
	 * Converter constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {

	}

	/**
	 * @param        $value_param
	 * @param        $replace_to
	 * @param array  $all_params
	 * @param string $param_wrap
	 *
	 * @return array|bool
	 */
	private function conditionals( $value_param, $replace_to, $all_params = array(), $param_wrap = '' ) {


		if ( ! empty( $value_param['element'] ) ) {


			$val = ! empty( $value_param['value'] ) ? $value_param['value'] : '';

			if ( 'elementor' !== $replace_to ) {

				if ( is_array( $val ) && empty( $val[0] ) ) {
					$value_param['value'] = '';
				}

				if ( ! empty( $value_param['not_empty'] ) ) {
					$value_param['element'] .= '!';
					$val                    = '';
				}
			}

			$conditionals = array( $value_param['element'] => $val );

			return $conditionals;

		} else {
			return false;
		}
	}


	/**
	 * @param        $all_params
	 * @param        $compatibility
	 * @param string $replace_to
	 *
	 * @return array
	 *
	 */
	private function converter( $all_params, $compatibility, $replace_to = '' ) {

		$result = array();

		// each all params
		foreach ( $all_params as $index => $param ) {

			if ( ! is_array( $param ) ) {
				continue;
			}

			// each properties
			foreach ( $param as $old_key => $value_param ) { // $value

				// not exist in pattern
				if ( empty( $compatibility[ $old_key ] ) ) {
					continue;
				}

				$new_key = $compatibility[ $old_key ];

				// replace keys and types
				if ( is_array( $new_key ) ) {

					// types
					if ( isset( $new_key[ $value_param ] ) ) {
						$result[ $index ][ $old_key ] = $new_key[ $value_param ];
					} else {
						unset( $result[ $index ][ $old_key ] );
					}

				} else {

					$result[ $index ][ $new_key ] = $value_param;

					// for cornerstone UI param
					if ( strpos( $new_key, '/' ) !== false ) {
						$ui                                   = explode( '/', $new_key );
						$result[ $index ][ $ui[0] ][ $ui[1] ] = $value_param;
					}

				}

				// sub params (repeater)
				if ( $old_key == 'params' && is_array( $value_param ) ) {
					$result[ $index ][ $new_key ] = $this->converter( $value_param, $compatibility, $replace_to );
				}

				// for condition
				if ( $old_key == 'dependency' ) {

					$conditionals = $this->conditionals( $value_param, $replace_to, $all_params, $param );

					if ( ! empty( $conditionals ) ) {
						$result[ $index ][ $new_key ] = $conditionals;
					} else {
						unset( $result[ $index ][ $new_key ] );
					}

				}

				// for select
				if ( in_array( $old_key, array( 'value' ) ) && is_array( $value_param ) ) {
					$value_param = array_map( 'trim', $value_param );

					$result[ $index ][ $new_key ] = array_flip( $value_param );

				}

			}

		}

		return apply_filters( 'converter_results', $result, $replace_to );
	}


	/**
	 * @param array  $all_params
	 * @param string $slug
	 *
	 * @return array
	 */
	public function convert_params( $all_params = array(), $type_from = '', $replace_to = '' ) {

		if ( $type_from == $replace_to ) {
			return $all_params;
		}

		$file = ELANTA_BUILDER_PATH . $replace_to . '/compatibility.php';

		$compatibility_params = array();
		if ( file_exists( $file ) && is_readable( $file ) ) {
			$compatibility_params = require $file;
		}

		return $this->converter( $all_params, $compatibility_params, $replace_to );

	}

	public function get_name( $params = null, $type_from = null ) {

		if ( $type_from == 'wpbakery' && ! empty( $params['name'] ) ) {
			return $params['name'];
		}

		return '';
	}

	public function get_slug( $params = null, $type_from = null ) {
		if ( $type_from == 'wpbakery' && ! empty( $params['base'] ) ) {
			$suf = '';
			if ( ! empty( $params['suf'] ) ) {
				$suf = $params['suf'];
			}

			return $params['base'] . $suf;
		}

		return '';
	}

}
