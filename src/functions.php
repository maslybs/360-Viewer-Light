<?php
/**
 * User: elanta https://codecanyon.net/user/elanta/portfolio
 * Date: 27.12.2018
 *
 * @package PVIEWER/Functions
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! function_exists( 'panorama_dropdown' ) ) {
	/**
	 * Return array of posts for dropdown.
	 *
	 * @param string $post_type  Custom post type.
	 * @param int    $limit      Post per page.
	 * @param bool   $show_first Show or not placeholder.
	 *
	 * @return array
	 */
	function panorama_dropdown( $post_type = 'post', $limit = 100, $show_first = false ) {

		// Get posts.
		$posts = get_posts(
			array(
				'post_type'      => $post_type,
				'posts_per_page' => $limit,
				'orderby'        => 'date',
				'order'          => 'DESC',
			)
		);

		$options = array();

		if ( empty( $posts ) || ! is_array( $posts ) ) {
			return $options;
		}

		if ( $show_first ) {
			$options[ __( 'Select ', '360-viewer-light' ) . $post_type ] = '';
		}
		foreach ( $posts as $post ) {
			$options[ esc_html( $post->post_title ) ] = esc_html( $post->ID );
		}

		return $options;
	}
}

if ( ! function_exists( 'panorama_get_image_url' ) ) {
	/**
	 * Gets image url.
	 *
	 * @param array  $param   Param with url.
	 * @param string $key     Key of param.
	 * @param string $size    Size of image.
	 * @param string $default Default value.
	 *
	 * @return false|string
	 */
	function panorama_get_image_url( $param, $key, $size = 'full', $default = '' ) {
		if ( ! empty( $param[ $key ] ) ) {
			if ( ! empty( $param[ $key ]['url'] ) ) {
				$param = $param[ $key ]['url'];
			} else {
				$param = wp_get_attachment_image_url( $param[ $key ], $size );
			}

			return $param;
		}

		return $default;
	}
}


if ( ! function_exists( 'panorama_get_range_value' ) ) {
	/**
	 * Get value from range field.
	 *
	 * @param array  $param   Param of Range.
	 * @param string $key     Key pf param.
	 * @param string $default Default value.
	 * @param string $type    Units.
	 *
	 * @return string
	 */
	function panorama_get_range_value( $param, $key, $default = '', $type = '' ) {

		if ( empty( $param[ $key ] ) ) {
			return $default;
		}

		if ( is_array( $param[ $key ] ) && ! empty( $param[ $key ]['size'] ) ) {
			$param = $param[ $key ]['size'] . $type;
		} elseif ( is_numeric( $param[ $key ] ) ) {
			$param = $param[ $key ] . $type;
		} else {
			$param = $default;
		}

		return $param;
	}
}

if ( ! function_exists( 'panorama_convert_bool' ) ) {

	/**
	 * The function converts all params with "yes" or "no" to boolean.
	 *
	 * @param array $atts All attributes.
	 *
	 * @return array
	 */
	function panorama_convert_bool( $atts ) {

		if ( ! is_array( $atts ) ) {
			return $atts;
		}

		return array_map(
			function ( $val ) {

				if ( 'yes' === $val ) {
					return 'true';
				}
				if ( 'no' === $val ) {
					return 'false';
				}

				return $val;
			},
			$atts );

	}
}
