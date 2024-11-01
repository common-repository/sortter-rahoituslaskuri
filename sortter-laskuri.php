<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://sortter.fi
 * @since             1.0.0
 * @package           Sortter_Laskuri
 *
 * @wordpress-plugin
 * Plugin Name:       Sortter Rahoituslaskuri
 * Description:       Sortter Rahoituslaskuri - Add a free loan calculator to your website or webstore and lend your customers to send a free application and choose an affordable loan from the comparison.
 * Version:           1.1.0
 * Author:            Sortter Oy
 * Author URI:        https://sortter.fi
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SORTTER_LASKURI_VERSION', '1.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sortter-laskuri-activator.php
 */
function activate_sortter_laskuri() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sortter-laskuri-activator.php';
	Sortter_Laskuri_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sortter-laskuri-deactivator.php
 */
function deactivate_sortter_laskuri() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sortter-laskuri-deactivator.php';
	Sortter_Laskuri_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sortter_laskuri' );
register_deactivation_hook( __FILE__, 'deactivate_sortter_laskuri' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sortter-laskuri.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sortter_laskuri() {

	$plugin = new Sortter_Laskuri();
	$plugin->run();

}
run_sortter_laskuri();
