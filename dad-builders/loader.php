<?php

namespace DadBuilders;

use DadBuilders;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Loader {

	private $params;

	private $type_from;

	private $type_to;

	private $converter;

	private $tmpl_file;

	/**
	 * Converter constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct( $type_from = null, $type_to = null ) {
		if ( ! $type_from ) {
			return null;
		}

		/*$default_headers = array(
			'Type' => '',
		);

		$config_data = get_file_data( DADBUILDERS_DATA . 'config.php', $default_headers, 'config' );
		*/

		$this->converter = new DadBuilders\Converter();

		$this->type_from = $type_from;
		$this->type_to   = $type_to;

		$this->params = Parse::parse( array(
			'type' => $type_from,
			'file' => DADBUILDERS_DATA . 'config.php',
		) );

	}

	public function getBaseParams() {

		if ( ! empty( $this->params['params'] ) && $this->type_from != $this->type_to ) {
			$this->params['params'] = $this->getParams();
		}

		return $this->params;

	}


	public function getParams() {

		if ( empty( $this->params ) || empty( $this->type_to ) ) {
			return array();
		}

		return $this->converter->convert_params( $this->params['params'], $this->type_from, $this->type_to );

	}

	public function getName() {

		return $this->converter->getName( $this->params, $this->type_from );

	}

	public function getSlug() {

		return $this->converter->getSlug( $this->params, $this->type_from );

	}

	public function getIcon() {
		return '';
	}

	/**
	 * @return string
	 */
	public function getTmplFile() {
		$this->tmpl_file = DADBUILDERS_DATA . 'tmpl.php';
		return apply_filters( 'DadBuilders/template/file', $this->tmpl_file );
	}

}