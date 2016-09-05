<?php
/**
 * Ocin Lite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ocin Lite
 */

if ( ! function_exists( 'ocin_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ocin_lite_setup() {

	/*
	 * Defines Constant
	 */
	$ocin_lite_theme_data = wp_get_theme();
	define( 'QL_STORE_URL', 'https://www.quemalabs.com' );
	define( 'QL_THEME_NAME', $ocin_lite_theme_data['Name'] );
	define( 'QL_THEME_VERSION', $ocin_lite_theme_data['Version'] );
	define( 'QL_THEME_SLUG', sanitize_title( $ocin_lite_theme_data['Name'] ) );
	define( 'QL_THEME_AUTHOR', $ocin_lite_theme_data['Author'] );
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Ocin Lite, use a find and replace
	 * to change 'ocin-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ocin-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	
	//Blog
	add_image_size( 'ocin_lite_post', 853, 480, true );
	add_image_size( 'ocin_lite_post_square', 457, 457, true );

	add_image_size( 'ocin_lite_shop_catalog_portrait', 348, 510, true );
	add_image_size( 'ocin_lite_shop_single_portrait', 581, 851, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'ocin-lite' ),
		'social' => esc_html__( 'Social Menu', 'ocin-lite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ocin_lite_custom_background_args', array(
		'default-color' => 'fafafa',
		'default-image' => '',
	) ) );

	// Add Logo support
	add_theme_support( 'custom-logo' );

	// Styles for TinyMCE
	$font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Lato:300,400,700' );
    add_editor_style( array( 'css/editor-style.css', 'css/bootstrap.css', $font_url )  );
	
}
endif; // ocin_lite_setup
add_action( 'after_setup_theme', 'ocin_lite_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ocin_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ocin_lite_content_width', 953 );
}
add_action( 'after_setup_theme', 'ocin_lite_content_width', 0 );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ocin_lite_widgets_init() {

	require get_template_directory() . '/inc/widget-areas/widget-areas.php';

}
add_action( 'widgets_init', 'ocin_lite_widgets_init' );



/**
 * Register widgets.
 *
 * @link https://codex.wordpress.org/Widgets_API
 */
function ocin_lite_widgets_register() {

	require get_template_directory() . '/inc/widgets/order-by.php';

}
add_action( 'widgets_init', 'ocin_lite_widgets_register' );



/**
 * Enqueue scripts and styles.
 */
function ocin_lite_scripts() {

	/**
	 * Enqueue Stylesheets
	 */
	require get_template_directory() . '/inc/scripts/stylesheets.php';

	/**
	 * Enqueue Scripts
	 */
	require get_template_directory() . '/inc/scripts/scripts.php';

}
add_action( 'wp_enqueue_scripts', 'ocin_lite_scripts' );




/**
 * Admin Styles
 *
 * Enqueue styles to the Admin Panel.
 */
function ocin_lite_wp_admin_style() {

	$current_screen = get_current_screen();
	if ( 'appearance_page_ocin_lite_theme-info' === $current_screen->id || 'customize'  === $current_screen->id ) {
		
        wp_register_style( 'ocin_lite_custom_wp_admin_css', get_template_directory_uri() . '/css/admin-styles.css', false, '1.0.0' );
        wp_enqueue_style( 'ocin_lite_custom_wp_admin_css' );

	}

}
add_action( 'admin_enqueue_scripts', 'ocin_lite_wp_admin_style' );




/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';



/**
 * Extras
 *
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';



/**
 * Customizer
 *
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';



/**
 * Customizer
 *
 * Customizer additions.
 */
require get_template_directory() . '/inc/theme-functions/woocommerce_support.php';



/**
 * Jetpack
 *
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 * Theme Functions
 *
 * Add Theme Functions
 */

	// Bootstrap Walker
	require get_template_directory() . '/inc/theme-functions/wp_bootstrap_navwalker.php';

	// Custom Header
	require get_template_directory() . '/inc/theme-functions/custom-header.php';

	// TGM Plugin Activation
	require get_template_directory() . '/inc/theme-functions/ql_tgm_plugin_activation.php';

	// Theme Info Page
	require get_template_directory() . '/inc/theme-functions/theme-info-page.php';
