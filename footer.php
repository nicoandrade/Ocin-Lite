<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ocin Lite
 */

?>

        </main><!-- #main -->

    </div><!-- /#container -->

	<div class="sub-footer">
        <div class="container">
            <div class="row">

                <div class="col-md-5">
                    <p>&copy; Copyright <?php echo date('Y'); ?> <a rel="nofollow" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( bloginfo( 'name' ) ); ?></a> - 
                        <?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'ocin-lite' ), 'Ocin Lite', '<a href="https://www.quemalabs.com/" rel="designer">Quema Labs</a>' ); ?>
                    </p>
                </div>
                <div class="col-md-7">
                    <?php get_template_part( '/template-parts/social-menu', 'footer' ); ?>
                </div>

            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .sub-footer -->


<?php wp_footer(); ?>

</body>
</html>