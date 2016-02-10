<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Ocin Lite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ocin_lite_body_classes( $classes ) {

    $ocin_lite_theme_data = wp_get_theme();

    $classes[] = sanitize_title( $ocin_lite_theme_data['Name'] );
    $classes[] = 'v' . $ocin_lite_theme_data['Version'];

	return $classes;
}
add_filter( 'body_class', 'ocin_lite_body_classes' );


if ( ! function_exists( 'ocin_lite_new_content_more' ) ){
    function ocin_lite_new_content_more($more) {
           global $post;
           return ' <br><a href="' . esc_url( get_permalink() ) . '" class="more-link read-more">' . esc_html__( 'Read more', 'ocin-lite' ) . ' <i class="fa fa-angle-right"></i></a>';
    }   
}// end function_exists
    add_filter( 'the_content_more_link', 'ocin_lite_new_content_more' );

