<?php

//namespace ElantaBuilder;

/**
 * Shortcode handler
 */

global $loader;
$loader = new \ElantaBuilder\Loader( 'wpbakery', 'cornerstone' );

include_once $loader->getTmplFile();
