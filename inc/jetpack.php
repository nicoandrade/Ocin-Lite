<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Ocin Lite
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function ocin_lite_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'ocin_lite_infinite_scroll_render',
		'footer'    => 'page',
	) );

	//Enable Custom CSS
	if ( class_exists( 'Jetpack' ) ) {
        Jetpack::activate_module( 'custom-css', false, false );
    }

} // end function ocin_lite_jetpack_setup
add_action( 'after_setup_theme', 'ocin_lite_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function ocin_lite_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function ocin_lite_infinite_scroll_render



/**
 * Remove sharing from content
 */
function ocin_lite_remove_share() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
 
add_action( 'loop_start', 'ocin_lite_remove_share' );
