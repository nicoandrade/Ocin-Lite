<?php
/*
Template Name: Full Width
*/
?>
<?php
/**
 * The template for displaying a full width page (no sidebar).
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ocin Lite
 */

get_header(); ?>

	<div id="content" class="col-md-12">
		<div class="ql_background_padding">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>
		
			<div class="clearfix"></div>
		</div><!-- /ql_background -->

	</div><!-- /content -->

<?php get_footer(); ?>
