<?php

namespace DadBuilders;

use DadBuilders;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$loader = new DadBuilders\Loader( 'wpbakery', 'wpbakery' );


if ( function_exists( 'vc_map' ) ) {

	$base_params                     = $loader->getBaseParams();
	$base_params['front_enqueue_js'] = PVR_URL . '/data/assets/admin/js/front-editor.js';

	vc_map( $base_params );

	add_shortcode( $base_params['base'], function ( $atts ) {

		ob_start();

		if ( empty( $atts ) ) {
			$atts = array();
		}

		include_once DADBUILDERS_DATA . 'tmpl.php';

		return ob_get_clean();

	} );

}

