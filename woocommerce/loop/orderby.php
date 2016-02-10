<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="woocommerce-ordering">
	<ul class="orderby">
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<li <?php echo ( $orderby == $id ) ? 'class="active"' : ''; ?>><a href="<?php echo esc_url( '?orderby=' . $id ); ?>"><?php echo esc_html( $name ); ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>
