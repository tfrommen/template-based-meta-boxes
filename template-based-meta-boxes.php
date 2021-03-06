<?php # -*- coding: utf-8 -*-
/**
 * Plugin Name: Template-based Meta Boxes
 * Plugin URI:  https://github.com/tfrommen/template-based-meta-boxes
 * Description: Show or hide specific page meta boxes according to the currently selected page template.
 * Author:      Thorsten Frommen
 * Author URI:  http://ipm-frommen.de/wordpress
 * Version:     1.1.1
 * Text Domain: template-based-meta-boxes
 * Domain Path: /languages
 * License:     GPLv3
 */

namespace tf\TemplateBasedMetaBoxes;

use tf\Autoloader;

if ( ! function_exists( 'add_action' ) ) {
	return;
}

require_once __DIR__ . '/inc/Autoloader/bootstrap.php';

add_action( 'plugins_loaded', __NAMESPACE__ . '\initialize' );

/**
 * Initialize the plugin.
 *
 * @wp-hook plugins_loaded
 *
 * @return void
 */
function initialize() {

	$autoloader = new Autoloader\Autoloader();
	$autoloader->add_rule( new Autoloader\NamespaceRule( __DIR__ . '/inc', __NAMESPACE__ ) );

	$plugin = new Plugin( __FILE__ );
	$plugin->initialize();
}
