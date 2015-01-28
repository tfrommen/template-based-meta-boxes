<?php # -*- coding: utf-8 -*-

namespace tf\TemplateBasedMetaBoxes\Model;

/**
 * Class Script
 *
 * @package tf\TemplateBasedMetaBoxes\Model
 */
class Script {

	/**
	 * @var string
	 */
	private $file;

	/**
	 * Constructor. Init properties.
	 *
	 * @param string $file Main plugin file
	 */
	public function __construct( $file ) {

		$this->file = $file;
	}

	/**
	 * Enqueue and localize script file.
	 *
	 * @wp-hook admin_footer
	 *
	 * @return void
	 */
	public function enqueue() {

		if ( $GLOBALS[ 'typenow' ] !== 'page' ) {
			return;
		}

		$settings_model = new Settings();
		$settings = $settings_model->get();
		if ( ! $settings ) {
			return;
		}

		$handle = 'template-based-meta-boxes-admin';
		$url = plugin_dir_url( $this->file );
		$file = 'assets/js/admin.js';
		$path = plugin_dir_path( $this->file );
		$version = filemtime( $path . $file );
		wp_register_script(
			$handle,
			$url . $file,
			array( 'jquery' ),
			$version,
			TRUE
		);

		wp_localize_script(
			$handle,
			'templateBasedMetaBoxesData',
			array(
				'settings'  => $settings,
				'metaBoxes' => $settings_model->get_meta_boxes( $settings ),
			)
		);

		wp_enqueue_script( $handle );
	}

}
