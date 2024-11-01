<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://sortter.fi
 * @since      1.0.2
 *
 * @package    PluginName
 * @subpackage PluginName/admin/partials
 */
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
	<div id="icon-themes" class="icon32"></div>  
	<h2><?php _e('Sortter Rahoituslaskuri - Kauppiasasetukset', 'sortter-rahoituslaskuri'); ?></h2>  
		<!--NEED THE settings_errors below so that the errors/success messages are shown after submission - wasn't working once we started using add_menu_page and stopped using add_options_page so needed this-->
		<form method="POST" action="options.php">
		<?php
		settings_fields('sortter_laskuri_general_settings');
		do_settings_sections('sortter_laskuri_general_settings');
		?>
		<?php submit_button(__('Tallenna asetukset', 'sortter-rahoituslaskuri')); ?>
	</form>
</div>