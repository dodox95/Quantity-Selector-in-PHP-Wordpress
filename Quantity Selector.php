<?php
/**
 * Plugin Name: My Quantity Add to Cart
 * Description: Adds quantity selector and add-to-cart button to products on various pages.
 * Version: 1.0
 * Author: Your Name
 * License: GPL-2.0+
 */

// Prevent direct file access
defined('ABSPATH') || exit;

/**
 * Add quantity selector and add-to-cart button to products.
 */
function my_quantity_add_to_cart() {
    global $product;

    $id = $product->get_id();
    $title = $product->get_title();
    $min_quantity = 1;
    $max_quantity = '';

    echo '
    <form class="cart btn-wrap clr" action="' . esc_url($product->add_to_cart_url()) . '" method="post" enctype="multipart/form-data">
        <div class="quantity">
            <label class="screen-reader-text" for="quantity_' . esc_attr($id) . '">Ilość ' . esc_attr($title) . '</label>
            <a href="javascript:void(0)" class="minus">-</a>
            <input type="number" id="quantity_' . esc_attr($id) . '" class="input-text qty text" name="quantity" value="' . esc_attr($min_quantity) . '" title="Ilość" size="4" min="' . esc_attr($min_quantity) . '" max="' . esc_attr($max_quantity) . '" step="1" placeholder="" inputmode="numeric" autocomplete="off">
            <a href="javascript:void(0)" class="plus">+</a>
        </div>
        <button type="submit" name="add-to-cart" value="' . esc_attr($id) . '" class="single_add_to_cart_button button alt wp-element-button">Dodaj</button>
    </form>
    ';

    echo '
    <style>
        .woocommerce ul.products .product .cart {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
        .woocommerce div.product form.cart {
            padding: 20px 0;
            border-top: 1px solid;
            border-bottom: 1px solid;
            margin-top: 20px;
            border-color: #eaeaea;
        }
    </style>
    ';
}
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_after_shop_loop_item', 'my_quantity_add_to_cart', 10);
