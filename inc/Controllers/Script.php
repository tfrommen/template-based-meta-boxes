<?php # -*- coding: utf-8 -*-

namespace tf\TemplateBasedMetaBoxes\Controllers;

use tf\TemplateBasedMetaBoxes\Models\Script as Model;

/**
 * Class Script
 *
 * @package tf\TemplateBasedMetaBoxes\Controllers
 */
class Script {

	/**
	 * @var Model
	 */
	private $model;

	/**
	 * Constructor. Set up the properties.
	 *
	 * @param Model $model Model.
	 */
	public function __construct( Model $model ) {

		$this->model = $model;
	}

	/**
	 * Wire up all functions.
	 *
	 * @return void
	 */
	public function initialize() {

		add_action( 'admin_print_scripts-post.php', array( $this->model, 'enqueue' ) );
		add_action( 'admin_print_scripts-post-new.php', array( $this->model, 'enqueue' ) );
	}

}
