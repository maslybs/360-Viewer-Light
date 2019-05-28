<?php
/**
 *
 * Compatibility all params.
 *
 * @package ElantaBuilder
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

return array(
	'type'        => array(
		'textfield'             => 'text',
		'el_id'                 => 'text',
		'slider'                => 'slider',
		'textarea'              => 'textarea',
		'dropdown'              => 'select',
		'attach_image'          => 'media',
		'attach_images'         => 'gallery',
		'iconpicker'            => 'icon',
		'hidden'                => 'hidden',
		'colorpicker'           => 'color',
		'param_group'           => 'repeater',
		'content'               => 'wysiwyg',
		'vc_link'               => 'url',
		'wpl_input_switcher'    => 'switcher',
		'checkbox'              => 'switcher',
		'textarea_raw_html'     => 'textarea',
		'separator'             => 'raw_html',
		'google_fonts'          => 'font',
		'wpl_input_coordinates' => 'text',
		'css_editor'            => 'textarea',
	),
	'heading'     => 'label',
	'description' => 'description',
	'std'         => 'default',
	'param_name'  => 'name',
	'value'       => 'options',
	'params'      => 'fields',
	'dependency'  => 'condition',
	'group'       => 'group',
	'range'       => 'range',
	'dynamic'     => 'dynamic',
);
