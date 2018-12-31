<?php
/**
 * User: elanta https://codecanyon.net/user/elanta/portfolio
 * Date: 27.12.2018
 * Type: wpbakery
 *
 * @package PVIEWER/Params
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

return array(
	'name'        => __( '360 Viewer Light', '360-viewer-light' ),
	'description' => __( 'Photo sphere viewer and the beautiful background for Elementor', '360-viewer-light' ),
	'base'        => 'photo_panorama_el',
	'icon'        => 'photo-panorama-el_icon',
	'category'    => __( 'Content', '360-viewer-light' ),
	'params'      => array_merge(
		apply_filters( 'panorama_before_params', array() ),
		array(

			/* General */
			array(
				'type'       => 'attach_image',
				'heading'    => __( 'Upload Panorama Image', '360-viewer-light' ),
				'param_name' => 'panorama',
				'group'      => __( 'General', '360-viewer-light' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Height', '360-viewer-light' ),
				'param_name' => 'type_height',
				'value'      => array(
					__( 'Custom Height', 'creamaps' )          => 'default',
					__( 'Full height of section', 'creamaps' ) => 'fullheight',
				),
				'group'      => __( 'General', '360-viewer-light' ),
			),
			array(
				'type'        => 'slider',
				'heading'     => __( 'Custom Height', '360-viewer-light' ),
				'param_name'  => 'height',
				'range'       => [
					'px' => [
						'min' => 50,
						'max' => 800,
					],
				],
				'value'       => '0',
				'description' => __( 'example: 500', '360-viewer-light' ),
				'dependency'  => array(
					'element' => 'type_height',
					'value'   => array( 'default' ),
				),
				'group'       => __( 'General', '360-viewer-light' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Panorama as background', '360-viewer-light' ),
				'param_name' => 'as_bg',
				'group'      => __( 'General', '360-viewer-light' ),
			),

			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Mousewheel', '360-viewer-light' ),
				'param_name' => 'mousewheel',
				'value'      => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
				'group'      => __( 'General', '360-viewer-light' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Mousemove', '360-viewer-light' ),
				'param_name' => 'mousemove',
				'value'      => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
				'group'      => __( 'General', '360-viewer-light' ),
				'std'        => 'yes',
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Mousemove Hover', '360-viewer-light' ),
				'param_name' => 'mousemove_hover',
				'value'      => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
				'dependency' => array(
					'element' => 'mousemove',
					'value'   => array( 'yes' ),
				),
				'group'      => __( 'General', '360-viewer-light' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'AutoRotate on Start', '360-viewer-light' ),
				'param_name'  => 'time_anim',
				'value'       => '',
				'description' => __( '(msec) If set to 0, auto-rotation will be disabled on start', '360-viewer-light' ),
				'group'       => __( 'General', '360-viewer-light' ),
			),
			array(
				'type'       => 'slider',
				'heading'    => __( 'Rotate speed', '360-viewer-light' ),
				'param_name' => 'anim_speed',
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 10,
						'step' => 0.2,
					],
				],
				'group'      => __( 'General', '360-viewer-light' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Blend mode', '360-viewer-light' ),
				'param_name' => 'filter',
				'value'      => array(
					__( 'None', '360-viewer-light' )       => '',
					__( 'Blur', '360-viewer-light' )       => 'blur',
					__( 'Brightness', '360-viewer-light' ) => 'brightness',
					__( 'Contrast', '360-viewer-light' )   => 'contrast',
					__( 'Grayscale', '360-viewer-light' )  => 'grayscale',
					__( 'Hue-rotate', '360-viewer-light' ) => 'hue-rotate',
					__( 'Invert', '360-viewer-light' )     => 'invert',
					__( 'Opacity', '360-viewer-light' )    => 'opacity',
					__( 'Saturate', '360-viewer-light' )   => 'saturate',
					__( 'Sepia', '360-viewer-light' )      => 'sepia',
				),
				'group'      => __( 'General', '360-viewer-light' ),
			),
			array(
				'type'       => 'slider',
				'heading'    => __( 'Filter value', '360-viewer-light' ),
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
				'group'      => __( 'General', '360-viewer-light' ),
			),
			array(
				'type'        => 'slider',
				'heading'     => __( 'Zoom', '360-viewer-light' ),
				'param_name'  => 'default_fov',
				'value'       => '45',
				'range'       => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
				],
				'group'       => __( 'General', '360-viewer-light' ),
				'description' => __( 'It sets zoom of image by default.', '360-viewer-light' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Loading text', '360-viewer-light' ),
				'param_name' => 'loading_txt',
				'std'        => 'Loading...',
				'group'      => __( 'General', '360-viewer-light' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show loading image', '360-viewer-light' ),
				'param_name' => 'show_loading_img',
				'group'      => __( 'General', '360-viewer-light' ),
				'value'      => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
			),
			array(
				'type'       => 'attach_image',
				'heading'    => __( 'Loading image', '360-viewer-light' ),
				'param_name' => 'loading_img_file',
				'group'      => __( 'General', '360-viewer-light' ),
				'dependency' => array(
					'element' => 'show_loading_img',
					'value'   => array( 'yes' ),
				),
			),


			/* Markers */
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Enable markers ', '360-viewer-light' ),
				'param_name' => 'enable_marker',
				'group'      => __( 'Markers', '360-viewer-light' ),
				'value'      => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
			),
			array(
				'type'       => 'param_group',
				'heading'    => __( 'Markers', '360-viewer-light' ),
				'param_name' => 'markers',
				'group'      => 'Markers',
				'dependency' => array(
					'element' => 'enable_marker',
					'value'   => array( 'yes' ),
				),
				'params'     => array(
					array(
						'type'        => 'dropdown',
						'heading'     => __( 'Marker Type', '360-viewer-light' ),
						'param_name'  => 'type_marker',
						'value'       => array(
							__( 'Default (image)', '360-viewer-light' ) => '',
							__( 'Circle', '360-viewer-light' )          => 'circle',
							__( 'Post', '360-viewer-light' )            => 'html',
							__( 'Product', '360-viewer-light' )         => 'product',
						),
						'description' => __( 'Notice! Post and Product types support a custom template', '360-viewer-light' ),
					),

					array(
						'type'       => 'dropdown',
						'heading'    => __( 'Marker Action', '360-viewer-light' ),
						'param_name' => 'marker_action',
						'value'      => array(
							__( 'Default (open modal)', '360-viewer-light' )    => '',
							__( 'Custom URL', '360-viewer-light' )              => 'url',
							__( 'Go to product (inherit)', '360-viewer-light' ) => 'product',
						),
					),

					array(
						'type'       => 'vc_link',
						'heading'    => __( 'Marker Custom URL', '360-viewer-light' ),
						'param_name' => 'marker_action_url',
						'value'      => '',
						'dependency' => array(
							'element' => 'marker_action',
							'value'   => array( 'url' ),
						),
					),

					array(
						'type'        => 'textfield',
						'heading'     => __( 'Circle Radius', '360-viewer-light' ),
						'param_name'  => 'circle',
						'value'       => '20',
						'description' => __( 'example: 20', '360-viewer-light' ),
						'dependency'  => array(
							'element' => 'type_marker',
							'value'   => array( 'circle' ),
						),
					),

					array(
						'type'       => 'colorpicker',
						'heading'    => __( 'Circle Color', '360-viewer-light' ),
						'param_name' => 'fill',
						'dependency' => array(
							'element' => 'type_marker',
							'value'   => array( 'circle' ),
						),
					),

					array(
						'type'        => 'dropdown',
						'heading'     => __( 'Select Post', '360-viewer-light' ),
						'param_name'  => 'post_id',
						'value'       => panorama_dropdown( 'post', 100, true ),
						'std'         => __( 'Select post', '360-viewer-light' ),
						'dependency'  => array(
							'element' => 'type_marker',
							'value'   => array( 'html' ),
						),
						'description' => __( 'Select post which you want to show instead of the marker.', '360-viewer-light' ),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => __( 'Select Product', '360-viewer-light' ),
						'param_name'  => 'product_id',
						'value'       => panorama_dropdown( 'product', 100, true ),
						'std'         => __( 'Select product', '360-viewer-light' ),
						'dependency'  => array(
							'element' => 'type_marker',
							'value'   => array( 'product' ),
						),
						'description' => __( 'Select product which you want to show instead of the marker.', '360-viewer-light' ),
					),
					array(
						'type'       => 'attach_image',
						'class'      => '',
						'heading'    => __( 'Upload Image Marker', '360-viewer-light' ),
						'param_name' => 'image',
						'dependency' => array(
							'element' => 'type_marker',
							'value'   => array( '' ),
						),
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Add Marker Coordinates', '360-viewer-light' ),
						'param_name'  => 'add_coordinate',
						'std'         => 'Please click here',
						'value'       => '',
						'dependency'  => array(
							'element' => 'type_marker',
							'value'   => array( '', 'html', 'product', 'circle' ),
						),
						'description' => __( 'Marker coordinates on the image. Don’t forget to fill  Show in Scene param. Otherwise, you can add the marker to the first scene only.', '360-viewer-light' ),
					),
					array(
						'type'        => 'textfield',
						'heading'     => __( 'Custom Tooltip', '360-viewer-light' ),
						'param_name'  => 'tooltip',
						'dependency'  => array(
							'element' => 'type_marker',
							'value'   => array( '', 'html', 'product', 'circle' ),
						),
						'description' => __( 'Tooltip appears when hovering cursor.', '360-viewer-light' ),
					),
					array(
						'type'        => 'textarea',
						'heading'     => __( 'Content', '360-viewer-light' ),
						'param_name'  => 'content',
						'admin_label' => true,
						'dependency'  => array(
							'element' => 'marker_action',
							'value'   => array( '' ),
						),
						'description' => __( 'It adds a custom content to an overlay window. This window opens when you click on the marker.', '360-viewer-light' ),
					),
					array(
						'type'       => 'textfield',
						'heading'    => __( 'Marker Max Width', '360-viewer-light' ),
						'param_name' => 'width',
						'std'        => '32',
						'dependency' => array(
							'element' => 'type_marker',
							'value'   => array( '', 'html', 'product' ),
						),

					),
					array(
						'type'       => 'textfield',
						'heading'    => __( 'Marker Max Hight', '360-viewer-light' ),
						'param_name' => 'height',
						'std'        => '32',
						'dependency' => array(
							'element' => 'type_marker',
							'value'   => array( '', 'html', 'product' ),
						),
					),
					array(
						'type'       => 'hidden',
						'heading'    => __( 'Longitude', '360-viewer-light' ),
						'param_name' => 'longitude',
					),
					array(
						'type'       => 'hidden',
						'heading'    => __( 'Latitude', '360-viewer-light' ),
						'param_name' => 'latitude',
					),

				),
			),

			/* Background Overlay */
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Enable Overlay', '360-viewer-light' ),
				'param_name' => 'enable_overlay',
				'value'      => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
				'group'      => __( 'Background Overlay', '360-viewer-light' ),
			),
			array(
				'type'       => 'colorpicker',
				'heading'    => __( 'Color', '360-viewer-light' ),
				'param_name' => 'overlay_color',
				'dependency' => array(
					'element' => 'enable_overlay',
					'value'   => array( 'yes' ),
				),
				'group'      => __( 'Background Overlay', '360-viewer-light' ),
			),
			array(
				'type'       => 'attach_image',
				'heading'    => __( 'Image', '360-viewer-light' ),
				'param_name' => 'overlay_image',
				'dependency' => array(
					'element' => 'enable_overlay',
					'value'   => array( 'yes' ),
				),
				'group'      => __( 'Background Overlay', '360-viewer-light' ),
			),
			array(
				'type'       => 'slider',
				'heading'    => __( 'Opacity', '360-viewer-light' ),
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
				'group'      => __( 'Background Overlay', '360-viewer-light' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Blend mode', '360-viewer-light' ),
				'param_name' => 'overlay_blend',
				'value'      => array(
					__( 'Normal', '360-viewer-light' )      => '',
					__( 'Multiply', '360-viewer-light' )    => 'multiply',
					__( 'Screen', '360-viewer-light' )      => 'screen',
					__( 'Overlay', '360-viewer-light' )     => 'overlay',
					__( 'Darken', '360-viewer-light' )      => 'darken',
					__( 'Lighten', '360-viewer-light' )     => 'lighten',
					__( 'Color Dodge', '360-viewer-light' ) => 'color-dodge',
					__( 'Saturation', '360-viewer-light' )  => 'saturation',
					__( 'Color', '360-viewer-light' )       => 'color',
					__( 'Luminosity', '360-viewer-light' )  => 'luminosity',
				),
				'dependency' => array(
					'element' => 'enable_overlay',
					'value'   => array( 'yes' ),
				),
				'group'      => __( 'Background Overlay', '360-viewer-light' ),
			),


			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Colors', '360-viewer-light' ),
				'param_name' => 'style_tooltips',
				'value'      => array(
					__( 'Default (grey)', '360-viewer-light' ) => '',
					__( 'White', '360-viewer-light' )          => 'white',
					__( 'Black', '360-viewer-light' )          => 'black',
				),
				'group'      => __( 'Tooltips Settings', '360-viewer-light' ),
			),


			/* Navbar settings */
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Enable navbar', '360-viewer-light' ),
				'param_name' => 'navbar_enable',
				'value'      => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
				'group'      => __( 'Navbar settings', '360-viewer-light' ),
			),

			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Display AutoRotate Button ', '360-viewer-light' ),
				'param_name' => 'autorotate',
				'value'      => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
				'dependency' => array(
					'element' => 'navbar_enable',
					'value'   => array( 'yes' ),
				),
				'group'      => __( 'Navbar settings', '360-viewer-light' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Display Zoom Button ', '360-viewer-light' ),
				'param_name' => 'zoom',
				'value'      => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
				'dependency' => array(
					'element' => 'navbar_enable',
					'value'   => array( 'yes' ),
				),
				'group'      => __( 'Navbar settings', '360-viewer-light' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Display Download Button ', '360-viewer-light' ),
				'param_name' => 'download',
				'value'      => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
				'dependency' => array(
					'element' => 'navbar_enable',
					'value'   => array( 'yes' ),
				),
				'group'      => __( 'Navbar settings', '360-viewer-light' ),
			),

			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Display Full Screen Button ', '360-viewer-light' ),
				'param_name' => 'fullscreen',
				'value'      => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
				'dependency' => array(
					'element' => 'navbar_enable',
					'value'   => array( 'yes' ),
				),
				'group'      => __( 'Navbar settings', '360-viewer-light' ),
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Display Markers', '360-viewer-light' ),
				'param_name' => 'display_markers',
				'value'      => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
				'dependency' => array(
					'element' => 'navbar_enable',
					'value'   => array( 'yes' ),
				),
				'group'      => __( 'Navbar settings', '360-viewer-light' ),
			),

			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Display Gyroscope', '360-viewer-light' ),
				'param_name'  => 'display_gyroscope',
				'value'       => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
				'dependency'  => array(
					'element' => 'navbar_enable',
					'value'   => array( 'yes' ),
				),
				'description' => __( 'Enables the gyroscope navigation if available', '360-viewer-light' ),
				'group'       => __( 'Navbar settings', '360-viewer-light' ),
			),

			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Display Caption Text ', '360-viewer-light' ),
				'param_name' => 'display_caption',
				'value'      => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
				'dependency' => array(
					'element' => 'navbar_enable',
					'value'   => array( 'yes' ),
				),
				'group'      => __( 'Navbar settings', '360-viewer-light' ),
			),
			array(
				'type'        => 'textarea',
				'heading'     => __( 'Custom Caption', '360-viewer-light' ),
				'param_name'  => 'caption',
				'dependency'  => array(
					'element' => 'display_caption',
					'value'   => array( 'yes' ),
				),
				'description' => __( 'Support HTML', '360-viewer-light' ),
				'group'       => __( 'Navbar settings', '360-viewer-light' ),
			),

			/* Cropped */
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Enable cropped', '360-viewer-light' ),
				'param_name' => 'enable_cropped',
				'value'      => array( __( 'Yes, please', '360-viewer-light' ) => 'yes' ),
				'group'      => __( 'Cropped', '360-viewer-light' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Full width', '360-viewer-light' ),
				'param_name' => 'full_width',
				'group'      => __( 'Cropped', '360-viewer-light' ),
				'dependency' => array(
					'element' => 'enable_cropped',
					'value'   => array( 'yes' ),
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Full height', '360-viewer-light' ),
				'param_name' => 'full_height',
				'group'      => __( 'Cropped', '360-viewer-light' ),
				'dependency' => array(
					'element' => 'enable_cropped',
					'value'   => array( 'yes' ),
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Cropped width', '360-viewer-light' ),
				'param_name' => 'cropped_width',
				'group'      => __( 'Cropped', '360-viewer-light' ),
				'dependency' => array(
					'element' => 'enable_cropped',
					'value'   => array( 'yes' ),
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Cropped height', '360-viewer-light' ),
				'param_name' => 'cropped_height',
				'group'      => __( 'Cropped', '360-viewer-light' ),
				'dependency' => array(
					'element' => 'enable_cropped',
					'value'   => array( 'yes' ),
				),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Cropped X', '360-viewer-light' ),
				'param_name' => 'cropped_x',
				'group'      => __( 'Cropped', '360-viewer-light' ),
				'dependency' => array(
					'element' => 'enable_cropped',
					'value'   => array( 'yes' ),
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Cropped Y', '360-viewer-light' ),
				'param_name'  => 'cropped_y',
				'group'       => __( 'Cropped', '360-viewer-light' ),
				'dependency'  => array(
					'element' => 'enable_cropped',
					'value'   => array( 'yes' ),
				),
				'description' => sprintf(
					'%s <a href="%s">%s</a>',
					esc_html__( 'Do not know how to use it?', '360-viewer-light' ),
					esc_url( 'https://photo-sphere-viewer.js.org/crop.html' ),
					esc_html__( 'more info', '360-viewer-light' )
				),
			),


			/* Navbar Tooltips */
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Markers', '360-viewer-light' ),
				'param_name' => 'label_markers',
				'group'      => __( 'Navbar Tooltips', '360-viewer-light' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Zoom', '360-viewer-light' ),
				'param_name' => 'label_zoom',
				'group'      => __( 'Navbar Tooltips', '360-viewer-light' ),
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Zoom out', '360-viewer-light' ),
				'param_name' => 'label_zoomOut',
				'group'      => __( 'Navbar Tooltips', '360-viewer-light' ),

			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Zoom In', '360-viewer-light' ),
				'param_name' => 'label_zoomIn',
				'group'      => __( 'Navbar Tooltips', '360-viewer-light' ),

			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Download', '360-viewer-light' ),
				'param_name' => 'label_download',
				'group'      => __( 'Navbar Tooltips', '360-viewer-light' ),

			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Fullscreen', '360-viewer-light' ),
				'param_name' => 'label_fullscreen',
				'group'      => __( 'Navbar Tooltips', '360-viewer-light' ),

			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Automatic rotation', '360-viewer-light' ),
				'param_name' => 'label_autorotate',
				'group'      => __( 'Navbar Tooltips', '360-viewer-light' ),

			),

		),
		apply_filters(
			'panorama_after_params',
			array()
		)
	), // End all params.
);
