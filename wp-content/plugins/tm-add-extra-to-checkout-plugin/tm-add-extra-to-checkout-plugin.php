<?php

/*
* Plugin Name: TM Add extra to checkout plugin
* Plugin URI: https://example.com/
* Description: Add extra checkbox into checkout plugin
* Version: 1.0.0
* Requires at least: 5.2
* Requires PHP: 8.0
* Author: Matteo Tarabini
* Author URI: https://www.tiemme.cloud/
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Update URI: https://example.com/my-plugin/
* Text Domain: AEC
* Domain Path: /languages
*/



// Blocca l'accesso diretto
if (!defined('ABSPATH')) {
    exit;
}



// Aggiungi JavaScript alla pagina
add_action('admin_enqueue_scripts', 'AEC_custom_plugin_enqueue_scripts');

function AEC_custom_plugin_enqueue_scripts($hook)
{
    // Controlla che il file sia caricato solo nella pagina del plugin
    if ($hook !== 'toplevel_page_AEC-custom-plugin') {
        return;
    }

    // Registra e aggiungi lo script JavaScript
    wp_enqueue_script(
        'aec-custom-plugin-script',
        plugins_url('/js/aec-custom-plugin.js', __FILE__), // Percorso del file JS
        array('jquery'), // Dipendenze
        '1.0',
        true
    );
}

// Aggiungi un menu nel backend
add_action('admin_menu', 'AEC_custom_plugin_add_menu');

function AEC_custom_plugin_add_menu()
{
    add_menu_page(
        'Add Extra Checkbox plugin',         // Titolo della pagina
        'Add Checkbox',                 // Nome del menu
        'manage_options',                // Capacità richiesta
        'AEC-custom-plugin',             // Slug del menu
        'AEC_custom_plugin_page',         // Funzione per visualizzare la pagina
        'dashicons-yes-alt',             // Icona
        20                               // Posizione nel menu
    );
}

// HTML della pagina del plugin
function AEC_custom_plugin_page()
{
?>
    <div class="wrap">
        <h1>Aggiungi checkbox extra al checkout di woo</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('AEC_custom_plugin_options_group'); // Gruppo delle impostazioni
            do_settings_sections('AEC-custom-plugin');          // Mostra i campi della sezione
            submit_button();                                   // Bottone di salvataggio
            ?>
        </form>
    </div>
<?php
}

// Registro delle impostazioni
add_action('admin_init', 'AEC_custom_plugin_settings');

function AEC_custom_plugin_settings()
{
    register_setting('AEC_custom_plugin_options_group', 'AEC_custom_plugin_checkbox'); // Campo checkbox

    register_setting('AEC_custom_plugin_options_group', 'AEC_custom_plugin_option'); // Campo testo
    // AEC_custom_plugin_option nome usato nella tabella options del db

    // Sezione del form
    add_settings_section(
        'AEC_custom_plugin_section',      // ID
        'Impostazioni del Plugin',       // Titolo
        null,                            // Callback (facoltativa)
        'AEC-custom-plugin'               // Slug del menu
    );

    // Campo checkbox
    add_settings_field(
        'AEC_custom_plugin_checkbox_field', // ID del campo
        'Abilita il checkbox nella pagina checkout:',                // Etichetta
        'AEC_custom_plugin_checkbox_html', // Callback per il campo
        'AEC-custom-plugin',               // Slug del menu
        'AEC_custom_plugin_section'        // ID della sezione
    );

    // Campo testo
    add_settings_field(
        'AEC_custom_plugin_field',        // ID del campo
        'Descrizione da attribuire al checkbox:',          // Etichetta
        'AEC_custom_plugin_field_html',  // Callback per il campo
        'AEC-custom-plugin',             // Slug del menu
        'AEC_custom_plugin_section'      // ID della sezione
    );
}

// Genera HTML del checkbox
function AEC_custom_plugin_checkbox_html()
{
    $checked = get_option('AEC_custom_plugin_checkbox', false);
    echo '<input type="checkbox" name="AEC_custom_plugin_checkbox" id="tmCheckbox" value="1" ' . checked(1, $checked, false) . ' />';
}

// Genera HTML del testo
function AEC_custom_plugin_field_html()
{
    $labelCheck = get_option('AEC_custom_plugin_option', '');
    echo '<input type="text" name="AEC_custom_plugin_option" id="tmTesto" value="' . esc_attr($labelCheck) . '" />';
}



add_filter('the_content', 'aggiungi_contenuto_sotto_titolo');
function aggiungi_contenuto_sotto_titolo($content)
{
    $checked = get_option('AEC_custom_plugin_checkbox', false);
    if (!$checked) return $content;
    $labelCheck = get_option('AEC_custom_plugin_option', '');
    // Esegui solo per le pagine
    //     if (is_page() && in_the_loop() && is_main_query()) {
    // Contenuto personalizzato da aggiungere
    $contenuto_personalizzato = "<div><input type='checkbox' id='customCheck'> ";
    $contenuto_personalizzato .= "<label for='customCheck'>" . esc_attr($labelCheck) . "</label>";
    $contenuto_personalizzato .= "</div>";

    // Restituisci il contenuto personalizzato prima del contenuto originale
    return $contenuto_personalizzato . $content;
    //  }
    return $content;
}
