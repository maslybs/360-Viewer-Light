<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

return array(
	'type'        => array(
		'textfield'             => 'text',
		'el_id'                 => 'text',
		'textarea'              => 'textarea',
		'dropdown'              => 'select',
		'choose'                => 'select',
		'attach_image'          => 'image',
		'attach_images'         => 'gallery',
		'iconpicker'            => 'icon',
		'hidden'                => 'hidden',
		'colorpicker'           => 'color',
		'param_group'           => 'repeater',
		'content'               => 'editor',
		'vc_link'               => 'url',
		'wpl_input_switcher'    => 'toggle',
		'checkbox'              => 'toggle',
		'textarea_raw_html'     => 'textarea',
		'separator'             => 'info-box',
		'google_fonts'          => 'font',
		'wpl_input_coordinates' => 'text',
		'css_editor'            => 'textarea',
	),
	'heading'     => 'ui/title',
	'description' => 'ui/tooltip',
	'std'         => 'default',
	'param_name'  => 'name',
	'value'       => 'options',
	'params'      => 'fields',
	'dependency'  => 'condition',
	'group'       => 'group',
);