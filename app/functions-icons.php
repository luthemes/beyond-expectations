<?php
/**
 * Inline SVG icons.
 *
 * Icons come from the Backdrop icons package (Iconoir) and are printed inline, so no icon font is
 * loaded. The social icons are added to the social navigation menu by link.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations;

use function Backdrop\Icons\icon;
use function Backdrop\Icons\icons;

/**
 * Adds the theme's own icons to the Backdrop icons package. The package bundles Iconoir, and the
 * brand icons that Iconoir doesn't have (Amazon, Reddit, Tumblr, Vimeo and so on) are SVG files
 * in `public/icons`.
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	icons()->addPath( get_parent_theme_file_path( 'public/icons' ) );
} );

/**
 * Returns an inline icon from the Backdrop icons package, with the theme's `icon` class so the
 * theme styles can reach it. Returns an empty string for an unknown icon.
 *
 * @since  0.0.1
 * @access public
 * @param  string $name
 * @param  array  $args
 * @return string
 */
function svg( string $name, array $args = [] ): string {

	return icon( $name, array_merge( [ 'class' => 'icon' ], $args ) );
}

/**
 * Prints an inline icon.
 *
 * @since  0.0.1
 * @access public
 * @param  string $name
 * @param  array  $args
 * @return void
 */
function the_svg( string $name, array $args = [] ): void {

	echo svg( $name, $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Returns the social icons available to the social menu. Keys are strings to look for in a menu
 * link's URL, and values are icon names.
 *
 * @since  0.0.1
 * @access public
 * @return array
 */
function social_icons(): array {

	return (array) apply_filters( 'beyond-expectations/social-icons', [
		'a.co'            => 'amazon',
		'amazon.com'      => 'amazon',
		'behance.net'     => 'behance',
		'codepen.io'      => 'codepen',
		'deviantart.com'  => 'deviantart',
		'digg.com'        => 'digg',
		'dribbble.com'    => 'dribbble',
		'dropbox.com'     => 'dropbox',
		'facebook.com'    => 'facebook',
		'feed'            => 'rss-feed',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'getpocket.com'   => 'pocket',
		'github.com'      => 'github',
		'plus.google.com' => 'google',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'mailto:'         => 'mail',
		'medium.com'      => 'medium',
		'pinterest.com'   => 'pinterest',
		'reddit.com'      => 'reddit',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		'slideshare.net'  => 'slideshare',
		'snapchat.com'    => 'snapchat',
		'soundcloud.com'  => 'soundcloud',
		'spotify.com'     => 'spotify',
		'stumbleupon.com' => 'stumbleupon',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter',
		'vimeo.com'       => 'vimeo',
		'vine.co'         => 'vine',
		'vk.com'          => 'vk',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'yelp.com'        => 'yelp',
		'youtube.com'     => 'youtube',
	] );
}

/**
 * Adds the matching social icon in front of each link in the social navigation menu. A link
 * with no matching icon gets a globe.
 *
 * @since  0.0.1
 * @access public
 * @param  string   $item_output
 * @param  \WP_Post $item
 * @param  int      $depth
 * @param  \stdClass $args
 * @return string
 */
add_filter( 'walker_nav_menu_start_el', function( $item_output, $item, $depth, $args ) {

	if ( ! isset( $args->theme_location ) || 'social-navigation' !== $args->theme_location ) {
		return $item_output;
	}

	$icon = 'globe';

	foreach ( social_icons() as $url => $name ) {
		if ( false !== strpos( $item->url, $url ) ) {
			$icon = $name;
			break;
		}
	}

	// The icon goes before the screen reader text that wraps the link text.
	return str_replace( $args->link_before, svg( $icon ) . $args->link_before, $item_output );

}, 10, 4 );
