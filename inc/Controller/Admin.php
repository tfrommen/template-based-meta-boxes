<?php # -*- coding: utf-8 -*-

namespace tf\TemplateBasedMetaBoxes\Controller;

use tf\TemplateBasedMetaBoxes\Model;

/**
 * Class Admin
 *
 * @package tf\TemplateBasedMetaBoxes\Controller
 */
class Admin {

	/**
	 * @var string
	 */
	private $file;

	/**
	 * Constructor. Set up properties.
	 *
	 * @see tf\TemplateBasedMetaBoxes\Plugin::init()
	 *
	 * @param string $file Main plugin file
	 */
	public function __construct( $file ) {

		$this->file = $file;
	}

	/**
	 * Wire admin-specific functions up.
	 *
	 * @see tf\TemplateBasedMetaBoxes\Plugin::init()
	 *
	 * @return void
	 */
	public function init() {

		$script = new Model\Script( $this->file );
		add_action( 'admin_footer', array( $script, 'enqueue' ) );
	}

}
