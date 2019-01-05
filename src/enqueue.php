<?php
/**
 * User: elanta https://codecanyon.net/user/elanta/portfolio
 * Date: 27.12.2018
 *
 * @package ELANTA_VIEWER/Enqueue
 */

namespace ElantaViewerCore;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Enqueue scripts and styles.
 *
 * @since  1.0.0
 */
class Enqueue {


	/**
	 * Path of plugin.
	 *
	 * @var $data_path
	 */
	private $data_path;

	/**
	 * Url of plugin.
	 *
	 * @var $data_url
	 */
	private $data_url;

	/**
	 * Enqueue constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {
		$this->data_path = ELANTA_VIEWER_PATH . 'data/';
		$this->data_url  = ELANTA_VIEWER_URL . 'data/';
	}

	/**
	 * Run all hooks.
	 */
	public function init() {

		// Enqueue css and js files on frond-end.
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_css_js' ) );

		// Enqueue css and js files on back-end.
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_css_js' ) );

		add_action( 'elementor/editor/before_enqueue_scripts', array( &$this, 'admin_enqueue_css_js' ), 100 );
	}

	/**
	 * Admin enqueue scripts.
	 */
	public function admin_enqueue_css_js() {

		/**
		 * ElantaViewerCore enqueue.
		 *
		 * @since 1.0.0
		 */
		do_action( 'elantaBuilder_before_admin_enqueue' );

		wp_enqueue_script(
			'three',
			'https://cdnjs.cloudflare.com/ajax/libs/three.js/97/three.min.js', // register the block here.
			array( 'jquery' ),
			'97',
			true
		);

		wp_enqueue_script(
			'D-script',
			$this->data_url . 'assets/js/D.min.js', // register the block here.
			array( 'jquery' ),
			filemtime( $this->data_path . 'assets/js/D.min.js' ),
			true
		);

		wp_enqueue_script(
			'doT',
			$this->data_url . 'assets/js/doT.min.js', // register the block here.
			array( 'jquery' ),
			filemtime( $this->data_path . 'assets/js/doT.min.js' ),
			true
		);

		wp_enqueue_script(
			'uevent',
			$this->data_url . 'assets/js/uevent.min.js', // register the block here.
			array( 'jquery' ),
			filemtime( $this->data_path . 'assets/js/uevent.min.js' ),
			true
		);

		wp_enqueue_script(
			'photo-sphere-viewer',
			$this->data_url . 'assets/js/photo-sphere-viewer.min.js', // register the block here.
			array( 'jquery' ),
			filemtime( $this->data_path . 'assets/js/photo-sphere-viewer.min.js' ),
			true
		);

		wp_enqueue_style(
			'photo-sphere-viewer', // Handle.
			$this->data_url . 'assets/css/photo-sphere-viewer.min.css', // Block editor CSS.
			null,
			filemtime( $this->data_path . 'assets/css/photo-sphere-viewer.min.css' ) // filemtime — Gets file modification time.
		);

		// Popup for coordinates.
		wp_enqueue_script(
			'featherlight',
			$this->data_url . 'assets/admin/js/featherlight.js', // register the block here.
			array(
				'jquery',
				'elementor-editor',
			),
			filemtime( $this->data_path . 'assets/admin/js/featherlight.js' ), // filemtime — Gets file modification time.
			true
		);

		// Main script for admin part.
		wp_enqueue_script(
			'photo-sphere-admin-data-js',
			$this->data_url . 'assets/admin/js/admin-data.js', // register the block here.
			array(
				'jquery',
				'elementor-editor',
			),
			filemtime( $this->data_path . 'assets/admin/js/admin-data.js' ), // filemtime — Gets file modification time.
			true
		);

		// Styles of popup.
		wp_enqueue_style(
			'featherlight', // Handle.
			$this->data_url . 'assets/admin/css/featherlight.css',
			null,
			filemtime( $this->data_path . 'assets/admin/css/featherlight.css' ) // filemtime — Gets file modification time.
		);

		$custom_css = '
                .save-coordinates{
                    background: #39b54a;
					padding: 10px 25px;
					border: 0;
					margin-top: 10px;
					float: right;
					color: #fff;
					text-transform: uppercase;
            	}';
		wp_add_inline_style( 'featherlight', $custom_css );

		/**
		 * ElantaViewerCore enqueue.
		 *
		 * @since 1.0.0
		 */
		do_action( 'elantaBuilder_after_admin_enqueue' );

	}

	/**
	 * Enqueue CSS an JS
	 *
	 * @return void
	 */
	public function enqueue_css_js() {

		/**
		 * ElantaViewerCore enqueue.
		 *
		 * @since 1.0.0
		 */
		do_action( 'elantaBuilder_before_enqueue' );

		wp_enqueue_script(
			'three',
			'https://cdnjs.cloudflare.com/ajax/libs/three.js/97/three.min.js', // register the block here.
			array( 'jquery' ),
			'97',
			true
		);

		wp_enqueue_script(
			'D-script',
			$this->data_url . 'assets/js/D.min.js', // register the block here.
			array( 'jquery' ),
			filemtime( $this->data_path . 'assets/js/D.min.js' ),
			true
		);

		wp_enqueue_script(
			'doT',
			$this->data_url . 'assets/js/doT.min.js', // register the block here.
			array( 'jquery' ),
			filemtime( $this->data_path . 'assets/js/doT.min.js' ),
			true
		);

		wp_enqueue_script(
			'uevent',
			$this->data_url . 'assets/js/uevent.min.js', // register the block here.
			array( 'jquery' ),
			filemtime( $this->data_path . 'assets/js/uevent.min.js' ),
			true
		);

		wp_enqueue_script(
			'photo-sphere-viewer',
			$this->data_url . 'assets/js/photo-sphere-viewer.min.js', // register the block here.
			array( 'jquery' ),
			filemtime( $this->data_path . 'assets/js/photo-sphere-viewer.min.js' ), // filemtime — Gets file modification time.
			true
		);

		wp_enqueue_script(
			'DeviceOrientationControls',
			$this->data_url . 'assets/js/DeviceOrientationControls.js', // register the block here.
			array( 'jquery' ),
			filemtime( $this->data_path . 'assets/js/DeviceOrientationControls.js' ), // filemtime — Gets file modification time.
			true
		);

		wp_enqueue_script(
			'plugin-test-data-js',
			$this->data_url . 'assets/js/data.min.js', // register the block here.
			array(
				'jquery',
				'three',
				'photo-sphere-viewer',
			),
			filemtime( $this->data_path . 'assets/js/data.min.js' ), // gets file modification time.
			true
		);

		// Styles.
		wp_enqueue_style(
			'photo-sphere-viewer', // Handle.
			$this->data_url . 'assets/css/photo-sphere-viewer.min.css', // Block editor CSS.
			null,
			filemtime( $this->data_path . 'assets/css/photo-sphere-viewer.min.css' ) // filemtime — Gets file modification time.
		);

		wp_enqueue_style(
			'plugin-test-data-css', // Handle.
			$this->data_url . 'assets/css/data.css', // Block editor CSS.
			null,
			filemtime( $this->data_path . 'assets/css/data.css' ) // filemtime — Gets file modification time.
		);

		/**
		 * ElantaViewerCore enqueue.
		 *
		 * @since 1.0.0
		 */
		do_action( 'elantaBuilder_after_enqueue' );

	}

}
