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
	 * Constructor. Set up the properties.
	 *
	 * @param string $file Main plugin file
	 */
	public function __construct( $file ) {

		$this->file = $file;
	}

	/**
	 * Initialize the plugin.
	 *
	 * @return void
	 */
	public function initialize() {

		if ( is_admin() ) {
			$text_domain = new Models\TextDomain( $this->file );
			$text_domain->load();

			$settings = new Models\Settings();

			$script = new Models\Script( $this->file, $settings );
			$script_controller = new Controllers\Script( $script );
			$script_controller->initialize();
		}
	}

}
