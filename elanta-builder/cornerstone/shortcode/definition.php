<?php

//namespace ElantaBuilder;

/**
 * Element Definition
 */
class ElantaBuilder_Shortcode {

	/**
	 * @return array
	 */
	public function ui() {
		$loader = new \ElantaBuilder\Loader( 'wpbakery', 'cornerstone' );

		return array(
			'name'       => $loader->getSlug(),
			'title'      => $loader->getName(),
			'icon_group' => 'elenta-icons',
			'icon_id'    => 'icon-360-degree',
		);
	}
}

