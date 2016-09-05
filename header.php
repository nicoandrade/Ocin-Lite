<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ocin Lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- WP_Head -->
<?php wp_head(); ?>
<!-- End WP_Head -->

</head>

<body <?php body_class(); ?>>
    <?php
    $header_image = "";
    if ( get_header_image() ){
        $header_image = 'style="background-image: url(' . get_header_image() . ');"';
    }
    ?>
	<header id="header" class="site-header" role="banner" <?php echo $header_image; ?>>
		<div class="container">
        	<div class="row">


                <div class="logo_container col-md-2 col-md-push-5">
                    <?php
                    $logo = '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home" class="ql_logo">' . get_bloginfo( 'name' ) . '</a>';
                    if ( has_custom_logo() ) {
                        $logo = get_custom_logo();
                    }
                    ?>
                    <?php if ( is_front_page() && is_home() ) : ?>
                        <h1 class="site-title"><?php echo $logo; ?></h1>
                    <?php else : ?>
                        <p class="site-title"><?php echo $logo; ?></p>
                    <?php endif; ?>

                    <button id="ql_nav_btn" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ql_nav_collapse" aria-expanded="false">
                        <i class="fa fa-navicon"></i>
                    </button>

                </div><!-- /logo_container -->


        		<div class="col-md-5 col-md-pull-2 col-sm-6">

                    <div class="collapse navbar-collapse" id="ql_nav_collapse">
                        <nav id="jqueryslidemenu" class="jqueryslidemenu navbar " role="navigation">
                            <?php
                            wp_nav_menu( array(                     
                                'theme_location'  => 'primary',
                                'menu_id' => 'primary-menu',
                                'depth'             => 3,
                                'menu_class'        => 'nav',
                                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                'walker'            => new wp_bootstrap_navwalker()
                            ));
                            ?>
                        </nav>
                    </div><!-- /ql_nav_collapse -->

                </div><!-- col-md-5 -->

                
                <?php 
                if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
                ?>
                    <div class="col-md-5 col-sm-6">
                        
                        <div class="ql_cart_wrap">
                            <button href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" class="ql_cart-btn"><?php echo wp_kses_post( WC()->cart->get_cart_total() ); ?> <span class="count">(<?php echo esc_html( WC()->cart->cart_contents_count ); ?>)</span> <i class="ql-bag"></i><i class="ql-chevron-down"></i></button>



                            <div id="ql_woo_cart">
                                <?php global $woocommerce; ?>
                                
                                <?php the_widget( 'WC_Widget_Cart' );  ?>
                            </div><!-- /ql_woo_cart --> 
                        </div>

                        <div class="login_btn_wrap">
                            <?php if ( is_user_logged_in() ) { ?>
                                <a class="ql_login-btn" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" title="<?php esc_attr_e( 'My Account', 'ocin-lite' ); ?>"><?php esc_html_e( 'My Account', 'ocin-lite' ); ?></a>
                             <?php } 
                             else { ?>
                                <a class="ql_login-btn" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e( 'Login', 'ocin-lite' ); ?>"><?php esc_html_e( 'Login', 'ocin-lite' ); ?></a>
                             <?php } ?>
                        </div><!-- /login_btn_wrap -->

                        <div class="clearfix"></div>
                    </div><!-- col-md-5 col-md-offset-2 -->
                <?php } //if WooCommerce active ?>





                <div class="clearfix"></div>

        	</div><!-- row-->
        </div><!-- /container -->
	</header>
    
	<div class="clearfix"></div>

    <div id="container" class="container">

        <main id="main" class="site-main row" role="main">