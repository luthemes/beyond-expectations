<?php
/**
 * Filters.
 *
 * Theme filters and actions that change core output.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations;

use BeyondExpectations\Template\ErrorPage;
use BeyondExpectations\Tools\Config;
use BeyondExpectations\Tools\Mod;
use BeyondExpectations\Tools\Svg;

/**
 * Adds a "Continue reading" link to excerpts.
 *
 * @since  0.0.1
 * @access public
 * @return string
 */
add_filter( 'excerpt_more', function() {

	return sprintf(
		'&thinsp;&hellip;&thinsp;<a href="%s" class="entry__more-link">%s</a>',
		esc_url( get_permalink() ),
		sprintf(
			// Translators: %s is the post title for screen readers.
			esc_html__( 'Continue reading&nbsp;%s&nbsp;&rarr;', 'beyond-expectations' ),
			the_title( '<span class="screen-reader-text">', '</span>', false )
		)
	);
} );

/**
 * Adds error data for the 404 content view. Passes in the `ErrorPage` object as `$error`.
 *
 * @since  0.0.1
 * @access public
 * @param  \Backdrop\Tools\Collection  $data
 * @return \Backdrop\Tools\Collection
 */
add_filter( 'backdrop/view/content/data', function( $data ) {

	if ( is_404() ) {
		$data->add( 'error', new ErrorPage() );
	}

	return $data;
} );

/**
 * Adds the layout chosen in the customizer to the body class.
 *
 * @since  0.0.1
 * @access public
 * @param  array  $classes
 * @return array
 */
add_filter( 'body_class', function( $classes ) {

	$layout = (string) Mod::get( 'theme_global_layout' );

	$classes[] = 'layout-' . ( array_key_exists( $layout, Config::get( 'layouts' ) ) ? $layout : 'sidebar' );

	return $classes;
} );

/**
 * Adds the matching social icon in front of each link in the social menu. A link with no
 * matching icon gets a globe.
 *
 * @since  0.0.1
 * @access public
 * @param  string     $item_output
 * @param  \WP_Post   $item
 * @param  int        $depth
 * @param  \stdClass  $args
 * @return string
 */
add_filter( 'walker_nav_menu_start_el', function( $item_output, $item, $depth, $args ) {

	if ( ! isset( $args->theme_location ) || 'social-navigation' !== $args->theme_location ) {
		return $item_output;
	}

	$icon = 'globe';

	foreach ( Config::get( 'social-icons' ) as $url => $name ) {
		if ( false !== strpos( $item->url, $url ) ) {
			$icon = $name;
			break;
		}
	}

	// The icon goes before the screen reader text that wraps the link text.
	return str_replace( $args->link_before, Svg::render( $icon ) . $args->link_before, $item_output );

}, 10, 4 );

/**
 * Removes the "Display Site Title and Tagline" control. The title and tagline are always
 * part of the header, so the header text color is the only option.
 *
 * @since  0.0.1
 * @access public
 * @param  \WP_Customize_Manager  $manager
 * @return void
 */
add_action( 'customize_register', function( $manager ) {

	$manager->remove_control( 'display_header_text' );
}, 20 );

/**
 * Prints the emoji styles when the emoji script is kept but the styles were removed.
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
add_action( 'wp_head', function() {

	if ( has_action( 'wp_head', 'print_emoji_detection_script' ) && ! has_action( 'wp_print_styles', 'print_emoji_styles' ) ) {
		print_emoji_styles();
	}
}, 8 );
