<?php 

/**
 * Called from public side of plugig
 *
 * Handles UTM models for the plugin
 *
 * @since      1.0.3
 * @package    Sortter_Laskuri
 * @subpackage Sortter_Laskuri/includes
 * @author     Sampo Virmasalo <sampo.virmasalo@meiko.fi>
 */

class Sortter_Laskuri_UTM_Generator {

    /**
	 * Retrieve the utm query string
	 * @since	1.0.3
	 * @return	string	query string with utm-paramteres
	 */
	public static function get_utm_query() {
		$utmTerm = get_option('sortter-laskuri_seller_code') ? get_option('sortter-laskuri_seller_code') : 'seller-code-missing';
		return sprintf(
			'utm_source=%s&utm_medium=%s&utm_campaign=%s&utm_term=%s',
			urlencode($_SERVER['HTTP_HOST']),
			'partners',
			'rahoituslaskuri',
			$utmTerm
		);
	}

}

?>