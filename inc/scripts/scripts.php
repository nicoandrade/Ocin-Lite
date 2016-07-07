<?php
	
	//HTML5 Shiv ==============================================
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js', array(), '3.7.3', true );
	//=================================================================

	//hoverIntent Plugin ==============================================
	wp_enqueue_script( 'hoverIntent' );
	//=================================================================

	//photoSwipe and UI Plugin ==============================================
	wp_enqueue_script( 'photoswipe-and-ui', get_template_directory_uri() . '/js/photoswipe-ui-default.js', array( 'jquery' ), '4.0.8', true );
	//=================================================================

	//Modernizr Plugin ================================================
	wp_enqueue_script( 'ocin_lite_modernizr', get_template_directory_uri() . '/js/modernizr.custom.67069.js', '2.8.3', true );
	//=================================================================
	
	//Pace  ===========================================================
	wp_enqueue_script( 'pace', get_template_directory_uri() . '/js/pace.js', array(), '0.2.0', true);
	//=================================================================

	//Imageloaded  ===========================================================
	wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.js', array(), '0.2.0', true);
	//=================================================================

	//Isotope  ===========================================================
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.js', array(), '0.2.0', true);
	//=================================================================

	//Packery Mode  ===========================================================
	wp_enqueue_script( 'packery-mode', get_template_directory_uri() . '/js/packery-mode.pkgd.js', array(), '0.2.0', true);
	//=================================================================
	
	//Owl Carousel  ===========================================================
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array(), '0.2.0', true);
	//=================================================================
	
	//Bootstrap JS ========================================
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array(), '3.3.5', true);
	//=================================================================
	
	//Comment Reply ===================================================
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	//=================================================================


	
	//Customs Scripts =================================================
	wp_enqueue_script( 'ocin_lite_theme-custom', get_template_directory_uri() . '/js/script.js', array( 'jquery', 'bootstrap' ), '1.0', true );
	//=================================================================

?>