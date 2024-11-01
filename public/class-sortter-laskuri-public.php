<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://sortter.fi
 * @since      1.0.0
 *
 * @package    Sortter_Laskuri
 * @subpackage Sortter_Laskuri/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sortter_Laskuri
 * @subpackage Sortter_Laskuri/public
 * @author     Sampo Virmasalo <sampo.virmasalo@meiko.fi>
 */
class Sortter_Laskuri_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $sortter_laskuri    The ID of this plugin.
	 */
	private $sortter_laskuri;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $sortter_laskuri       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $sortter_laskuri, $version ) {

		$this->sortter_laskuri = $sortter_laskuri;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sortter_Laskuri_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sortter_Laskuri_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->sortter_laskuri, plugin_dir_url( __FILE__ ) . 'css/sortter-laskuri-public.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sortter_Laskuri_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sortter_Laskuri_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$sortterSourceLabel = $this->sortter_laskuri.'-source';
		wp_enqueue_script( $sortterSourceLabel, 'https://sortter.fi/plugin/sortter-plugin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->sortter_laskuri, plugin_dir_url( __FILE__ ) . 'js/sortter-laskuri-public.js', array( $sortterSourceLabel ), $this->version, true );

	}

	public function append_sortter_laskuri_to_end_of_dom() {
		require_once 'partials/' . $this->sortter_laskuri . '-public-display.php';
	}

}
