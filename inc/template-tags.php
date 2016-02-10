<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Ocin Lite
 */

if ( ! function_exists( 'ocin_lite_metadata' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function ocin_lite_metadata() {

	echo '<ul>';

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	echo '<li class="meta_date">' . $time_string . '</li>';

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'ocin-lite' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<li class="meta_comments">' . $byline . '</li>';

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<li class="meta_date"><span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'ocin-lite' ), esc_html__( '1 Comment', 'ocin-lite' ), esc_html__( '% Comments', 'ocin-lite' ) );
		echo '</span></li>';
	}

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() && is_single() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'ocin-lite' ) );
		if ( $categories_list && ocin_lite_categorized_blog() ) {
			printf( '<li class="meta_categories"><span class="cat-links">' . esc_html__( 'Posted in %1$s', 'ocin-lite' ) . '</span></li>', $categories_list ); // WPCS: XSS OK.
		}
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'ocin-lite' ) );
		if ( $tags_list ) {
			printf( '<li class="meta_tags"><span class="tags-links">' . esc_html__( 'Tagged %1$s', 'ocin-lite' ) . '</span></li>', $tags_list ); // WPCS: XSS OK.
		}
	}

	echo '</ul>';


}
endif;



/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function ocin_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'ocin_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'ocin_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so ocin_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so ocin_lite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in ocin_lite_categorized_blog.
 */
function ocin_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'ocin_lite_categories' );
}
add_action( 'edit_category', 'ocin_lite_category_transient_flusher' );
add_action( 'save_post',     'ocin_lite_category_transient_flusher' );
