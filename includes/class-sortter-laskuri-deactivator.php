<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://sortter.fi
 * @since      1.0.0
 *
 * @package    Sortter_Laskuri
 * @subpackage Sortter_Laskuri/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Sortter_Laskuri
 * @subpackage Sortter_Laskuri/includes
 * @author     Sampo Virmasalo <sampo.virmasalo@meiko.fi>
 */
class Sortter_Laskuri_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		$sortterPluginOptions = array(
			'sortter-laskuri_page_id',
			'sortter-laskuri_default_sum',
			'sortter-laskuri_default_time',
			'sortter-laskuri_seller_code'
		);
		// Delete sortter post and settings
		wp_delete_post(get_option('sortter-laskuri_page_id'));

		foreach ($sortterPluginOptions as $option_name) {
			delete_option($option_name);
		}
	}

}
