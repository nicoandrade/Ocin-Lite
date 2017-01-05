<?php
//Add WooCommerce Support
add_action( 'after_setup_theme', 'ocin_lite_woocommerce_support' );
if (!function_exists('ocin_lite_woocommerce_support')) {
	function ocin_lite_woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}
}

//Change the default Before & After content
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'ocin_lite_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'ocin_lite_wrapper_end', 10);

if ( !function_exists( 'ocin_lite_wrapper_start' ) ) {
	function ocin_lite_wrapper_start() {
	  		if ( is_single() ) {
	  			get_template_part( "/template-parts/beforeloop", "woocommerce-single" ) ;
	  		}else{
	  			get_template_part( "/template-parts/beforeloop", "woocommerce" ) ;
	  		}
	}
}

if ( !function_exists( 'ocin_lite_wrapper_end' ) ) {
	function ocin_lite_wrapper_end() {
	  		if ( is_single() ) {
	  			get_template_part( "/template-parts/afterloop", "woocommerce-single" ) ;
	  		}else{
	  			get_template_part( "/template-parts/afterloop", "woocommerce" ) ;
	  		}
	}
}


/**
 * Removes the "shop" title on the main shop page
*/
function woo_hide_page_title() {
	return false;
}
add_filter( 'woocommerce_show_page_title' , 'woo_hide_page_title' );


/**
 * Remove Catalog Ordering on Shop Page
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


/**
 * Add wrapper for product thumbnail on content-product.php
 */
add_action( 'woocommerce_before_shop_loop_item_title', 'ocin_lite_wrapper_thumbnail_start', 8 );
add_action( 'woocommerce_before_shop_loop_item_title', 'ocin_lite_wrapper_thumbnail_end', 12 );
if ( !function_exists( 'ocin_lite_wrapper_thumbnail_start' ) ) {
	function ocin_lite_wrapper_thumbnail_start() {
		echo '<div class="product_thumbnail_wrap">';
	}
}
if ( !function_exists( 'ocin_lite_wrapper_thumbnail_end' ) ) {
	function ocin_lite_wrapper_thumbnail_end() {
	  		echo "</div>";
	}
}

/**
 * Place Add to cart button inside product_thumbnail_wrap
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 11 );


/**
 * Add wrapper for product text on content-product.php
 */
add_action( 'woocommerce_shop_loop_item_title', 'ocin_lite_wrapper_product_text_start', 8 );
add_action( 'woocommerce_after_shop_loop_item_title', 'ocin_lite_wrapper_product_text_end', 12 );
if ( !function_exists( 'ocin_lite_wrapper_product_text_start' ) ) {
	function ocin_lite_wrapper_product_text_start() {
		echo '<div class="product_text">';
	}
}
if ( !function_exists( 'ocin_lite_wrapper_product_text_end' ) ) {
	function ocin_lite_wrapper_product_text_end() {
	  		echo "</div>";
	}
}




// Removes the "Product Category:" from the Archive Title
add_filter( 'get_the_archive_title', function ( $title ) {
    if( is_tax() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
});

//Adds rating into the Product Thumbnail
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);




//Change the number of Related products
add_filter( 'woocommerce_output_related_products_args', 'ocin_lite_related_products_args' );
function ocin_lite_related_products_args( $args ) {
	$args['posts_per_page']     = 5; // 4 related products
	$args['columns']            = 5; // arranged in columns

	return $args;
}








//Remove categories from Single Product page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


//Remove Tabs from Single Product page
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);








/**
 * Define number of porducts to show per page
 */
$product_amout = get_theme_mod( 'ocin_lite_shop_products_amount', '12' );
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $product_amout . ';' ), 20 );


/**
 * Replace default thumbnail function
 */
if ( !function_exists( 'ocin_lite_template_loop_product_thumbnail' ) ) {
	function ocin_lite_template_loop_product_thumbnail() {
		//Get if this product is portrait
		$portrait_image = get_post_meta( get_the_ID(), '_portrait_image', true );
		//Default thumbnail size for WooCommerce
		$thumbnail_size = 'shop_catalog';

		//If portrait we use a different thumbnail size if not we use default one
		//"!is_product()" is to avoid portrait images in realted product section
		if ( ! empty( $portrait_image ) && 'yes' == $portrait_image && ! is_product() ) {
			$thumbnail_size = 'ocin_lite_shop_catalog_portrait';
		}
		echo woocommerce_get_product_thumbnail( $thumbnail_size );
		
		//Get one more image
		global $product;
		$attachment_ids = $product->get_gallery_attachment_ids();
		if ( $attachment_ids > 0 ) {
			$default_attr = array(
				'class'	=> "product_second_img"
			);
			$image = wp_get_attachment_image( $attachment_ids[0], $thumbnail_size, false, $default_attr );
			echo wp_kses_post( $image );
		}

	}
}
//Replace default thumbnail function for "ocin_lite_template_loop_product_thumbnail"
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'ocin_lite_template_loop_product_thumbnail', 10 );




/**
 * Adds custom WooCommerce field
 */
function ocin_lite_add_custom_general_fields() {

  global $woocommerce, $post;
  
  echo '<div class="options_group">';
  
	// Checkbox
	woocommerce_wp_checkbox( 
	array( 
		'id'            => '_portrait_image', 
		'wrapper_class' => 'show_if_simple', 
		'label'         => esc_attr__( 'Portrait image?', 'ocin-lite' ), 
		'description'   => esc_attr__( 'Select if you want to display this product in portrait.', 'ocin-lite' ) 
		)
	);
  
  echo '</div>';
	
}
/**
 * Saves custom WooCommerce field
 */
function ocin_lite_add_custom_general_fields_save( $post_id ){
	
	// Checkbox
	$woocommerce_checkbox = isset( $_POST['_portrait_image'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_portrait_image', $woocommerce_checkbox );

}
// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'ocin_lite_add_custom_general_fields' );
// Save Fields
add_action( 'woocommerce_process_product_meta', 'ocin_lite_add_custom_general_fields_save' );







/**
 * Updates the total with AJAX
 */
if (!function_exists('ocin_lite_header_add_to_cart_fragment')) {
	function ocin_lite_header_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
		<button href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" class="ql_cart-btn">
	        <?php echo wp_kses_post( WC()->cart->get_cart_total() ); ?>
	        <span class="count">(<?php echo esc_html( WC()->cart->cart_contents_count );?>)</span>
	        <i class="ql-bag"></i><i class="ql-chevron-down"></i>
	    </button>
		<?php
		
		$fragments['.ql_cart-btn'] = ob_get_clean();
		
		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ocin_lite_header_add_to_cart_fragment' );




if (!function_exists('ocin_lite_order_review_before')) {
	function ocin_lite_order_review_before() {
		?>
		<div class="row">
			<div class="col-md-6">
		<?php
	}
}
if (!function_exists('ocin_lite_order_review_after')) {
	function ocin_lite_order_review_after() {
		?>
		</div>
		<div class="col-md-6">
		<?php
	}
}
if (!function_exists('ocin_lite_checkout_payment_after')) {
	function ocin_lite_checkout_payment_after() {
		?>
			</div>
		</div>
		<?php
	}
}
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );
add_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 15 );
add_action( 'woocommerce_checkout_order_review', 'ocin_lite_order_review_before', 12 );
add_action( 'woocommerce_checkout_order_review', 'ocin_lite_order_review_after', 17 );
add_action( 'woocommerce_checkout_order_review', 'ocin_lite_checkout_payment_after', 25 );




//Remove prettyPhoto lightbox
add_action( 'wp_enqueue_scripts', 'ocin_lite_remove_woo_lightbox', 99 );
function ocin_lite_remove_woo_lightbox() {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
        wp_dequeue_script( 'prettyPhoto' );
        wp_dequeue_script( 'prettyPhoto-init' );
	}
}


/**
 * Adds portrait class to products
 */
function ocin_lite_add_portrait_class( $classes ) {

	if( 'product' == get_post_type() ){
		$portrait_image = get_post_meta( get_the_ID(), '_portrait_image', true );
		//If portrait we use a different column size for better fit on portrait image
		if ( ! empty( $portrait_image ) && 'yes' == $portrait_image ) {
			$classes[] = 'ql_portrait';
		}
	}
	return $classes;
}
add_filter( 'post_class', 'ocin_lite_add_portrait_class' );




/*
Single Product Hooks
============================================================*/
/**
 * HTML befor Single page images
 */
function ocin_lite_single_product_before_images(){
	//Get if this product is portrait
	$portrait_image = get_post_meta( get_the_ID(), '_portrait_image', true );
	//Default columns size for WooCommerce
	$col_width = 'col-md-7';
	//If portrait we use a different column size for better fit on portrait image
	if ( ! empty( $portrait_image ) && 'yes' == $portrait_image ) {
		$col_width = 'col-md-4 col-sm-5 col-md-offset-1';
	}
	?>
	<div class="clearfix"></div>
	<div class="row">
        <div class="<?php echo $col_width; ?>">
	<?php
}
add_action( 'woocommerce_before_single_product_summary', 'ocin_lite_single_product_before_images', 5 );

/**
 * HTML after Single page images
 */
function ocin_lite_single_product_after_images(){
	//Get if this product is portrait
	$portrait_image = get_post_meta( get_the_ID(), '_portrait_image', true );
	//Default columns size for WooCommerce
	$col_width = 'col-md-5';
	//If portrait we use a different column size for better fit on portrait image
	if ( ! empty( $portrait_image ) && 'yes' == $portrait_image ) {
		$col_width = 'col-md-6 col-sm-7 col-md-offset-1';
	}
	?>
	</div><!-- /col-md-7 -->
	<div class="<?php echo $col_width; ?>">
	<?php
}
add_action( 'woocommerce_before_single_product_summary', 'ocin_lite_single_product_after_images', 25 );


/**
 * HTML after Single page summary
 */
function ocin_lite_single_product_after_summary(){
	?>
		</div><!-- /col-md-5 -->
	</div><!-- /row -->
	<?php
}
add_action( 'woocommerce_after_single_product_summary', 'ocin_lite_single_product_after_summary', 5 );


/**
 * HTML wrap start for Single page summary
 */
function ocin_lite_single_product_wrap_start_summary(){
	?>
	<div class="summary-top">
		<?php woocommerce_breadcrumb(); ?>
		<?php woocommerce_template_single_rating(); ?>
		<div class="clearfix"></div>
	</div><!-- /summary-top -->
	<div class="entry">
	<?php
}
add_action( 'woocommerce_single_product_summary', 'ocin_lite_single_product_wrap_start_summary', 2 );


//Remove ratings from summary (they are added in summary top)
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );


/**
 * HTML wrap end for Single page summary
 */
function ocin_lite_single_product_wrap_end_summary(){
	?>
		<div class="variations_button_entry">
            <?php woocommerce_template_single_add_to_cart(); ?>
        </div>
	</div><!-- /entry -->
	<div class="summary-bottom">
        <div class="woocommerce-variation-add-to-cart variations_button">
        <?php 
        global $product;
        if ( 'variable' == $product->product_type ) { ?>
			<div class="quantity">
				<input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
			</div>
			<button class="single_add_to_cart_button button alt" type="submit"><?php esc_html_e( 'Add to cart', 'ocin-lite' ); ?></button>
			<?php }else{ ?>
			<?php woocommerce_template_single_add_to_cart(); ?>
			<?php } ?>
		</div>

        <div class="social-share">
        	<?php
        	if ( function_exists( 'sharing_display' ) ) {
			    sharing_display( '', true );
			}
        	 ?>
        </div>
    </div>
	<?php
}
add_action( 'woocommerce_single_product_summary', 'ocin_lite_single_product_wrap_end_summary', 60 );


//Remove add to cart button from summary (it's added at the bottom)
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

