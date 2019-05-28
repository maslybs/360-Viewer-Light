<?php

//namespace ElantaBuilder;

/**
 * Defaults Values
 */

global $loader;
$loader          = new \ElantaBuilder\Loader( 'wpbakery', 'cornerstone' );
$all_params      = $loader->getParams();
$defaults_params = [];

$sorting_func = function ( $value ) use ( &$defaults_params ) {
	if ( isset( $value['options'] ) ) {
		$defaults_params[ $value['name'] ] = $value['options'];
	} else {
		$defaults_params[ $value['name'] ] = '';
	}
};

array_walk( $all_params, $sorting_func );

return $defaults_params;
