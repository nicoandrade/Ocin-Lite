<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ocin Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-image col-md-6">
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="ql_thumbnail_hover" rel="bookmark">
                <?php the_post_thumbnail( 'post_square' ); ?>
            </a>
        </div><!-- /post-image -->
        <?php endif; ?>

        <div class="post-content <?php if ( has_post_thumbnail() ) : echo 'col-md-6'; else: echo 'col-md-12'; endif;?> ">

			<header class="entry-header">
        		<?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        	</header><!-- .entry-header -->

        	<div class="entry-content">
				<?php
					the_excerpt();
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
	</div><!-- /row -->
</article><!-- #post-## -->

