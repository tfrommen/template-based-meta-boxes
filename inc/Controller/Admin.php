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
	 * Constructor. Init properties.
	 *
	 * @param string $file Main plugin file
	 */
	public function __construct( $file ) {

		$this->file = $file;
	}

	/**
	 * Initialize the class.
	 *
	 * @see tf\TemplateBasedMetaBoxes\Plugin::admin_init()
	 *
	 * @return void
	 */
	public function init() {

		$script = new Model\Script( $this->file );
		add_action( 'admin_footer', array( $script, 'enqueue' ) );
	}

}
