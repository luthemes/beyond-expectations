<?php
/**
 * Theme options, customizer values and the clean up settings.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations;

use BeyondExpectations\Settings\Options;
use BeyondExpectations\Settings\Page;

use function Backdrop\app;

/**
 * Returns a customizer value (theme mod) and falls back to the theme's default.
 *
 * @since  0.0.1
 * @access public
 * @param  string  $name  layout, feature_image_size, footer_powered_by or footer_credit.
 * @return mixed
 */
function mod( string $name ) {

	$defaults = app()->resolve( 'beyond-expectations/settings' )['mods'];

	return get_theme_mod( "beyond_expectations_{$name}", $defaults[ $name ] ?? null );
}

/**
 * Returns the layouts that can be chosen in the customizer.
 *
 * @since  0.0.1
 * @access public
 * @return array
 */
function layouts(): array {

	return [
		'sidebar' => __( 'Content with sidebar', 'beyond-expectations' ),
		'full'    => __( 'Full width, no sidebar', 'beyond-expectations' ),
	];
}

/**
 * Returns the image sizes that can be chosen for a page's featured image.
 *
 * @since  0.0.1
 * @access public
 * @return array
 */
function feature_image_sizes(): array {

	return [
		'beyond-expectations-banner' => __( 'Banner (cropped)', 'beyond-expectations' ),
		'large'                      => __( 'Large', 'beyond-expectations' ),
		'full'                       => __( 'Full size', 'beyond-expectations' ),
	];
}

/**
 * Returns the chosen featured image size.
 *
 * @since  0.0.1
 * @access public
 * @return string
 */
function feature_image_size(): string {

	$size = (string) mod( 'feature_image_size' );

	return array_key_exists( $size, feature_image_sizes() ) ? $size : 'beyond-expectations-banner';
}

/**
 * Returns the footer credit that is shown when the "powered by" link is turned off.
 *
 * @since  0.0.1
 * @access public
 * @return string
 */
function footer_credit(): string {

	$credit = trim( (string) mod( 'footer_credit' ) );

	if ( '' === $credit ) {
		// Translators: 1 is the current year, 2 is a link to the site.
		$credit = sprintf( __( '&#169; %1$s %2$s', 'beyond-expectations' ), gmdate( 'Y' ), '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a>' );
	}

	return wp_kses( $credit, footer_credit_tags() );
}

/**
 * Returns the HTML that is allowed in the footer credit.
 *
 * @since  0.0.1
 * @access public
 * @return array
 */
function footer_credit_tags(): array {

	return [
		'a'      => [ 'href' => true, 'title' => true, 'rel' => true, 'target' => true ],
		'br'     => [],
		'em'     => [],
		'strong' => [],
	];
}

/**
 * Adds the layout class to the body.
 *
 * @since  0.0.1
 * @access public
 * @param  array  $classes
 * @return array
 */
add_filter( 'body_class', function( $classes ) {

	$layout = (string) mod( 'layout' );

	$classes[] = 'layout-' . ( array_key_exists( $layout, layouts() ) ? $layout : 'sidebar' );

	return $classes;
} );

/**
 * Returns the page chosen on the settings page to show on a 404, or null.
 *
 * @since  0.0.1
 * @access public
 * @return \WP_Post|null
 */
function error_page() {

	$id = absint( Options::get( 'error_page' ) );

	if ( ! $id ) {
		return null;
	}

	$post = get_post( $id );

	return $post && 'page' === $post->post_type && in_array( $post->post_status, [ 'publish', 'private' ], true ) ? $post : null;
}

/**
 * Boots the settings page and the clean up options.
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	if ( is_admin() ) {
		( new Page() )->boot();
	}

	if ( Options::get( 'disable_emoji' ) ) {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}

	if ( Options::get( 'disable_toolbar' ) ) {
		add_filter( 'show_admin_bar', '__return_false' );
	}

	// The embed script is added after scripts are enqueued, so remove it from the footer.
	if ( Options::get( 'disable_wp_embed' ) ) {
		add_action( 'wp_footer', function() {
			wp_dequeue_script( 'wp-embed' );
		} );
	}
}, 20 );
