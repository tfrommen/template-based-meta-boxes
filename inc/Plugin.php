<?php # -*- coding: utf-8 -*-

namespace tf\TemplateBasedMetaBoxes;

/**
 * Class Plugin
 *
 * @package tf\TemplateBasedMetaBoxes
 */
class Plugin {

	/**
	 * @var string
	 */
	private $file;

	/**
	 * Constructor. Init properties.
	 *
	 * @see init()
	 *
	 * @param string $file Main plugin file
	 */
	public function __construct( $file ) {

		$this->file = $file;
	}

	/**
	 * Init controllers.
	 *
	 * @see init()
	 *
	 * @return void
	 */
	public function init() {

		if ( $this->is_admin() ) {
			$admin_controller = new Controller\Admin( $this->file );
			$admin_controller->init();
		}
	}

	/**
	 * Check for admin context.
	 *
	 * @see Plugin::init()
	 *
	 * @return bool
	 */
	private function is_admin() {

		global $pagenow;

		if ( ! $pagenow ) {
			return FALSE;
		}

		$page_base = basename( $pagenow, '.php' );

		$pages = array(
			'post',
			'post-new',
		);

		return in_array( $page_base, $pages );
	}

}
