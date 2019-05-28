<?php
/**
 *
 * Loader all params of widget
 *
 * @package ElantaBuilder
 */

namespace ElantaBuilder;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 *
 * Loader.
 */
class Loader {

	/**
	 * All params.
	 *
	 * @var $params
	 */
	private $params;

	/**
	 * The builder slug..
	 *
	 * @var $type_from
	 */
	private $type_from;

	/**
	 * The builder slug..
	 *
	 * @var $type_to
	 */
	private $type_to;

	/**
	 * The converter class..
	 *
	 * @var $converter
	 */
	private $converter;

	/**
	 * Template file.
	 *
	 * @var $tmpl_file
	 */
	private $tmpl_file;

	/**
	 * Converter constructor.
	 *
	 * @param string $type_from The builder slug.
	 * @param string $type_to   The builder slug.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct( $type_from = null, $type_to = null ) {

		if ( ! $type_from ) {
			return null;
		}

		$this->converter = new Converter();

		$this->type_from = $type_from;
		$this->type_to   = $type_to;

		$this->params = Parse::parse(
			array(
				'type' => $type_from,
				'file' => ELANTA_BUILDER_DATA . 'config.php',
			)
		);

	}

	/**
	 * Get base params of the widget.
	 *
	 * @return array
	 */
	public function get_base_params() {

		if ( ! empty( $this->params['params'] ) && $this->type_from != $this->type_to ) {
			$this->params['params'] = $this->get_params();
		}

		return $this->params;

	}

	/**
	 * Get all params of the widget.
	 *
	 * @return array
	 */
	public function get_params() {

		if ( empty( $this->params ) || empty( $this->type_to ) ) {
			return array();
		}

		return $this->converter->convert_params( $this->params['params'], $this->type_from, $this->type_to );

	}

	/**
	 * Get the widget name.
	 *
	 * @return string
	 */
	public function get_name() {

		return $this->converter->get_name( $this->params, $this->type_from );

	}

	/**
	 * Get the widget slug.
	 *
	 * @return string
	 */
	public function get_slug() {

		return $this->converter->get_slug( $this->params, $this->type_from );

	}

	/**
	 * Get icon. Needs change.
	 *
	 * @return string
	 */
	public function get_icon() {
		return '';
	}

	/**
	 * Get the template of the widget.
	 *
	 * @return string
	 */
	public function get_tmpl_file() {

		$this->tmpl_file = ELANTA_BUILDER_DATA . 'tmpl.php';

		return apply_filters(
			'elantabuilder/template/file',
			$this->tmpl_file
		);
	}

}
