<?php

namespace ElantaBuilder;

use ElantaBuilder;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

$loader = new ElantaBuilder\Loader( 'wpbakery', 'wpbakery' );


if ( function_exists( 'vc_map' ) ) {

	$base_params                     = $loader->get_base_params();
	$base_params['front_enqueue_js'] = ELANTA_BUILDER_DATA_URL . 'assets/admin/js/front-editor.js';

	vc_map( $base_params );

	add_shortcode(
		$base_params['base'],
		function ( $atts ) {

			ob_start();

			if ( empty( $atts ) ) {
				$atts = array();
			}

			include ELANTA_BUILDER_DATA . 'tmpl.php';

			return ob_get_clean();

		}
	);

}

