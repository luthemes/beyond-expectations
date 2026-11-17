<?php
/**
 * Inline SVG icons.
 *
 * Icons are SVG files in `public/svg` that are printed inline, so no icon font is loaded. The
 * social icons in `public/svg/social` are added to the social navigation menu by link.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations;

/**
 * Returns an inline SVG icon from `public/svg`, such as `search` or `social/facebook`. The
 * icon gets the classes `icon icon--{name}`. Returns an empty string for an unknown icon.
 *
 * @since  0.3.0
 * @access public
 * @param  string $name
 * @return string
 */
function svg( string $name ): string {

	$name = trim( $name, '/' );

	// Only plain icon names, so a name can't point outside the icons folder.
	if ( ! preg_match( '#^[a-z0-9-]+(/[a-z0-9-]+)?$#', $name ) ) {
		return '';
	}

	$file = get_parent_theme_file_path( "public/svg/{$name}.svg" );

	if ( ! is_readable( $file ) ) {
		return '';
	}

	$svg   = trim( (string) file_get_contents( $file ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$class = 'icon icon--' . basename( $name );

	// Give every icon the same classes, in place of the ones it was exported with.
	$svg = preg_replace( '/\sclass="[^"]*"/', '', $svg, 1 );
	$svg = preg_replace( '/^<svg/', '<svg class="' . esc_attr( $class ) . '"', $svg, 1 );

	return (string) apply_filters( "beyond-expectations/svg/{$name}", $svg );
}

/**
 * Prints an inline SVG icon.
 *
 * @since  0.3.0
 * @access public
 * @param  string $name
 * @return void
 */
function the_svg( string $name ): void {

	echo svg( $name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Returns the social icons available to the social menu. Keys are strings to look for in a menu
 * link's URL, and values are the icon names in `public/svg/social`.
 *
 * @since  0.3.0
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
		'feed'            => 'rss-square-solid',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'getpocket.com'   => 'getpocket',
		'github.com'      => 'github',
		'plus.google.com' => 'google-plus',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'mailto:'         => 'envelope-open-regular',
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
 * @since  0.3.0
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
			$icon = "social/{$name}";
			break;
		}
	}

	// The icon goes before the screen reader text that wraps the link text.
	return str_replace( $args->link_before, svg( $icon ) . $args->link_before, $item_output );

}, 10, 4 );
