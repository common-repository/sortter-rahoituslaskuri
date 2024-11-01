<?php

/**
 * Fired during plugin activation
 *
 * @link       https://sortter.fi
 * @since      1.0.0
 *
 * @package    Sortter_Laskuri
 * @subpackage Sortter_Laskuri/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Sortter_Laskuri
 * @subpackage Sortter_Laskuri/includes
 * @author     Sampo Virmasalo <sampo.virmasalo@meiko.fi>
 */
class Sortter_Laskuri_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{	
		$sortter_page_content = null;
		ob_start();
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/sortter-laskuri-public-page-content.html';
		$sortter_page_content = ob_get_contents();
		ob_end_clean();
		if ($sortter_page_content === null or $sortter_page_content === false)	{
			$sortter_page_content = '';
		}
		$sortter_laskuri_kses_html = array(
			'h2' => array(),
			'h3' => array(),
			'p' => array(),
			'i' => array(),
			'strong' => array(),
			'ul' => array(),
			'li' => array(),
			/**
			 * @since 1.0.4
			 */
			'a' => array(
				'href' => array(),
				'title' => array()
			)
		);
		// Create post object
		$sortter_post = array(
			'post_title'    => wp_strip_all_tags('Sortter Rahoituslaskuri'),
			'post_content'  => wp_kses($sortter_page_content,$sortter_laskuri_kses_html),
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_type'     => 'page',
		);

		// Insert the post into the database
		$postID = wp_insert_post($sortter_post);
		// Insert default values into the database
		if (is_int($postID)):
			add_option('sortter-laskuri_page_id', $postID);
		endif;
		/**
		 * @since 1.1.0
		 */
		add_option('sortter-laskuri_seller_code', false);
		add_option('sortter-laskuri_default_time', 8);
		add_option('sortter-laskuri_default_sum', 14000);
		return $postID;
	}
}
