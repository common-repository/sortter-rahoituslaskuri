<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://sortter.fi
 * @since      1.0.2
 *
 * @package    Sortter_Laskuri
 * @subpackage Sortter_Laskuri/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap" id="sortter-laskuri-admin">
    <header>
        <h1 class="wp-heading-inline"><?php _e('Sortter Rahoituslaskuri', 'sortter-rahoituslaskuri'); ?></h1>
    </header>
    <?php 
        // TODO: Make the ad wrapper somehow dynamic
    ?>
    <div id="ad-image-wrapper">
        <img id="srtr-ad-img" src="https://images.prismic.io/sortter/469e32f5-f414-44fb-a21c-ea55c953ace6_Miss-Suomi-Essi-Unkuri-Ahti-Ekholm-Sortter-1440x524-homepage-img.jpg?auto=compress%2Cformat&max-w=1920&max-h=740&fit=crop&crop=faces" />
    </div>
    <!--NEED THE settings_errors below so that the errors/success messages are shown after submission - wasn't working once we started using add_menu_page and stopped using add_options_page so needed this-->
    <?php settings_errors(); ?>
    <div style="background-color:white; padding:1em; box-sizing:border-box; max-width: 65ch;">
        <h2><?php _e('Käyttöohje - Sortter Rahoituslaskurin lisääminen sivustolle / verkkokauppaan', 'sortter-rahoituslaskuri'); ?></h2>
        <h3><?php _e('Automaattisesti luotu sivu', 'sortter-rahoituslaskuri'); ?></h3>
        <p><?php _e('Asentaessasi lisäosan, loimme sivuihisi automaattisesti uuden Sortter Rahoituslaskuri -sivun. Sivulle olemme kirjoittaneet valmiiksi tietoa rahoituksen kilpailuttamisesta Sortterin avulla. Luodulta sivulta löytyy lisäksi Sortter Rahoituslaskuri.', 'sortter-rahoituslaskuri');?></p>
        <hr>
        <h3>Sortter Rahoituslaskuri -<?php _e('lomake', 'sortter-rahoituslaskuri'); ?></h3>
        <p><?php _e('Kun haluat sivulle Sortter Rahoituslaskuri -lomakkeen, lisää alla oleva lyhytkoodi haluamallesi sivulle.', 'sortter-rahoituslaskuri');?></p>
        <pre style="background-color:#ddd; display:inline-block;">[sortter-form]</pre>
        <hr>
        <h3>Sortter Rahoituslaskuri -popup</h3>
        <p><?php _e('Kun haluat sivulle painikkeen joka aukaisee Sortter Rahoituslaskurin pop-upissa, lisää alla oleva lyhytkoodi haluamallesi sivulle.', 'sortter-rahoituslaskuri');?></p>
        <pre style="background-color:#ddd; display:inline-block;">[sortter-popup]</pre>
        <p><?php _e('Voit tyylitellä painiketta, käyttämällä seuraavia lyhytkoodin lisäasetuksia', 'sortter-rahoituslaskuri');?>:</p>
        <table>
            <tbody>
                <tr><td><b>bg (<?php _e('Taustaväri', 'sortter-rahoituslaskuri'); ?>):</b></td> <td><pre style="background-color:#ddd;display:inline;">[sortter-popup bg="red"]</pre></td></tr>
                <tr><td><b>color (<?php _e('Tekstin väri', 'sortter-rahoituslaskuri'); ?>):</b></td> <td><pre style="background-color:#ddd;display:inline;">[sortter-popup color="white"]</pre></td></tr>
                <tr><td><b>class (<?php _e('CSS-luokka', 'sortter-rahoituslaskuri'); ?>):</b></td> <td><pre style="background-color:#ddd;display:inline;">[sortter-popup class="button"]</pre></td></tr>
            </tbody>
        </table>
        <p><?php _e('Kaikkia asetuksia on mahdollista käyttää myös yhtäaikaisesti', 'sortter-rahoituslaskuri');?>.</p>
        <p><small><?php _e('Lue lisää lyhytkoodien käytöstä:', 'sortter-rahoituslaskuri');?> <a rel="noindex nofollow" href="https://wordpress.com/support/shortcodes/">WordPress.com:<?php _e('shortcodes', 'sortter-rahoituslaskuri'); ?></a></small></p>
    </div>
</div>