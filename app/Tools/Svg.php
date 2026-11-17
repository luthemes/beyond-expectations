<?php
/**
 * SVG helper.
 *
 * Inline icons from the Backdrop icons package (Iconoir). The brand icons that Iconoir
 * doesn't have are SVG files in `public/svg/social-icons`, which are added to the package.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations\Tools;

use function Backdrop\Icons\icon;
use function Backdrop\Icons\icons;

/**
 * SVG class.
 *
 * @since  0.0.1
 * @access public
 */
class Svg {

	/**
	 * Returns an inline icon, with the theme's `icon` class. Returns an empty string for an
	 * unknown icon.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  string  $name
	 * @param  array   $args  Arguments for `Backdrop\Icons\icon()`.
	 * @return string
	 */
	public static function render( $name, array $args = [] ) {

		static $path_added = false;

		if ( ! $path_added ) {
			icons()->addPath( static::path() );
			$path_added = true;
		}

		$svg = icon( (string) $name, array_merge( [ 'class' => 'icon' ], $args ) );

		return apply_filters( "beyond-expectations/svg/{$name}", $svg );
	}

	/**
	 * Prints an inline icon.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  string  $name
	 * @param  array   $args
	 * @return void
	 */
	public static function display( $name, array $args = [] ) {

		echo static::render( $name, $args ); // phpcs:ignore
	}

	/**
	 * Returns the path to the theme's own icons.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  string  $file
	 * @return string
	 */
	public static function path( $file = '' ) {

		$file = trim( $file, '/' );

		return get_parent_theme_file_path( $file ? "public/svg/social-icons/{$file}" : 'public/svg/social-icons' );
	}
}
