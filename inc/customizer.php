<?php
/**
 * Ocin Lite Theme Customizer.
 *
 * @package Ocin Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ocin_lite_customize_register( $wp_customize ) {


	/**
	 * Control for the PRO buttons
	 */
	class ocin_lite_Pro_Version extends WP_Customize_Control{
		public function render_content()
		{
			$args = array(
				'a' => array(
					'href' => array(),
					'title' => array()
					),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				);
			echo wp_kses( $this->label, $args );
		}
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



	/*
    Colors
    ===================================================== */
    	$wp_customize->add_setting( 'ocin_lite_probtn_colors', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ) );
		$wp_customize->add_control( new ocin_lite_Display_Text_Control( $wp_customize, 'ocin_lite_probtn_colors', array(
			'section' => 'colors', // Required, core or custom.
			'label' => sprintf( __( 'Check out the <a href="%s" target="_blank">PRO version</a> to change Text, Links and Featured colors.', 'ocin-lite' ), 'https://www.quemalabs.com/theme/ocin/' ),
		) ) );



	/*
	Shop Categories selection
	------------------------------ */
	if ( class_exists( 'WooCommerce' ) && class_exists( 'Kirki' ) ){

		$wp_customize->add_section( 'ocin_lite_shop_options', array(
			'title' => esc_attr__( 'Shop Options', 'ocin-lite' ),
			'priority' => 120,
		) );

		$wp_customize->add_setting( 'ocin_lite_shop_categories', array( 'default' => array( '' ), 'sanitize_callback' => 'ocin_lite_sanitize_multicheck', 'type' => 'theme_mod' ) );
		$all_categories = get_categories( array(
		         'taxonomy'     => 'product_cat',
		) );
		$woo_categories = array();
		if ( $all_categories ) {
			foreach ( $all_categories as $cat ) {
				$woo_categories[$cat->slug] = $cat->name;
			}
		}
	    $wp_customize->add_control( new Kirki_Controls_MultiCheck_Control( $wp_customize, 'ocin_lite_shop_categories', array(
	        'label'   => esc_attr__( 'Shop Categories', 'ocin-lite' ),
	        'section' => 'ocin_lite_shop_options',
	        'choices' => $woo_categories,
	        'description' => esc_attr__( 'Select categories for the shop categories menu.', 'ocin-lite' ),
	    ) ) );


	    Kirki::add_field( 'ocin_lite_shop_products_amount', array(
		    'type'        => 'number',
		    'settings'    => 'ocin_lite_shop_products_amount',
		    'label'       => esc_attr__( "Number of products", 'ocin-lite' ),
		    'description' => esc_attr__( 'Number of products displayed per page.', 'ocin-lite' ),
		    'section'     => 'ocin_lite_shop_options',
		    'default'     => 12,
		) );


	}//if plugin exists


	/*
	PRO Version
	------------------------------ */
	$wp_customize->add_section( 'ocin_lite_pro_section', array(
		'title' => esc_attr__( 'PRO version', 'ocin-lite' ),
		'priority' => 160,
	) );
	$wp_customize->add_setting( 'ocin_lite_probtn', array( 'default' => '', 'sanitize_callback' => 'coni_sanitize_text', ) );
	$wp_customize->add_control( new ocin_lite_Display_Text_Control( $wp_customize, 'ocin_lite_probtn', array(
		'section' => 'ocin_lite_pro_section', // Required, core or custom.
		'label' => sprintf( __( 'Check out the PRO version for more features. %s View PRO version %s', 'ocin-lite' ), '<a target="_blank" class="button" href="https://www.quemalabs.com/theme/ocin/" style="width: 80%; margin: 10px auto; display: block; text-align: center;">', '</a>' ),
	) ) );
   




}
add_action( 'customize_register', 'ocin_lite_customize_register' );











/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ocin_lite_customize_preview_js() {
	
	wp_register_script( 'ocin_lite_customizer_preview', get_template_directory_uri() . '/js/customizer-preview.js', array( 'customize-preview' ), '20151024', true );
	wp_localize_script( 'ocin_lite_customizer_preview', 'wp_customizer', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'theme_url' => get_template_directory_uri(),
		'site_name' => get_bloginfo( 'name' )
	));
	wp_enqueue_script( 'ocin_lite_customizer_preview' );

}
add_action( 'customize_preview_init', 'ocin_lite_customize_preview_js' );


/**
 * Load scripts on the Customizer not the Previewer (iframe)
 */
function ocin_lite_customize_js() {
	
	wp_enqueue_script( 'ocin_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-controls' ), '20151024', true );

}
add_action( 'customize_controls_enqueue_scripts', 'ocin_lite_customize_js' );










/*
Sanitize Callbacks
*/

/**
 * Sanitize for post's categories
 */
function ocin_lite_sanitize_categories( $value ) {
    if ( ! array_key_exists( $value, ocin_lite_categories_ar() ) )
        $value = '';
    return $value;
}

/**
 * Sanitize return an non-negative Integer
 */
function ocin_lite_sanitize_integer( $value ) {
    return absint( $value );
}

/**
 * Sanitize URL
 */
function ocin_lite_sanitize_url( $url ) {
	return esc_url_raw( $url );
}

/**
 * Sanitize Boolean
 */
function ocin_lite_sanitize_bool( $string ) {
	return (bool)$string;
} 

/**
 * Sanitize Text with html
 */
function ocin_lite_sanitize_text_html( $str ) {
	$args = array(
			    'a' => array(
			        'href' => array(),
			        'title' => array()
			    ),
			    'br' => array(),
			    'em' => array(),
			    'strong' => array(),
			    'span' => array(),
			);
	return wp_kses( $str, $args );
}

/**
 * Sanitize array for multicheck
 * http://stackoverflow.com/a/22007205
 */
function ocin_lite_sanitize_multicheck( $values ) {

    $multi_values = ( ! is_array( $values ) ) ? explode( ',', $values ) : $values;
	return ( ! empty( $multi_values ) ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

/**
 * Sanitize GPS Latitude and Longitud
 * http://stackoverflow.com/a/22007205
 */
function ocin_lite_sanitize_lat_long( $coords ) {
	if ( preg_match( '/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?),[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $coords ) ) {
	    return $coords;
	} else {
	    return 'error';
	}
} 




/**
 * Display Text Control
 * Custom Control to display text
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	class ocin_lite_Display_Text_Control extends WP_Customize_Control {
		/**
		* Render the control's content.
		*/
		public function render_content() {

	        $wp_kses_args = array(
			    'a' => array(
			        'href' => array(),
			        'title' => array(),
			        'data-section' => array(),
			        'style' => array(),
			        'target' => array(),
			        'class' => array(),
			    ),
			    'br' => array(),
			    'em' => array(),
			    'strong' => array(),
			    'span' => array(),
			);
			$label = wp_kses( $this->label, $wp_kses_args );
	        ?>
			<p><?php echo $label; ?></p>		
		<?php
		}
	}
}



/*
* AJAX call to retreive an image URI by its ID
*/
add_action( 'wp_ajax_nopriv_ocin_lite_get_image_src', 'ocin_lite_get_image_src' );
add_action( 'wp_ajax_ocin_lite_get_image_src', 'ocin_lite_get_image_src' );

function ocin_lite_get_image_src() {
	$image_id = $_POST['image_id'];
	$image = wp_get_attachment_image_src( absint( $image_id ), 'full' );
	$image = $image[0];
	echo $image;
	die();
}
