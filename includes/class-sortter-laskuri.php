<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://sortter.fi
 * @since      1.0.3
 *
 * @package    Sortter_Laskuri
 * @subpackage Sortter_Laskuri/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.3
 * @package    Sortter_Laskuri
 * @subpackage Sortter_Laskuri/includes
 * @author     Sampo Virmasalo <sampo.virmasalo@meiko.fi>
 */
class Sortter_Laskuri {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.3
	 * @access   protected
	 * @var      Sortter_Laskuri_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $sortter_laskuri    The string used to uniquely identify this plugin.
	 */
	protected $sortter_laskuri;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.3
	 */
	public function __construct() {
		if ( defined( 'SORTTER_LASKURI_VERSION' ) ) {
			$this->version = SORTTER_LASKURI_VERSION;
		} else {
			$this->version = '1.0.4';
		}
		$this->sortter_laskuri = 'sortter-laskuri';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_shortcodes();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Sortter_Laskuri_Loader. Orchestrates the hooks of the plugin.
	 * - Sortter_Laskuri_i18n. Defines internationalization functionality.
	 * - Sortter_Laskuri_Admin. Defines all hooks for the admin area.
	 * - Sortter_Laskuri_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sortter-laskuri-loader.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sortter-laskuri-shortcodes.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sortter-laskuri-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-sortter-laskuri-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-sortter-laskuri-public.php';

		$this->loader = new Sortter_Laskuri_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Sortter_Laskuri_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Sortter_Laskuri_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	private function define_shortcodes() {
		$plugin_shortcodes = new Sortter_Laskuri_Shortcodes( $this->get_sortter_laskuri(), $this->get_version() );
		$this->loader->add_action( 'init', $plugin_shortcodes, 'add_sortter_shortcode' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Sortter_Laskuri_Admin( $this->get_sortter_laskuri(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Sortter_Laskuri_Public( $this->get_sortter_laskuri(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'append_sortter_laskuri_to_end_of_dom' );

	}


	
	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.2
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.2
	 * @return    string    The name of the plugin.
	 */
	public function get_sortter_laskuri() {
		return $this->sortter_laskuri;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.2
	 * @return    Sortter_Laskuri_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.2
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
