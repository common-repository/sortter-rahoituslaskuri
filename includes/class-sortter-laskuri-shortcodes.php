<?php 
class Sortter_Laskuri_Shortcodes {
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
	 * Renders the form version to selected location.
	 * TODO: Stylesheet directly from Sortter maybe?
	 * TODO: What about container sizes?
	 */
    public function sortter_create_form_shortcode($atts = [], $content = null, $tag = ''){

		// Get form template
		$sortter_laskuri_form_template = null;
		ob_start();
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sortter-laskuri-utm.php';
		$sortter_utm_query = Sortter_Laskuri_UTM_Generator::get_utm_query();
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/'.$this->sortter_laskuri . '-public-form-display.php';
		$sortter_laskuri_form_template = ob_get_contents();
		ob_end_clean();

		if(!is_string($sortter_laskuri_form_template) or $sortter_laskuri_form_template === null or $sortter_laskuri_form_template === false):
			$sortter_laskuri_form_template = '';
		endif;

        $sortter_laskuri_form_shortcode_html = '<div>';
		$sortter_laskuri_form_shortcode_html .= $sortter_laskuri_form_template;
        // enclosing tags
        if ( ! is_null( $content ) ) {
            // secure output by executing the_content filter hook on $content
            $sortter_laskuri_form_shortcode_html .= apply_filters( 'the_content', $content );
     
            // run shortcode parser recursively
            $sortter_laskuri_form_shortcode_html .= do_shortcode( $content );
        }
        $sortter_laskuri_form_shortcode_html .= '</div>';
        return $sortter_laskuri_form_shortcode_html;
    }
	/**
	 * Renders the Sortter button that opens the popup form created by the
	 * Sortter plugin script.
	 */
    public static function sortter_create_popup_shortcode($atts = [], $content = null, $tag = ''){
        // Complete example https://developer.wordpress.org/plugins/shortcodes/shortcodes-with-parameters/#complete-example
		
		/**
		 * The UTM query 
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sortter-laskuri-utm.php';
		$sortter_utm_query = Sortter_Laskuri_UTM_Generator::get_utm_query();

		/**
		 * Parse options for sortter calc
		 */
		$sortteDataAtts = array();
		$sortterDataAttsString = '';
		// Sortter popup script uses data-sortter-partner -attribute to form the utm-string for the submit button.
		// By extending this feature with a little string manipulation, we can use this feature 
		// to form the full utm-parameter set.
		$sortteDataAtts["data-sortter-partner"] = str_replace('utm_source=', '', $sortter_utm_query); 
		$sortteDataAtts["data-sortter-initial-period"] = get_option('sortter-laskuri_default_time', 11);
		$sortteDataAtts["data-sortter-initial-amount"] = get_option('sortter-laskuri_default_sum', 40000);
		foreach ($sortteDataAtts as $key => $value) {
			if ($value) {
				$sortterDataAttsString .= $key . '=' . esc_attr($value) . ' ';
			}
		}
		/**
		 * Button styling atts
		 */
		$sortter_atts_button_class = isset($atts['class']) ?  sprintf('class="%s" ', $atts['class']) : '';
		$sortter_atts_button_bg = isset($atts['bg']) ?  sprintf('background-color:%s; ', $atts['bg']) : '';
		$sortter_atts_button_text = isset($atts['color']) ?  sprintf('color:%s; ', $atts['color']) : '';
		$sortter_style_string = ($sortter_atts_button_bg !== '' or $sortter_atts_button_text !== '') ? sprintf('style="%s %s"', esc_html($sortter_atts_button_bg), esc_html($sortter_atts_button_text)) : '';

        $sortter_laskuri_popup_html = '';
		$sortter_laskuri_popup_html .= sprintf(
			'<button id="sortter-laskuri-popup-toggle" %s %s %s data-partner=%s>Avaa laskuri</button>',
			$sortterDataAttsString, 
			$sortter_style_string, 
			$sortter_atts_button_class, 
			esc_attr($sortteDataAtts["data-sortter-partner"])
		);
		// If button has colors set via shortcode atts, reset hovering shadow to dark.
		$sortter_laskuri_popup_html .= ($sortter_atts_button_bg !== '' or $sortter_atts_button_text !== '') ? '<style>#sortter-laskuri-popup-toggle:hover{ box-shadow: 0 4px 22px 0 rgba(0,0,0,.3);};</style>': '';
        // enclosing tags
        if ( ! is_null( $content ) ) {
            // secure output by executing the_content filter hook on $content
            $sortter_laskuri_popup_html .= apply_filters( 'the_content', $content );
     
            // run shortcode parser recursively
            $sortter_laskuri_popup_html .= do_shortcode( $content );
        }
        $sortter_laskuri_popup_html .= '';
        return $sortter_laskuri_popup_html;
    }

    public function add_sortter_shortcode() {
        add_shortcode('sortter-popup', array($this,'sortter_create_popup_shortcode'));
        add_shortcode('sortter-form', array($this,'sortter_create_form_shortcode'));
    }
}