        <div id="content" class="col-md-12">
            <?php
            if ( ! is_shop() && ! is_product() && ! is_product_category() && ! is_product_tag() ) {
                echo '<div class="ql_background_padding">';
            }
            ?>
            

        
        <?php
        if ( ! is_shop() ) {
            the_archive_title( '<h1 class="page-title">', '</h1>' );
        }
        ?>

            <div class="ql_woocommerce_info">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ql_woocommerce_categories">
                            <ul>
                                <?php
                                $current_class = is_shop() ? "current" : "";
                                echo '<li class="' .  $current_class . '"><a href="' . esc_url( get_permalink( woocommerce_get_page_id( 'shop' ) ) ) . '">' . esc_html__( 'All', 'ocin-lite' ) . '</a></li>';

                                $ocin_lite_shop_categories = get_theme_mod( 'ocin_lite_shop_categories', '' );

                                if ( $ocin_lite_shop_categories ) {
                                    foreach ( $ocin_lite_shop_categories as $slug ) {

                                        $term = get_term_by( 'slug', $slug, 'product_cat' );

                                        // The $term is an object, so we don't need to specify the $taxonomy.
                                        $term_link = get_term_link( $slug, 'product_cat' );

                                        // If there was an error, continue to the next term.
                                        if ( is_wp_error( $term_link ) ) {
                                            continue;
                                        }
                                        $current_cat = is_product_category( $slug ) ? 'current' : '';
                                        // We successfully got a link. Print it out.
                                        echo '<li class="' . $current_cat . '"><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
                                    }
                                }

                                ?>
                            </ul>
                        </div>
                    </div>
            </div><!-- /woocommerce_info -->


		