<?php

/*
* Plugin Name: Tm plugin prova
* Plugin URI: https://example.com/
* Description: Handle the basics with this plugin.
* Version: 1.0.0
* Requires at least: 5.2
* Requires PHP: 8.0
* Author: Taranzulla
* Author URI: https://author.example.com/
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Update URI: https://example.com/my-plugin/
* Text Domain: tm
* Domain Path: /languages
*/



// Blocca l'accesso diretto
if (!defined('ABSPATH')) {
    exit;
}

// Aggiungi un menu nel backend
add_action('admin_menu', 'my_custom_plugin_add_menu');

function my_custom_plugin_add_menu()
{
    add_menu_page(
        'My Custom Plugin',         // Titolo della pagina
        'Custom Plugin',            // Nome del menu
        'manage_options',           // Capacità richiesta
        'my-custom-plugin',         // Slug del menu
        'my_custom_plugin_page',    // Funzione per visualizzare la pagina
        'dashicons-admin-generic',  // Icona
        20                          // Posizione nel menu
    );
}

function my_custom_plugin_page()
{
?>
    <div class="wrap">
        <h1>My Custom Plugin</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('my_custom_plugin_options_group'); // Gruppo delle impostazioni
            do_settings_sections('my-custom-plugin');          // Mostra i campi della sezione
            submit_button();                                   // Bottone di salvataggio
            ?>
        </form>
    </div>
<?php
}

// Registro delle impostazioni
add_action('admin_init', 'my_custom_plugin_settings');

function my_custom_plugin_settings()
{
    register_setting('my_custom_plugin_options_group', 'my_custom_plugin_checkbox'); // Campo checkbox

    register_setting('my_custom_plugin_options_group', 'my_custom_plugin_option'); // Campo testo
    // my_custom_plugin_option nome usato nella tabella options del db

    // Sezione del form
    add_settings_section(
        'my_custom_plugin_section',      // ID
        'Impostazioni del Plugin',       // Titolo
        null,                            // Callback (facoltativa)
        'my-custom-plugin'               // Slug del menu
    );

    // Campo checkbox
    add_settings_field(
        'my_custom_plugin_checkbox_field', // ID del campo
        'Abilita opzione:',                // Etichetta
        'my_custom_plugin_checkbox_html', // Callback per il campo
        'my-custom-plugin',               // Slug del menu
        'my_custom_plugin_section'        // ID della sezione
    );

    // Campo testo
    add_settings_field(
        'my_custom_plugin_field',        // ID del campo
        'Inserisci un valore:',          // Etichetta
        'my_custom_plugin_field_html',  // Callback per il campo
        'my-custom-plugin',             // Slug del menu
        'my_custom_plugin_section'      // ID della sezione
    );
}

// Genera HTML del checkbox
function my_custom_plugin_checkbox_html()
{
    $checked = get_option('my_custom_plugin_checkbox', false);
    echo '<input type="checkbox" name="my_custom_plugin_checkbox" value="1" ' . checked(1, $checked, false) . ' />';
}

// Genera HTML del testo
function my_custom_plugin_field_html()
{
    $value = get_option('my_custom_plugin_option', '');
    echo '<input type="text" name="my_custom_plugin_option" value="' . esc_attr($value) . '" />';
}
