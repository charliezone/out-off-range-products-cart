<?php

/**
 * Plugin Name: Out off range products cart
 * Description: Show alert on out of range cart purchase
 * Version: 1.0
 * Author: Carlos Rafael
 * Author URI: https://www.linkedin.com/in/carlos-rafael-gonzalez-perdomo-457351146
 * License: GPL2
 */

require_once(dirname(__FILE__).'/include/cart-validation.php');

use Out_Off_Range_Products_Cart\Validator\CartValidation;

function oorpc_validate_add_cart_item( $passed, $product_id, $quantity, $variation_id = '', $variations= '' ) {


    $validation = new CartValidation(WC()->cart);

    /* var_dump( $validation->validateEcuador($product_id) );
    var_dump( $validation->validatePanama($product_id) );
    var_dump($validation->validateMaritimo($product_id));
    wp_die(); */

    if ( !$validation->validateEcuador($product_id) || !$validation->validatePanama($product_id) || !$validation->validateMaritimo($product_id) ){
        $passed = false;
        wc_add_notice( 'Usted no puede agregar más productos de este tipo porque incumple con las regulaciones aduanales', 'error' );
    }
    return $passed;

}

add_filter( 'woocommerce_add_to_cart_validation', 'oorpc_validate_add_cart_item', 10, 5 );