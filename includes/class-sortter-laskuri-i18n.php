<?php
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.2
 * @package    Sortter_Laskuri
 * @subpackage Sortter_Laskuri/includes
 * @author     Sampo Virmasalo <sampo.virmasalo@meiko.fi>
 */
class Sortter_Laskuri_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sortter-rahoituslaskuri',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
