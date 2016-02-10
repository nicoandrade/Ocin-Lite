/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Logo
	wp.customize( 'ocin_lite_logo', function( value ) {
		value.bind( function( to ) {
			if ( to != "" ) {
				var logo = '<img src="' + to + '" />';
				$( '.logo_container .ql_logo' ).html( logo );		
			}else{
				$( '.logo_container .ql_logo' ).text( wp_customizer.site_name );
			}
		} );
	} );
	
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description, #jqueryslidemenu a' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );


	

	/*
    Colors
    =====================================================
    */
		//Featured Color
		wp.customize( 'ocin_lite_hero_color', function( value ) {
			value.bind( function( to ) {
				$( '.btn-ql, .pagination li.active a, .pagination li.active a:hover, .wpb_wrapper .products .product-category h3, .btn-ql:active, .btn-ql.alternative:hover, .btn-ql.alternative-white:hover, .btn-ql.alternative-gray:hover, .hero_bck, .ql_nav_btn:hover, .ql_nav_btn:active, .cd-popular .cd-select, .no-touch .cd-popular .cd-select:hover, .pace .pace-progress' ).css( {
						'background-color': to
				} );
				$( '.btn-ql, .pagination li.active a, .pagination li.active a:hover, .btn-ql:active, .btn-ql.alternative, .btn-ql.alternative:hover, .btn-ql.alternative-white:hover, .btn-ql.alternative-gray:hover, .hero_border, .pace .pace-activity' ).css( {
						'border-color': to 
				} );
				$( '.pagination .current, .pagination a:hover, .widget_recent_posts ul li h6 a, .widget_popular_posts ul li h6 a, .read-more, .read-more i, .btn-ql.alternative, .hero_color, .cd-popular .cd-pricing-header, .cd-popular .cd-currency, .cd-popular .cd-duration, #sidebar .widget ul li > a:hover, #sidebar .widget_recent_comments ul li a:hover' ).css( {
						'color': to
				} );
			} );
		} );

		//Text Color
		wp.customize( 'ocin_lite_text_color', function( value ) {
			value.bind( function( to ) {
				$( 'body' ).css( {
						'color': to
				} );
			} );
		} );
		//Link Color
		wp.customize( 'ocin_lite_link_color', function( value ) {
			value.bind( function( to ) {
				$( 'a' ).css( {
						'color': to
				} );
			} );
		} );



	//Shop Layout
	wp.customize( 'ocin_lite_shop_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'masonry' == to ) {
				$container_isotope.isotope( args_isotope );
			}else{
				$container_isotope.isotope('destroy');
			}
		} );
	} );





} )( jQuery );
