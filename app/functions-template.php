<?php
/**
 * Template tags.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations;

use BeyondExpectations\Tools\Svg;

use function Backdrop\app;

/**
 * Prints the author avatar, date, author and comments link for an entry.
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
function entry_posted_on() {

	$avatar_size = apply_filters( 'beyond_expectations_author_avatar_size', app()->resolve( 'beyond-expectations/settings' )['avatar_size'] );

	printf(
		'<span class="entry__byline"><span class="entry__avatar vcard">%1$s</span>',
		get_avatar( get_the_author_meta( 'user_email' ), $avatar_size ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	);

	printf(
		'<span class="entry__author"><span class="entry__label">%3$s</span><b>%2$s</b></span><span class="entry__published"><span class="entry__label">%4$s</span><b>%1$s</b></span>',
		sprintf(
			'<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry__date">%3$s</span></a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_html( get_the_date( 'F d, Y' ) )
		),
		sprintf(
			'<a href="%1$s" title="%2$s">%3$s</a>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			// Translators: %s is the author's name.
			esc_attr( sprintf( __( 'View all posts by %s', 'beyond-expectations' ), get_the_author() ) ),
			esc_html( get_the_author() )
		),
		esc_html__( 'Author', 'beyond-expectations' ),
		esc_html__( 'Published', 'beyond-expectations' )
	);

	if ( ! is_page() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="entry__comments-link"><span class="entry__label">' . esc_html__( 'Discussion', 'beyond-expectations' ) . '</span><b>';
		comments_popup_link( __( 'Leave a Comment', 'beyond-expectations' ) );
		echo '</b></span>';
	}
}

/**
 * Prints the category and tag lists for an entry.
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
function entry_taxonomies() {

	$cat_list = get_the_category_list( ' | ' );
	$tag_list = get_the_tag_list( '', ' | ' );

	if ( $cat_list ) {
		printf(
			'<div class="entry__categories">%3$s %1$s <span class="entry__category-list"><b><i>%2$s</i></b></span></div>',
			esc_html__( 'Posted In', 'beyond-expectations' ),
			$cat_list, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			Svg::render( 'folder' ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}

	if ( $tag_list ) {
		printf(
			'<div class="entry__tags">%3$s %1$s <span class="entry__tag-list"><b><i>%2$s</i></b></span></div>',
			esc_html__( 'Tagged', 'beyond-expectations' ),
			$tag_list, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			Svg::render( 'label' ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
}

/**
 * Prints the social navigation menu, if one is assigned.
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
function social_navigation() {

	if ( ! has_nav_menu( 'social-navigation' ) ) {
		return;
	}

	wp_nav_menu( [
		'theme_location'  => 'social-navigation',
		'container'       => 'div',
		'container_id'    => 'menu-social',
		// Chassis's `.social-menu` class, so the social icon row, icon size,
		// and alignment come from Chassis 0.2.1 (`07.components/07.social-menu`)
		// instead of the theme's own rules. The `menu_class` stays the theme's
		// own; Chassis's `.social-menu ul` matches any descendant `ul`.
		'container_class' => 'social-menu',
		'menu_id'         => 'menu-social-items',
		'menu_class'      => 'social-navigation__items',
		'depth'           => 1,
		'link_before'     => '<span class="screen-reader-text">',
		'link_after'      => '</span>',
		'fallback_cb'     => '',
	] );
}

/**
 * Returns a separator for meta lines, such as between a comment's date, edit link and reply
 * link.
 *
 * @since  0.0.1
 * @access public
 * @param  string  $sep
 * @return string
 */
function sep( $sep = '' ) {

	return apply_filters(
		'beyond-expectations/sep',
		sprintf(
			' <span class="sep">%s</span> ',
			$sep ?: esc_html_x( '&middot;', 'meta separator', 'beyond-expectations' )
		)
	);
}
