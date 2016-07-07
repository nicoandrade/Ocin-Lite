<?php
	//Bootstrap =======================================================
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.1', 'all');
	//=================================================================

	//Owl Carousel =======================================================
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), '1.1.1', 'all');
	//=================================================================

	//Photoswipe ======================================================
	wp_enqueue_style( 'photoswipe', get_template_directory_uri() . '/css/photoswipe.css', array(), '2.0.0', 'all' );  
	//=================================================================

	//Photoswipe Skin ======================================================
	wp_enqueue_style( 'photoswipe-skin', get_template_directory_uri() . '/css/default-skin/default-skin.css', array(), '2.0.0', 'all' );  
	//=================================================================

	//Google Font =======================================================
	wp_enqueue_style( 'ocin_lite_google-font', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), '1.0', 'all');
	//=================================================================


	wp_enqueue_style( 'ocin_lite_style', get_stylesheet_uri() );

?>