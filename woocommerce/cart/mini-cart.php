<?php
    /**
     * Mini-cart
     *
     * Contains the markup for the mini-cart, used by the cart widget.
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://docs.woocommerce.com/document/template-structure/
     * @package WooCommerce/Templates
     * @version 3.7.0
     */

    defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ): ?>
<div class="widget_shopping_cart_calc">
    <div class="ql_carousel_btns">
        <a href="#" class="owl-prev"><i class="ql-chevron-left-circle"></i></a>
        <a href="#" class="owl-next"><i class="ql-chevron-right-circle"></i></a>
    </div>

    <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

    <p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>
    </p>

</div>
<?php endif; ?>



<ul
    class="cart_list product_list_widget owl-carousel products                                                                                                                                                                                                                                                                                                                       <?php echo $args['list_class']; ?>">

    <?php if ( ! WC()->cart->is_empty() ): ?>

    <?php

        do_action( 'woocommerce_before_mini_cart_contents' );

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

                $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
            ?>
    <li
        class="product<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
        <?php
            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                        '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                        esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                        __( 'Remove this item', 'ocin-lite' ),
                        esc_attr( $product_id ),
                        esc_attr( $_product->get_sku() )
                    ), $cart_item_key );
                ?>
        <?php if ( ! $_product->is_visible() ): ?>
        <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <?php else: ?>
        <a href="<?php echo esc_url( $product_permalink ); ?>" class="product_thumbnail_wrap">
            <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </a>
        <?php endif; ?>
        <div class="product_text">
            <h3><a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo esc_html( $product_name ); ?></a></h3>

            <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

            <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="price">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
        </div>

    </li>
    <?php
        }
        }
    ?>

    <?php else: ?>

    <li class="empty woocommerce-mini-cart__empty-message">
        <?php esc_html_e( 'No products in the cart.', 'ocin-lite' ); ?></li>

    <?php endif; ?>

    <?php do_action( 'woocommerce_mini_cart_contents' ); ?>

</ul><!-- end product list -->



<?php do_action( 'woocommerce_after_mini_cart' ); ?>