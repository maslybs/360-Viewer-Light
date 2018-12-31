<?php

namespace Elementor;

use DadBuilders;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class DadBuilders_Widget extends Widget_Base {

	/**
	 * @return DadBuilders\Loader
	 */
	private function loader() {
		return new DadBuilders\Loader( 'wpbakery', 'elementor' );
	}

	/**
	 * @return string
	 */
	public function get_name() {
		return $this->loader()->getSlug();
	}

	/**
	 * @return string|void
	 */
	public function get_title() {
		return $this->loader()->getName();
	}

	/**
	 * @return string
	 */
	public function get_icon() {
		return 'fa fa-globe';
	}

	protected function _register_controls() {

		$params = $this->loader()->getParams();

		$result_params = array();
		foreach ( $params as $param ) {
			$result_params[ $param['group'] ][] = $param;
		}

		foreach ( $result_params as $key => $param ) {



			$this->start_controls_section( $key, [
				'label' => $key,
			] );

			if ( ! empty( $param ) && is_array( $param ) ) {
				foreach ( $param as  $sub_key => $subparam ) {

					if ( $subparam['type'] == 'repeater' ) {
						$fields = $subparam['fields'];
						foreach ( $fields as $key => $field ) {

							if ( $field['type'] == 'slider' ) {

								$fields[ $key ]['range'] = array(
									'px' => array(
										'min' => 0,
										'max' => 20,
									),
								);

								$subparam['fields'] = $fields;
							}
						}

					}

					$this->add_control( $subparam['name'], $subparam );
				}
			}

			$this->end_controls_section();
		}

	}

	protected function render() {

		$atts = $this->get_settings();

		$atts = array_filter( $atts, function ( $e ) {
			return ! empty( $e );
		} );

		$atts = array_filter( $atts, function ( $key ) {
			return substr( $key, 0, 1 ) !== '_';
		}, ARRAY_FILTER_USE_KEY );

		include $this->loader()->getTmplFile();

	}

}