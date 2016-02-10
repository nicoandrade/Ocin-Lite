<?php

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @see wp_add_inline_style()
 */
function ocin_lite_custom_css() {
	$heroColor = get_theme_mod( 'ocin_lite_hero_color', '#00b09a' );
	$text_color = get_theme_mod( 'ocin_lite_text_color', '#999999' );
	$link_color = get_theme_mod( 'ocin_lite_link_color', '#00b09a' );

	$colors = array(
		'heroColor'      => $heroColor,
		'text_color'     => $text_color,
		'link_color'     => $link_color,
	);

	$custom_css = ocin_lite_get_custom_css( $colors );

	wp_add_inline_style( 'ocin-lite-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'ocin_lite_custom_css' );



/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors colors.
 * @return string CSS.
 */
function ocin_lite_get_custom_css( $colors ) {

	//Default colors
	$colors = wp_parse_args( $colors, array(
		'heroColor'            => '',
		'text_color'            => '',
		'link_color'            => '',
	) );

	$css = <<<CSS


CSS;

	return $css;
}