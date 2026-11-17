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

use function Backdrop\app;

/**
 * Prints the author avatar, date, author and comments link for an entry.
 *
 * @since  0.3.0
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
		'<span class="entry__author"><b>%2$s</b></span><span class="entry__published"><b>%1$s</b></span>',
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
		)
	);

	if ( ! is_page() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="entry__comments-link"><b>';
		comments_popup_link( __( 'Leave a Comment', 'beyond-expectations' ) );
		echo '</b></span>';
	}
}

/**
 * Prints the category and tag lists for an entry.
 *
 * @since  0.3.0
 * @access public
 * @return void
 */
function entry_taxonomies() {

	$cat_list = get_the_category_list( ' | ' );
	$tag_list = get_the_tag_list( '', ' | ' );

	if ( $cat_list ) {
		printf(
			'<div class="entry__categories"><i class="fa fa-folder-open-o"></i> %1$s <span class="entry__category-list"><b><i>%2$s</i></b></span></div>',
			esc_html__( 'Posted In', 'beyond-expectations' ),
			$cat_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}

	if ( $tag_list ) {
		printf(
			'<div class="entry__tags"><i class="fa fa-tags"></i> %1$s <span class="entry__tag-list"><b><i>%2$s</i></b></span></div>',
			esc_html__( 'Tagged', 'beyond-expectations' ),
			$tag_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
}

/**
 * Prints the social navigation menu, if one is assigned.
 *
 * @since  0.3.0
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
		'container_class' => 'social-navigation__menu',
		'menu_id'         => 'menu-social-items',
		'menu_class'      => 'social-navigation__items',
		'depth'           => 1,
		'link_before'     => '<span class="screen-reader-text">',
		'link_after'      => '</span>',
		'fallback_cb'     => '',
	] );
}
