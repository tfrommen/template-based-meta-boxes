<?php # -*- coding: utf-8 -*-

namespace tf\TemplateBasedMetaBoxes\Models;

/**
 * Class Settings
 *
 * @package tf\TemplateBasedMetaBoxes\Models
 */
class Settings {

	/**
	 * @var array
	 */
	private $settings;

	/**
	 * Return the meta box settings.
	 *
	 * @return array
	 */
	public function get() {

		if ( isset( $this->settings ) ) {
			return $this->settings;
		}

		/**
		 * Filter the meta box settings.
		 *
		 * @param array $settings Meta box settings.
		 */
		$settings = apply_filters( 'template_based_meta_boxes', array() );
		if ( ! is_array( $settings ) ) {
			$this->settings = array();

			return $this->settings;
		}

		foreach ( $settings as $page_template => $meta_box_ids ) {
			if ( is_string( $meta_box_ids ) ) {
				$meta_box_ids = array(
					$meta_box_ids,
				);
			}

			if ( ! is_array( $meta_box_ids ) ) {
				continue;
			}

			foreach ( $meta_box_ids as $meta_box_id ) {
				if ( is_string( $meta_box_id ) ) {
					$this->settings[ $page_template ][ ] = $meta_box_id;
				}
			}
		}

		foreach ( $settings as $page_template => $meta_box_ids ) {
			$this->settings[ $page_template ] = array_unique( $meta_box_ids );
		}

		if (
			! isset( $this->settings[ 'default' ] )
			|| ! is_array( $this->settings[ 'default' ] )
		) {
			$this->settings[ 'default' ] = array();
		}

		return $this->settings;
	}

	/**
	 * Get the template based meta boxes.
	 *
	 * @param array $settings Optional. Meta box settings. Defaults to NULL.
	 *
	 * @return array
	 */
	public function get_meta_boxes( $settings = NULL ) {

		if ( ! is_array( $settings ) ) {
			$settings = $this->get();
		}

		$meta_boxes = array();
		foreach ( $settings as $meta_box_ids ) {
			$meta_boxes = array_merge( $meta_boxes, $meta_box_ids );
		}

		return array_unique( $meta_boxes );
	}

}
