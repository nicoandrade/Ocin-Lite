<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ocin Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-image">
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="ql_thumbnail_hover" rel="bookmark">
                <?php the_post_thumbnail( 'ocin_lite_post' ); ?>
            </a>
        </div><!-- /post-image -->
        <?php endif; ?>

        <div class="post-content">

			<header class="entry-header">
        		<?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        	</header><!-- .entry-header -->

        	<div class="entry-content">
				<?php
					the_content();
				?>

				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ocin-lite' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<div class="clearfix"></div>
			
			<?php if ( 'post' === get_post_type() ) : ?>
			<footer class="entry-footer">
				<div class="metadata">
	                <?php ocin_lite_metadata(); ?>
	                <div class="clearfix"></div>
	            </div><!-- /metadata -->
            </footer><!-- .entry-footer -->
            <?php endif; ?>


		</div><!-- /post_content -->
</article><!-- #post-## -->
