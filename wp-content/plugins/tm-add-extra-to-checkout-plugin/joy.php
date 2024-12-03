<?php

/*********************************** JOY ******************************************* */


if (apply_filters('wpml_current_language', null) == "it") {
    //	add_action( 'woocommerce_review_order_before_submit', 'bt_add_checkout_checkbox', 1 );
    add_action('woocommerce_review_order_before_payment', 'bt_add_checkout_checkbox', 1);
}
function bt_add_checkout_checkbox()
{
    woocommerce_form_field('checkout_checkbox', array( // CSS ID
        'type'          => 'checkbox',
        'class'         => array('form-row mycheckbox'), // CSS Class
        'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
        'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
        'required'      => false, // Mandatory or Optional
        'label'         => '🎁 È un regalo',
    ));
}





// Add custom field as order meta with field value to database
add_action('woocommerce_checkout_update_order_meta', 'bt_checkout_field_order_meta_db');
function bt_checkout_field_order_meta_db($order_id)
{
    if (! empty($_POST['checkout_checkbox'])) {
        update_post_meta($order_id, 'checkout_checkbox', sanitize_text_field($_POST['checkout_checkbox']));
    }
}


// Display field value on the backend WooCOmmerce order
function bt_checkout_field_display_admin_order_meta($order)
{
    $response = get_post_meta($order->get_id(), 'checkout_checkbox', true) ? "<span style='font-size:1.2em; font-weight:800; color:red;'>SI</span>" : "NO";
    echo '<p><strong>' . __('È un regalo') . ':</strong> ' . $response . '<p>';
}


// To display the field in emails:
add_filter('woocommerce_email_order_meta_keys', 'bt_custom_order_meta_email');
function bt_custom_order_meta_email($keys)
{
    $keys[] = 'checkout_checkbox'; // This will look for a custom field called 'checkout_checkbox' and add it to WooCommerce emails
    return $keys;
}
