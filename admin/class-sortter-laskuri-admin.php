<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://sortter.fi
 * @since      1.0.2
 *
 * @package    Sortter_Laskuri
 * @subpackage Sortter_Laskuri/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sortter_Laskuri
 * @subpackage Sortter_Laskuri/admin
 * @author     Sampo Virmasalo <sampo.virmasalo@meiko.fi>
 */
class Sortter_Laskuri_Admin
{

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
	 * @param      string    $sortter_laskuri       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($sortter_laskuri, $version)
	{

		$this->sortter_laskuri = $sortter_laskuri;
		$this->version = $version;
		add_action('admin_menu', array($this, 'addPluginAdminMenu'), 9);
		add_action('admin_init', array($this, 'registerAndBuildFields'));
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

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

		wp_enqueue_style($this->sortter_laskuri, plugin_dir_url(__FILE__) . 'css/sortter-laskuri-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

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

		wp_enqueue_script($this->sortter_laskuri, plugin_dir_url(__FILE__) . 'js/sortter-laskuri-admin.js', array('jquery'), $this->version, false);
	}
	public function addPluginAdminMenu()
	{
		//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
		add_menu_page($this->sortter_laskuri, 'Sortter Rahoituslaskuri', 'administrator', $this->sortter_laskuri, array($this, 'displayPluginAdminDashboard'), 'dashicons-chart-area', 26);

		//add_submenu_page( '$parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
		add_submenu_page($this->sortter_laskuri, 'Sortter Rahoituslaskuri Settings', 'Settings', 'administrator', $this->sortter_laskuri . '-settings', array($this, 'displayPluginAdminSettings'));
	}
	public function displayPluginAdminDashboard()
	{
		require_once 'partials/' . $this->sortter_laskuri . '-admin-display.php';
	}
	public function displayPluginAdminSettings()
	{
		// set this var to be used in the settings-display view
		if (isset($_GET['error_message'])) {
			add_action('admin_notices', array($this, 'settingsPageSettingsMessages'));
			do_action('admin_notices', $_GET['error_message']);
		}
		require_once 'partials/' . $this->sortter_laskuri . '-admin-settings-display.php';
	}
	public function settingsPageSettingsMessages($error_message)
	{
		switch ($error_message) {
			case '1':
				$message = __('Asetuksen luomisessa tapahtui virhe - ole hyvä ja yritä uudelleen. Jos ongelma toistuu, ota yhteys lisäosan kehittäjään.', 'sortter-rahoituslaskuri');
				$err_code = esc_attr('sortter_laskuri_seller_code');
				$setting_field = esc_attr('sortter_laskuri_seller_code');
				break;
		}
		$type = 'error';
		add_settings_error(
			$setting_field,
			$err_code,
			$message,
			$type
		);
	}
	public function registerAndBuildFields()
	{
		/**
		 * First, we add_settings_section. This is necessary since all future settings must belong to one.
		 * Second, add_settings_field
		 * Third, register_setting
		 */
		add_settings_section(
			// ID used to identify this section and with which to register options
			'sortter_laskuri_general_section',
			// Title to be displayed on the administration page
			'',
			// Callback used to render the description of the section
			array($this, 'sortter_laskuri_display_general_account'),
			// Page on which to add this section of options
			'sortter_laskuri_general_settings'
		);

		$fields = array(
			"seller_code" => array(
				"title" => __('Kauppiastunnus', 'sortter-rahoituslaskuri'),
				"args" => array(
					"type" => "input",
					"subtype" => "text",
					"required" => false,
					"legend" => __('Esimerkiksi Y-tunnus', 'sortter-rahoituslaskuri')
				)
			),
			"default_time" => array(
				"title" => __('Laina-aika', 'sortter-rahoituslaskuri') . ' (' . __('vuotta', 'sortter-rahoituslaskuri') . ')',
				"args" => array(
					"type" => "input",
					"subtype" => "number",
					"min" => 1,
					"max" => 15,
					"step" => 1,
					"required" => false,
					"legend" => __('Vähintään', 'sortter-rahoituslaskuri') . ' 1 '. __(' vuosi', 'sortter-rahoituslaskuri') .' - ' . __('Enintään', 'sortter-rahoituslaskuri') . ' 15 '.__('vuotta', 'sortter-rahoituslaskuri'),
				)
			),
			"default_sum" => array(
				"title" => __('Summa', 'sortter-rahoituslaskuri') . ' (€)',
				"args" => array(
					"type" => "input",
					"subtype" => "number",
					"min" => 1,
					"max" => 60000,
					"required" => false,
					"legend" => __('Vähintään', 'sortter-rahoituslaskuri') . ' 500 - ' . __('Enintään', 'sortter-rahoituslaskuri') . ' 60 000'
				)
			)
		);

		unset($defaultArgs);
		$defaultArgs = array(
			'get_options_list' => '',
			'value_type' => 'normal',
			'wp_data' => 'option'
		);

		foreach ($fields as $field_key => $field_values) {
			/**
			 * Add_settings_field(ID, Title, Callback, Page, Section, Args)
			 */
			$fieldId = $this->sortter_laskuri . '_' . $field_key;
			$fieldName = $this->sortter_laskuri . '_' . $field_key;
			add_settings_field(
				$fieldId,
				$field_values["title"],
				array($this, 'sortter_laskuri_render_settings_field'),
				'sortter_laskuri_general_settings',
				'sortter_laskuri_general_section',
				array_merge(
					$defaultArgs,
					$field_values["args"],
					array("id" => $fieldId, "name" => $fieldName)
				)
			);

			register_setting(
				'sortter_laskuri_general_settings',
				$fieldId
			);
		}
	}
	public function sortter_laskuri_display_general_account()
	{
?>
		<p><?php esc_html_e('Aseta oletusarvot Sortter Rahoituslaskuriin:', 'sortter-rahoituslaskuri'); ?></p>
<?php
	}
	public function sortter_laskuri_render_settings_field($args)
	{
		/* EXAMPLE INPUT
		'type'      => 'input',
		'subtype'   => '',
		'id'    => $this->sortter_laskuri.'_example_setting',
		'name'      => $this->sortter_laskuri.'_example_setting',
		'required' => 'required="required"',
		'get_option_list' => "",
		'value_type' = serialized OR normal,
		'wp_data'=>(option or post_meta),
		'post_id' =>, 
		'legend' => 'field explanation text under the field',
		'prepend_value' => 'string that preceeds the field'
		*/

		if ($args['wp_data'] == 'option') {
			$wp_data_value = get_option($args['name']);
		} elseif ($args['wp_data'] == 'post_meta') {
			$wp_data_value = get_post_meta($args['post_id'], $args['name'], true);
		}
		$required = (isset($args['required']) and $args['required']) ? 'required' : '';
		// Only allow text or number inputs 
		if($args['subtype'] !== 'text' and $args['subtype'] !== 'number'): return null; endif;
		switch ($args['type']) {
			case 'input':
				$value = ($args['value_type'] == 'serialized') ? serialize($wp_data_value) : $wp_data_value;
					$step = (isset($args['step'])) ? 'step="'.$args['step'].'"' : '';
					$min = (isset($args['min'])) ? 'min="' . $args['min'] . '"' : '';
					$max = (isset($args['max'])) ? 'max="' . $args['max'] . '"' : '';
					if (isset($args['disabled'])) {
						// hide the actual input bc if it was just a disabled input the info saved in the database would be wrong - bc it would pass empty values and wipe the actual information
						/**
						 * Prepend settings outputs on disabled field
						 */
						if (isset($args['prepend_value'])):
							echo '<div class="input-prepend">';
							echo sprintf('<span data-for="%s_disabled" class="add-on">%s</span>', esc_attr($args["id"]),esc_html($args['prepend_value']));
						endif;

						echo sprintf(
							'<input type="%s" id="%s_disabled" %s %s %s %s name="%s_disabled" size="40" value="%s"  disabled>',
							esc_attr($args['subtype']),
							esc_attr($args['id']),
							esc_html($required),
							esc_html($step),
							esc_html($min),
							esc_html($max),
							esc_attr($args['name']),
							esc_attr($value)
						);

						/**
						 * Legend if exists
						 */
						if (isset($args['legend'])):
							echo sprintf('<span class="legend" data-for="%s">%s</span>',esc_attr($args["id"]), esc_html($args['legend']));
						endif;

						/**
						 * Close prepend
						 */
						if (isset($args['prepend_value'])):
							echo '</div>'; // Closing tag for the prepended input value
						endif;

					} else {
						/**
						 * Prepend settings outputs
						 */
						if (isset($args['prepend_value'])):
							echo '<div class="input-prepend">';
							echo sprintf('<span data-for="%s" class="add-on">%s</span>', esc_attr($args["id"]),esc_html($args['prepend_value']));
						endif;

						echo sprintf(
							'<input type="%s" id="%s" %s %s %s %s name="%s" size="40" value="%s">',
							esc_attr($args['subtype']),
							esc_attr($args['id']),
							esc_html($required),
							esc_html($step),
							esc_html($min),
							esc_html($max),
							esc_attr($args['name']),
							esc_attr($value)
						);

						/**
						 * Legend if exists
						 */
						if (isset($args['legend'])):
							echo sprintf('<span class="legend" data-for="%s">%s</span>',esc_attr($args["id"]), esc_html($args['legend']));
						endif;

						/**
						 * Close prepend
						 */
						if (isset($args['prepend_value'])):
							echo '</div>'; // Closing tag for the prepended input value
						endif;
					}
				break;
			default:
				// By default nothing gets outputted
				break;
		}
	}
}