<?php

namespace ElantaBuilder;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Parse class.
 */
class Parse {

	/**
	 * Get params from file.
	 *
	 * @param null $args All params.
	 * @return null
	 */
	public static function parse( $args = null ) {

		if ( ! $args['file'] ) {
			return null;
		}

		$file = apply_filters(
			'elantabuilder/parse/path',
			$args['file']
		);

		if ( $file && file_exists( $file ) && is_readable( $file ) ) {

			$file_content = include( $file );

			if ( 'vc' === $args['type'] && ! empty( $file_content['params'] ) ) {
				return $file_content['params'];
			}

			return $file_content;

		}

		return null;

	}

	/**
	 * Parse constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {

	}
}
