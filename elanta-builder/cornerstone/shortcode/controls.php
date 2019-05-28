<?php

//namespace ElantaBuilder;

/**
 * Element Controls:
 */

$loaders = new \ElantaBuilder\Loader( 'wpbakery', 'cornerstone' );

$params = $loaders->getParams();

$result = array();
if ( ! empty( $params ) && is_array( $params ) ) {
	foreach ( $params as $param ) {
		$result[ $param['name'] ] = $param;
	}
}

return $result;
