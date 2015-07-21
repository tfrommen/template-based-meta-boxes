<?php # -*- coding: utf-8 -*-

namespace tf\TemplateBasedMetaBoxes\Models;

/**
 * Class Script
 *
 * @package tf\TemplateBasedMetaBoxes\Models
 */
class Script {

	/**
	 * @var string
	 */
	private $file;

	/**
	 * @var Settings
	 */
	private $settings;

	/**
	 * Constructor. Set up the properties.
	 *
	 * @param string   $file     Main plugin file.
	 * @param Settings $settings Settings model.
	 */
	public function __construct( $file, Settings $settings ) {

		$this->file = $file;

		$this->settings = $settings;
	}

	/**
	 * Enqueue and localize the script file.
	 *
	 * @wp-hook admin_print_scripts-{$hook_suffix}
	 *
	 * @return void
	 */
	public function enqueue() {

		if ( $GLOBALS[ 'typenow' ] !== 'page' ) {
			return;
		}

		$settings = $this->settings->get();
		if ( ! $settings ) {
			return;
		}

		$handle = 'template-based-meta-boxes-admin';
		$url = plugin_dir_url( $this->file );
		$infix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$file = 'assets/js/admin' . $infix . '.js';
		$path = plugin_dir_path( $this->file );
		$version = filemtime( $path . $file );
		wp_enqueue_script(
			$handle,
			$url . $file,
			array( 'jquery' ),
			$version,
			TRUE
		);

		$data = array(
			'settings'  => $settings,
			'metaBoxes' => $this->settings->get_meta_boxes( $settings ),
		);
		wp_localize_script( $handle, 'tfTemplateBasedMetaBoxesData', $data );
	}

}
