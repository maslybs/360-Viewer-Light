<?php
/**
 * User: elanta https://codecanyon.net/user/elanta/portfolio
 * Date: 27.12.2018
 * Type: wpbakery
 *
 * @package ELANTA_VIEWER/Params
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

return array(
	'name'        => esc_html__( '360 Viewer Light', 'elanta-viewer-light' ),
	'description' => esc_html__( 'Photo sphere viewer and the beautiful background for Elementor', 'elanta-viewer-light' ),
	'base'        => 'photo_panorama_el',
	'icon'        => 'photo-panorama-el_icon',
	'category'    => esc_html__( 'Content', 'elanta-viewer-light' ),
	'params'      => array_merge(
		apply_filters( 'elenta_viewer_before_params', array() ),
		array(

			/* General */
			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__( 'Upload Panorama Image', 'elanta-viewer-light' ),
				'param_name' => 'panorama',
				'group'      => esc_html__( 'General', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Height', 'elanta-viewer-light' ),
				'param_name' => 'type_height',
				'value'      => array(
					esc_html__( 'Custom Height', 'creamaps' )          => 'default',
					esc_html__( 'Full height of section', 'creamaps' ) => 'fullheight',
				),
				'group'      => esc_html__( 'General', 'elanta-viewer-light' ),
			),
			array(
				'type'        => 'slider',
				'heading'     => esc_html__( 'Custom Height', 'elanta-viewer-light' ),
				'param_name'  => 'height',
				'range'       => [
					'px' => [
						'min' => 50,
						'max' => 800,
					],
				],
				'value'       => '0',
				'description' => esc_html__( 'example: 500', 'elanta-viewer-light' ),
				'dependency'  => array(
					'element' => 'type_height',
					'value'   => array( 'default' ),
				),
				'group'       => esc_html__( 'General', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Panorama as background', 'elanta-viewer-light' ),
				'param_name' => 'as_bg',
				'group'      => esc_html__( 'General', 'elanta-viewer-light' ),
			),

			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Mousewheel', 'elanta-viewer-light' ),
				'param_name' => 'mousewheel',
				'value'      => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
				'group'      => esc_html__( 'General', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Mousemove', 'elanta-viewer-light' ),
				'param_name' => 'mousemove',
				'value'      => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
				'group'      => esc_html__( 'General', 'elanta-viewer-light' ),
				'std'        => 'yes',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Mousemove Hover', 'elanta-viewer-light' ),
				'param_name' => 'mousemove_hover',
				'value'      => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
				'dependency' => array(
					'element' => 'mousemove',
					'value'   => array( 'yes' ),
				),
				'group'      => esc_html__( 'General', 'elanta-viewer-light' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'AutoRotate on Start', 'elanta-viewer-light' ),
				'param_name'  => 'time_anim',
				'value'       => '',
				'description' => esc_html__( '(msec) If set to 0, auto-rotation will be disabled on start', 'elanta-viewer-light' ),
				'group'       => esc_html__( 'General', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'slider',
				'heading'    => esc_html__( 'Rotate speed', 'elanta-viewer-light' ),
				'param_name' => 'anim_speed',
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 10,
						'step' => 0.2,
					],
				],
				'group'      => esc_html__( 'General', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Blend mode', 'elanta-viewer-light' ),
				'param_name' => 'filter',
				'value'      => array(
					esc_html__( 'None', 'elanta-viewer-light' )       => '',
					esc_html__( 'Blur', 'elanta-viewer-light' )       => 'blur',
					esc_html__( 'Brightness', 'elanta-viewer-light' ) => 'brightness',
					esc_html__( 'Contrast', 'elanta-viewer-light' )   => 'contrast',
					esc_html__( 'Grayscale', 'elanta-viewer-light' )  => 'grayscale',
					esc_html__( 'Hue-rotate', 'elanta-viewer-light' ) => 'hue-rotate',
					esc_html__( 'Invert', 'elanta-viewer-light' )     => 'invert',
					esc_html__( 'Opacity', 'elanta-viewer-light' )    => 'opacity',
					esc_html__( 'Saturate', 'elanta-viewer-light' )   => 'saturate',
					esc_html__( 'Sepia', 'elanta-viewer-light' )      => 'sepia',
				),
				'group'      => esc_html__( 'General', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'slider',
				'heading'    => esc_html__( 'Filter value', 'elanta-viewer-light' ),
				'param_name' => 'filter_value',
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 360,
						'step' => 1,
					],
				],
				'value'      => '1',
				'dependency' => array(
					'element' => 'filter',
					'value'   => array(
						'blur',
						'brightness',
						'contrast',
						'grayscale',
						'hue-rotate',
						'invert',
						'opacity',
						'saturate',
						'sepia',
					),
				),
				'group'      => esc_html__( 'General', 'elanta-viewer-light' ),
			),
			array(
				'type'        => 'slider',
				'heading'     => esc_html__( 'Zoom', 'elanta-viewer-light' ),
				'param_name'  => 'default_fov',
				'value'       => '45',
				'range'       => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
				],
				'group'       => esc_html__( 'General', 'elanta-viewer-light' ),
				'description' => esc_html__( 'It sets zoom of image by default.', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Loading text', 'elanta-viewer-light' ),
				'param_name' => 'loading_txt',
				'std'        => 'Loading...',
				'group'      => esc_html__( 'General', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Show loading image', 'elanta-viewer-light' ),
				'param_name' => 'show_loading_img',
				'group'      => esc_html__( 'General', 'elanta-viewer-light' ),
				'value'      => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
			),
			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__( 'Loading image', 'elanta-viewer-light' ),
				'param_name' => 'loading_img_file',
				'group'      => esc_html__( 'General', 'elanta-viewer-light' ),
				'dependency' => array(
					'element' => 'show_loading_img',
					'value'   => array( 'yes' ),
				),
			),


			/* Markers */
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Enable markers ', 'elanta-viewer-light' ),
				'param_name' => 'enable_marker',
				'group'      => esc_html__( 'Markers', 'elanta-viewer-light' ),
				'value'      => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
			),
			array(
				'type'       => 'param_group',
				'heading'    => esc_html__( 'Markers', 'elanta-viewer-light' ),
				'param_name' => 'markers',
				'group'      => 'Markers',
				'dependency' => array(
					'element' => 'enable_marker',
					'value'   => array( 'yes' ),
				),
				'params'     => array(
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'Marker Type', 'elanta-viewer-light' ),
						'param_name'  => 'type_marker',
						'value'       => array(
							esc_html__( 'Default (image)', 'elanta-viewer-light' ) => 'false',
							esc_html__( 'Circle', 'elanta-viewer-light' )          => 'circle',
							esc_html__( 'Post', 'elanta-viewer-light' )            => 'html',
							esc_html__( 'Product', 'elanta-viewer-light' )         => 'product',
						),
						'description' => esc_html__( 'Notice! Post and Product types support a custom template', 'elanta-viewer-light' ),
					),

					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Marker Action', 'elanta-viewer-light' ),
						'param_name' => 'marker_action',
						'value'      => array(
							esc_html__( 'Default (open modal)', 'elanta-viewer-light' )    => 'false',
							esc_html__( 'Custom URL', 'elanta-viewer-light' )              => 'url',
							esc_html__( 'Go to product (inherit)', 'elanta-viewer-light' ) => 'product',
						),
					),

					array(
						'type'       => 'vc_link',
						'heading'    => esc_html__( 'Marker Custom URL', 'elanta-viewer-light' ),
						'param_name' => 'marker_action_url',
						'value'      => '',
						'dependency' => array(
							'element' => 'marker_action',
							'value'   => array( 'url' ),
						),
					),

					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Circle Radius', 'elanta-viewer-light' ),
						'param_name'  => 'circle',
						'value'       => '20',
						'description' => esc_html__( 'example: 20', 'elanta-viewer-light' ),
						'dependency'  => array(
							'element' => 'type_marker',
							'value'   => array( 'circle' ),
						),
					),

					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__( 'Circle Color', 'elanta-viewer-light' ),
						'param_name' => 'fill',
						'dependency' => array(
							'element' => 'type_marker',
							'value'   => array( 'circle' ),
						),
					),

					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'Select Post', 'elanta-viewer-light' ),
						'param_name'  => 'post_id',
						'value'       => elanta_viewer_dropdown( 'post', 100, true ),
						'std'         => esc_html__( 'Select post', 'elanta-viewer-light' ),
						'dependency'  => array(
							'element' => 'type_marker',
							'value'   => array( 'html' ),
						),
						'description' => esc_html__( 'Select post which you want to show instead of the marker.', 'elanta-viewer-light' ),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'Select Product', 'elanta-viewer-light' ),
						'param_name'  => 'product_id',
						'value'       => elanta_viewer_dropdown( 'product', 100, true ),
						'std'         => esc_html__( 'Select product', 'elanta-viewer-light' ),
						'dependency'  => array(
							'element' => 'type_marker',
							'value'   => array( 'product' ),
						),
						'description' => esc_html__( 'Select product which you want to show instead of the marker.', 'elanta-viewer-light' ),
					),
					array(
						'type'       => 'attach_image',
						'class'      => '',
						'heading'    => esc_html__( 'Upload Image Marker', 'elanta-viewer-light' ),
						'param_name' => 'image',
						'dependency' => array(
							'element' => 'type_marker',
							'value'   => array('false'),
						),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Add Marker Coordinates', 'elanta-viewer-light' ),
						'param_name'  => 'add_coordinate',
						'std'         => 'Please click here',
						'value'       => '',
						'dependency'  => array(
							'element' => 'type_marker',
							'value'   => array( 'false', 'html', 'product', 'circle' ),
						),
						'description' => esc_html__( 'Marker coordinates on the image. Don’t forget to fill  Show in Scene param. Otherwise, you can add the marker to the first scene only.', 'elanta-viewer-light' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Custom Tooltip', 'elanta-viewer-light' ),
						'param_name'  => 'tooltip',
						'dependency'  => array(
							'element' => 'type_marker',
							'value'   => array( 'false', 'html', 'product', 'circle' ),
						),
						'description' => esc_html__( 'Tooltip appears when hovering cursor.', 'elanta-viewer-light' ),
					),
					array(
						'type'        => 'textarea',
						'heading'     => esc_html__( 'Content', 'elanta-viewer-light' ),
						'param_name'  => 'content',
						'admin_label' => true,
						'dependency'  => array(
							'element' => 'marker_action',
							'value'   => array( 'false' ),
						),
						'description' => esc_html__( 'It adds a custom content to an overlay window. This window opens when you click on the marker.', 'elanta-viewer-light' ),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__( 'Marker Max Width', 'elanta-viewer-light' ),
						'param_name' => 'width',
						'std'        => '32',
						'dependency' => array(
							'element' => 'type_marker',
							'value'   => array( 'false', 'html', 'product' ),
						),

					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__( 'Marker Max Hight', 'elanta-viewer-light' ),
						'param_name' => 'height',
						'std'        => '32',
						'dependency' => array(
							'element' => 'type_marker',
							'value'   => array( 'false', 'html', 'product' ),
						),
					),
					array(
						'type'       => 'hidden',
						'heading'    => esc_html__( 'Longitude', 'elanta-viewer-light' ),
						'param_name' => 'longitude',
					),
					array(
						'type'       => 'hidden',
						'heading'    => esc_html__( 'Latitude', 'elanta-viewer-light' ),
						'param_name' => 'latitude',
					),

				),
			),

			/* Background Overlay */
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Enable Overlay', 'elanta-viewer-light' ),
				'param_name' => 'enable_overlay',
				'value'      => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
				'group'      => esc_html__( 'Background Overlay', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Color', 'elanta-viewer-light' ),
				'param_name' => 'overlay_color',
				'dependency' => array(
					'element' => 'enable_overlay',
					'value'   => array( 'yes' ),
				),
				'group'      => esc_html__( 'Background Overlay', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__( 'Image', 'elanta-viewer-light' ),
				'param_name' => 'overlay_image',
				'dependency' => array(
					'element' => 'enable_overlay',
					'value'   => array( 'yes' ),
				),
				'group'      => esc_html__( 'Background Overlay', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'slider',
				'heading'    => esc_html__( 'Opacity', 'elanta-viewer-light' ),
				'param_name' => 'overlay_opacity',
				'dependency' => array(
					'element' => 'enable_overlay',
					'value'   => array( 'yes' ),
				),
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => 0.01,
					],
				],
				'group'      => esc_html__( 'Background Overlay', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Blend mode', 'elanta-viewer-light' ),
				'param_name' => 'overlay_blend',
				'value'      => array(
					esc_html__( 'Normal', 'elanta-viewer-light' )      => '',
					esc_html__( 'Multiply', 'elanta-viewer-light' )    => 'multiply',
					esc_html__( 'Screen', 'elanta-viewer-light' )      => 'screen',
					esc_html__( 'Overlay', 'elanta-viewer-light' )     => 'overlay',
					esc_html__( 'Darken', 'elanta-viewer-light' )      => 'darken',
					esc_html__( 'Lighten', 'elanta-viewer-light' )     => 'lighten',
					esc_html__( 'Color Dodge', 'elanta-viewer-light' ) => 'color-dodge',
					esc_html__( 'Saturation', 'elanta-viewer-light' )  => 'saturation',
					esc_html__( 'Color', 'elanta-viewer-light' )       => 'color',
					esc_html__( 'Luminosity', 'elanta-viewer-light' )  => 'luminosity',
				),
				'dependency' => array(
					'element' => 'enable_overlay',
					'value'   => array( 'yes' ),
				),
				'group'      => esc_html__( 'Background Overlay', 'elanta-viewer-light' ),
			),


			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Colors', 'elanta-viewer-light' ),
				'param_name' => 'style_tooltips',
				'value'      => array(
					esc_html__( 'Default (grey)', 'elanta-viewer-light' ) => '',
					esc_html__( 'White', 'elanta-viewer-light' )          => 'white',
					esc_html__( 'Black', 'elanta-viewer-light' )          => 'black',
				),
				'group'      => esc_html__( 'Tooltips Settings', 'elanta-viewer-light' ),
			),


			/* Navbar settings */
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Enable navbar', 'elanta-viewer-light' ),
				'param_name' => 'navbar_enable',
				'value'      => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
				'group'      => esc_html__( 'Navbar settings', 'elanta-viewer-light' ),
			),

			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Display AutoRotate Button ', 'elanta-viewer-light' ),
				'param_name' => 'autorotate',
				'value'      => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
				'dependency' => array(
					'element' => 'navbar_enable',
					'value'   => array( 'yes' ),
				),
				'group'      => esc_html__( 'Navbar settings', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Display Zoom Button ', 'elanta-viewer-light' ),
				'param_name' => 'zoom',
				'value'      => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
				'dependency' => array(
					'element' => 'navbar_enable',
					'value'   => array( 'yes' ),
				),
				'group'      => esc_html__( 'Navbar settings', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Display Download Button ', 'elanta-viewer-light' ),
				'param_name' => 'download',
				'value'      => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
				'dependency' => array(
					'element' => 'navbar_enable',
					'value'   => array( 'yes' ),
				),
				'group'      => esc_html__( 'Navbar settings', 'elanta-viewer-light' ),
			),

			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Display Full Screen Button ', 'elanta-viewer-light' ),
				'param_name' => 'fullscreen',
				'value'      => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
				'dependency' => array(
					'element' => 'navbar_enable',
					'value'   => array( 'yes' ),
				),
				'group'      => esc_html__( 'Navbar settings', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Display Markers', 'elanta-viewer-light' ),
				'param_name' => 'display_markers',
				'value'      => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
				'dependency' => array(
					'element' => 'navbar_enable',
					'value'   => array( 'yes' ),
				),
				'group'      => esc_html__( 'Navbar settings', 'elanta-viewer-light' ),
			),

			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Display Gyroscope', 'elanta-viewer-light' ),
				'param_name'  => 'display_gyroscope',
				'value'       => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
				'dependency'  => array(
					'element' => 'navbar_enable',
					'value'   => array( 'yes' ),
				),
				'description' => esc_html__( 'Enables the gyroscope navigation if available', 'elanta-viewer-light' ),
				'group'       => esc_html__( 'Navbar settings', 'elanta-viewer-light' ),
			),

			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Display Caption Text ', 'elanta-viewer-light' ),
				'param_name' => 'display_caption',
				'value'      => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
				'dependency' => array(
					'element' => 'navbar_enable',
					'value'   => array( 'yes' ),
				),
				'group'      => esc_html__( 'Navbar settings', 'elanta-viewer-light' ),
			),
			array(
				'type'        => 'textarea',
				'heading'     => esc_html__( 'Custom Caption', 'elanta-viewer-light' ),
				'param_name'  => 'caption',
				'dependency'  => array(
					'element' => 'display_caption',
					'value'   => array( 'yes' ),
				),
				'description' => esc_html__( 'Support HTML', 'elanta-viewer-light' ),
				'group'       => esc_html__( 'Navbar settings', 'elanta-viewer-light' ),
			),

			/* Cropped */
			array(
				'type'       => 'checkbox',
				'heading'    => esc_html__( 'Enable cropped', 'elanta-viewer-light' ),
				'param_name' => 'enable_cropped',
				'value'      => array( esc_html__( 'Yes, please', 'elanta-viewer-light' ) => 'yes' ),
				'group'      => esc_html__( 'Cropped', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Full width', 'elanta-viewer-light' ),
				'param_name' => 'full_width',
				'group'      => esc_html__( 'Cropped', 'elanta-viewer-light' ),
				'dependency' => array(
					'element' => 'enable_cropped',
					'value'   => array( 'yes' ),
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Full height', 'elanta-viewer-light' ),
				'param_name' => 'full_height',
				'group'      => esc_html__( 'Cropped', 'elanta-viewer-light' ),
				'dependency' => array(
					'element' => 'enable_cropped',
					'value'   => array( 'yes' ),
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Cropped width', 'elanta-viewer-light' ),
				'param_name' => 'cropped_width',
				'group'      => esc_html__( 'Cropped', 'elanta-viewer-light' ),
				'dependency' => array(
					'element' => 'enable_cropped',
					'value'   => array( 'yes' ),
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Cropped height', 'elanta-viewer-light' ),
				'param_name' => 'cropped_height',
				'group'      => esc_html__( 'Cropped', 'elanta-viewer-light' ),
				'dependency' => array(
					'element' => 'enable_cropped',
					'value'   => array( 'yes' ),
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Cropped X', 'elanta-viewer-light' ),
				'param_name' => 'cropped_x',
				'group'      => esc_html__( 'Cropped', 'elanta-viewer-light' ),
				'dependency' => array(
					'element' => 'enable_cropped',
					'value'   => array( 'yes' ),
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Cropped Y', 'elanta-viewer-light' ),
				'param_name'  => 'cropped_y',
				'group'       => esc_html__( 'Cropped', 'elanta-viewer-light' ),
				'dependency'  => array(
					'element' => 'enable_cropped',
					'value'   => array( 'yes' ),
				),
				'description' => sprintf(
					'%s <a href="%s">%s</a>',
					esc_html__( 'Do not know how to use it?', 'elanta-viewer-light' ),
					esc_url( 'https://photo-sphere-viewer.js.org/crop.html' ),
					esc_html__( 'more info', 'elanta-viewer-light' )
				),
			),


			/* Navbar Tooltips */
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Markers', 'elanta-viewer-light' ),
				'param_name' => 'label_markers',
				'group'      => esc_html__( 'Navbar Tooltips', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Zoom', 'elanta-viewer-light' ),
				'param_name' => 'label_zoom',
				'group'      => esc_html__( 'Navbar Tooltips', 'elanta-viewer-light' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Zoom out', 'elanta-viewer-light' ),
				'param_name' => 'label_zoomOut',
				'group'      => esc_html__( 'Navbar Tooltips', 'elanta-viewer-light' ),

			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Zoom In', 'elanta-viewer-light' ),
				'param_name' => 'label_zoomIn',
				'group'      => esc_html__( 'Navbar Tooltips', 'elanta-viewer-light' ),

			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Download', 'elanta-viewer-light' ),
				'param_name' => 'label_download',
				'group'      => esc_html__( 'Navbar Tooltips', 'elanta-viewer-light' ),

			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Fullscreen', 'elanta-viewer-light' ),
				'param_name' => 'label_fullscreen',
				'group'      => esc_html__( 'Navbar Tooltips', 'elanta-viewer-light' ),

			),
			array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Automatic rotation', 'elanta-viewer-light' ),
				'param_name' => 'label_autorotate',
				'group'      => esc_html__( 'Navbar Tooltips', 'elanta-viewer-light' ),

			),

		),
		apply_filters(
			'elenta_viewer_after_params',
			array()
		)
	), // End all params.
);
