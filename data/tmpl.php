<?php
/**
 * User: elanta https://codecanyon.net/user/elanta/portfolio
 * Date: 27.12.2018
 * Type: wpbakery
 *
 * @package ELANTA_VIEWER/Params
 * $atts - here all params of plugin.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

$atts = apply_filters( 'elanta_viewer_init_atts', $atts );

$atts['container_id'] = uniqid();


$atts['panorama'] = elanta_viewer_get_image_url( $atts, 'panorama' );

if ( ! empty( $atts['show_loading_img'] ) && ! empty( $atts['loading_img_file'] ) ) {
	$atts['loading_img'] = elanta_viewer_get_image_url( $atts, 'loading_img_file', 'thumbnail', '' );
}


if ( empty( $atts['display_caption'] ) && isset( $atts['caption'] ) ) {
	unset( $atts['caption'] );
}

// Set height.
$atts['size']['height'] = elanta_viewer_get_range_value( $atts, 'height', '500' );
unset( $atts['height'] );

if ( empty( $atts['time_anim'] ) ) {
	$atts['time_anim'] = false;
}

// Set anim_speed.
$atts['anim_speed'] = elanta_viewer_get_range_value(
	$atts,
	'anim_speed',
	'1rpm',
	'rpm'
);


if ( ! empty( $atts['default_fov'] ) ) {

	if ( ! empty( $atts['default_fov']['size'] ) ) {
		$atts['default_fov'] = $atts['default_fov']['size'];
	}
} else {
	$atts['default_fov'] = 55;
}

$atts['min_fov'] = 10;
$atts['max_fov'] = 90;
if ( ! empty( $atts['default_fov'] ) && is_numeric( $atts['default_fov'] ) ) {
	$atts['default_fov'] = 100 - $atts['default_fov'];
} else {
	unset( $atts['default_fov'] );
}

/* For lang param */
$default_labels = array(
	'label_markers'    => '',
	'label_zoom'       => '',
	'label_zoomOut'    => '',
	'label_zoomIn'     => '',
	'label_download'   => '',
	'label_fullscreen' => '',
	'label_autorotate' => '',
);
$translate      = array_intersect_key( $atts, $default_labels );
$langs          = array_merge( $default_labels, $translate );

foreach ( $langs as $key => $lang ) {
	$key_r = explode( '_', $key );
	if ( ! empty( $lang ) ) {
		$atts['lang'][ $key_r[1] ] = $lang;
	}
}

if ( empty( $atts['enable_marker'] ) ) {
	unset( $atts['markers'] );
} else {
	if ( ! empty( $atts['markers'] ) ) {

		if ( ! is_array( $atts['markers'] ) ) {
			$atts['markers'] = json_decode(
				urldecode( $atts['markers'] ),
				true
			);
		}

		if ( is_array( $atts['markers'] ) ) {

			foreach ( $atts['markers'] as $key => $marker ) {

				$atts['markers'][ $key ]['id'] = 'ps_el_' . $atts['container_id'] . '_marker_' . $key;

				if ( empty( $marker['longitude'] ) ) {
					$atts['markers'][ $key ]['longitude'] = 0;
				}
				if ( empty( $marker['latitude'] ) ) {
					$atts['markers'][ $key ]['latitude'] = 0;
				}

				if ( ! empty( $marker['content'] ) ) {
					$content = apply_filters(
						'widget_text_content',
						$marker['content']
					);

					$atts['markers'][ $key ]['content'] = base64_encode( stripcslashes( urldecode( $content ) ) );
				}

				if ( empty( $marker['width'] ) ) {
					$atts['markers'][ $key ]['width'] = '32';
				}
				if ( empty( $marker['height'] ) ) {
					$atts['markers'][ $key ]['height'] = '32';
				}

				if ( empty( $marker['type_marker'] ) ) {
					$marker['type_marker'] = 'image';
				}

				if ( 'html' === $marker['type_marker'] ) {

					$template = 'default';
					if ( ! empty( $marker['template'] ) && 'custom' !== $marker['template'] ) {
						$template = $marker['template'];
					}
					$marker['product_id'] = $marker['post_id'];

					ob_start();
					$product_template = ELANTA_BUILDER_DATA . 'templates/product-' . esc_attr( $template ) . '.php';
					require apply_filters( 'elanta_viewer_marker_template', $product_template, $marker );
					$html = ob_get_clean();


					$html                            = apply_filters( 'widget_text_content', $html );
					$atts['markers'][ $key ]['html'] = base64_encode( stripcslashes( urldecode( $html ) ) );


					if ( empty( $marker['width'] ) ) {
						$atts['markers'][ $key ]['width'] = '100';
					}
					if ( empty( $marker['height'] ) ) {
						$atts['markers'][ $key ]['height'] = '50';
					}
					if ( empty( $atts['markers'][ $key ]['html'] ) ) {
						$atts['markers'][ $key ]['html'] = 'text marker';
					}

					unset( $atts['markers'][ $key ]['circle'] );
					unset( $atts['markers'][ $key ]['image'] );

				} elseif ( 'product' === $marker['type_marker'] && ! empty( $marker['product_id'] ) ) {

					$template = 'default';
					if ( ! empty( $marker['template'] ) && 'custom' !== $marker['template'] ) {
						$template = $marker['template'];
					}
					ob_start();
					$product_template = ELANTA_BUILDER_DATA . 'templates/product-' . esc_attr( $template ) . '.php';
					require apply_filters( 'elanta_viewer_marker_template', $product_template, $marker );
					$html = ob_get_clean();

					$atts['markers'][ $key ]['html'] = trim( base64_encode( stripcslashes( urldecode( $html ) ) ) );

					unset( $atts['markers'][ $key ]['circle'] );
					unset( $atts['markers'][ $key ]['image'] );

				} elseif ( 'circle' === $marker['type_marker'] ) {

					if ( empty( $marker['circle'] ) ) {
						$atts['markers'][ $key ]['circle'] = 20;
					}

					if ( empty( $marker['fill'] ) ) {
						$atts['markers'][ $key ]['svgStyle']['fill'] = 'rgba(0, 0, 0, 0.5)';
					} else {
						$atts['markers'][ $key ]['svgStyle']['fill'] = $marker['fill'];
					}

					unset( $atts['markers'][ $key ]['html'] );
					unset( $atts['markers'][ $key ]['image'] );

				} else {

					if ( ! empty( $marker['image']['url'] ) ) {
						$atts['markers'][ $key ]['image'] = $marker['image']['url'];
					} elseif ( ! empty( $marker['image'] ) && is_numeric( $marker['image'] ) ) {
						$atts['markers'][ $key ]['image'] = wp_get_attachment_image_url( $marker['image'] );
					} else {
						unset( $atts['markers'][ $key ] );
						continue;
					}

					unset( $atts['markers'][ $key ]['html'] );
					unset( $atts['markers'][ $key ]['circle'] );

				}

				if ( ! empty( $marker['marker_action_url'] ) && is_string( $marker['marker_action_url'] ) && function_exists( 'vc_build_link' ) ) {
					$atts['markers'][ $key ]['marker_action_url'] = vc_build_link( $marker['marker_action_url'] );
				}

				if ( 'product' === $marker['marker_action'] && ! empty( $marker['product_id'] ) ) {
					$atts['markers'][ $key ]['marker_action_url']['is_external'] = 'on';
					$atts['markers'][ $key ]['marker_action_url']['target']      = true;
					$atts['markers'][ $key ]['marker_action_url']['url']         = get_the_permalink( $marker['product_id'] );
				}


				if ( empty( $marker['marker_action'] ) && ( 'url' === $marker['marker_action'] || 'hotspot' === $marker['marker_action'] || 'product' === $marker['marker_action'] ) ) {
					$atts['markers'][ $key ]['content'] = '';
				}
			}
		}
	}
}

/* For navbar param */
$some_navbars = array(
	'zoom'       => '',
	'autorotate' => '',
	'download'   => '',
	'fullscreen' => '',
);
if ( ! empty( $atts['navbar_enable'] ) ) {

	$navbar         = array_intersect_key( $atts, $some_navbars );
	$atts['navbar'] = array_keys(
		array_filter(
			wp_parse_args(
				$navbar,
				$some_navbars
			)
		)
	);

	if ( ! empty( $atts['display_markers'] ) ) {
		$atts['navbar'][] = 'markers';
	}
	if ( ! empty( $atts['display_caption'] ) ) {
		$atts['navbar'][] = 'caption';
	} else {
		$atts['caption'] = false;
	}

	if ( ! empty( $atts['display_gyroscope'] ) ) {
		$atts['navbar'][] = 'gyroscope';
	}

	unset( $atts['display_markers'] );
	unset( $atts['display_caption'] );
	unset( $atts['navbar_enable'] );
} else {
	$atts['navbar']  = false;
	$atts['caption'] = false;
}


$atts = elanta_viewer_convert_bool( $atts );

$bool_params = array(
	'as_bg',
	'mousewheel',
	'mousemove_hover',
	'enable_overlay',
	'enable_marker',
	'navbar_enable',
	'autorotate',
	'zoom',
	'download',
	'fullscreen',
	'display_markers',
	'display_gyroscope',
	'display_caption',
	'enable_cropped',
);

foreach ( $bool_params as $bool_param ) {
	if ( empty( $atts[ $bool_param ] ) ) {
		$atts[ $bool_param ] = false;
	}
}


$class_container = 'ps-el-viewer';
if ( ! empty( $atts['as_bg'] ) ) {
	$class_container .= ' bg';
}


$overlay = array(
	'enable_overlay'  => '',
	'overlay_color'   => '',
	'overlay_image'   => '',
	'overlay_opacity' => '',
	'overlay_blend'   => '',
);

$overlay_show = false;

$css_overlay = '';
if ( ! empty( $atts['enable_overlay'] ) ) {

	$overlay_show = true;

	$css_overlay = array(
		'position:absolute',
		'top:0',
		'left:0',
		'width:100%',
		'height:100%',
		'z-index:1',
	);

	if ( ! empty( $atts['overlay_color'] ) ) {
		$css_overlay[] = 'background-color:' . $atts['overlay_color'];
	} else {
		$css_overlay[] = 'background-color:#000';
	}

	if ( ! empty( $atts['overlay_image'] ) ) {
		$css_overlay[] = 'background-image:url(' . elanta_viewer_get_image_url( $atts, 'overlay_image' ) . ')';
	}
	// Set overlay opacity.
	$css_overlay[] = 'opacity:' . elanta_viewer_get_range_value( $atts, 'overlay_opacity', '.6' ) . ';';


	if ( ! empty( $atts['overlay_blend'] ) ) {
		$css_overlay[] = 'mix-blend-mode:' . $atts['overlay_blend'];
	}

	$css_overlay = '#ps_el_' . esc_attr( $atts['container_id'] ) . '_overlay 
	{' . trim( implode( ';', $css_overlay ) ) . '}';
}

/* Filters */
$filter_css = '';
if ( ! empty( $atts['filter'] ) ) {

	if ( ! empty( $atts['filter_value'] ) && is_numeric( $atts['filter_value'] ) ) {
		$atts['filter_value'] = array( 'size' => $atts['filter_value'] );
	}

	if ( empty( $atts['filter_value']['size'] ) ) {
		$atts['filter_value']['size'] = 360;
	}

	if ( 'blur' === $atts['filter'] ) {
		$atts['filter_value']['size'] = ( $atts['filter_value']['size'] / 3.6 ) . 'px';
	}

	if ( 'hue-rotate' === $atts['filter'] ) {
		$atts['filter_value']['size'] .= 'deg';
	}

	if ( 'saturate' === $atts['filter'] ) {
		$atts['filter_value']['size'] = ( $atts['filter_value']['size'] / 3.6 );
	}

	if ( 'invert' === $atts['filter'] || 'opacity' === $atts['filter'] || 'grayscale' === $atts['filter'] || 'sepia' === $atts['filter']
	) {
		$atts['filter_value']['size'] = ( $atts['filter_value']['size'] / 360 );
	}

	if ( 'brightness' === $atts['filter'] ) {
		$atts['filter_value']['size'] = ( $atts['filter_value']['size'] / 100 );
	}


	$filter_css = '
			#ps_el_' . esc_attr( $atts['container_id'] ) . ' .psv-canvas-container{
				-webkit-filter: ' . esc_attr( $atts['filter'] ) . '(' . esc_attr( $atts['filter_value']['size'] ) . ');
				filter: ' . esc_attr( $atts['filter'] ) . '(' . esc_attr( $atts['filter_value']['size'] ) . ');
			}
		';

	unset( $atts['filter'] );
	unset( $atts['filter_value'] );
}

if ( ! empty( $atts['enable_cropped'] ) ) {

	$cropped = array(
		'full_width'     => '',
		'full_height'    => '',
		'cropped_width'  => '',
		'cropped_height' => '',
		'cropped_x'      => '',
		'cropped_y'      => '',
	);

	$atts['pano_data'] = array_intersect_key( $atts, $cropped );

	foreach ( $cropped as $key => $item ) {
		unset( $atts[ $key ] );
	}
}

$tooltips_css = '';
if ( ! empty( $atts['style_tooltips'] ) ) {

	if ( 'white' === $atts['style_tooltips'] ) {

		$color_text = '#000';
		$color_bg   = '#fff';

	} elseif ( 'black' === $atts['style_tooltips'] ) {

		$color_text = '#fff';
		$color_bg   = '#000';
	}

	if ( ! empty( $color_text ) && ! empty( $color_bg ) ) {

		$tooltips_css = "
			.psv-tooltip{
				background-color: $color_bg; 
			}
			.psv-tooltip--top-center{
			    -webkit-box-shadow: none;
                box-shadow: none;
			}
			.psv-tooltip .psv-tooltip-arrow,
			.psv-tooltip--top-center .psv-tooltip-arrow{
				border-top-color: $color_bg; 
			}
			.psv-tooltip .psv-tooltip-content{
				color: $color_text; 
			    text-shadow: 0 1px $color_text;
			}
		";
	}
}

echo '<style>';
echo esc_html( $css_overlay );
echo esc_html( $filter_css );
echo esc_html( $tooltips_css );
echo '</style>';

$atts            = array_diff_key( $atts, $default_labels, $some_navbars, $overlay );
$atts            = apply_filters( 'elanta_viewer_before_render_atts', $atts );
$class_container = apply_filters( 'elanta_viewer_class_wrapper', $class_container );

?>
<div id="ps_el_<?php echo esc_attr( $atts['container_id'] ); ?>" class="<?php echo esc_attr( $class_container ); ?>"
     data-ps-params="<?php echo esc_attr( json_encode( $atts ) ); ?>">

	<?php
	if ( $overlay_show ) {
		echo '<div id="ps_el_' . esc_attr( $atts['container_id'] ) . '_overlay"></div>';
	}
	?>

</div>

