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
	 * The filtered output is sanitized with `wp_kses()` before it is returned, so
	 * anything hooked to the `beyond-expectations/svg/{name}` filter cannot inject
	 * markup outside the SVG allowlist.
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

		$svg = (string) apply_filters( "beyond-expectations/svg/{$name}", $svg );

		return wp_kses( $svg, static::allowedTags() );
	}

	/**
	 * Returns the allowed SVG tags and attributes for sanitizing icon output.
	 *
	 * Covers the elements and attributes the theme's own icons and the Iconoir
	 * icons shipped by the Backdrop icons package actually use. No `script`
	 * elements, event-handler attributes, or `href`/`xlink:href` attributes
	 * are allowed — no icon uses them.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return array
	 */
	public static function allowedTags() {

		// Attributes on the `<svg>` element itself: those from the icon
		// files, plus the ones the icons package sets when rendering
		// (`width`, `height`, `class`, `aria-hidden`/`role`/`aria-label`,
		// `focusable`). The theme's Font Awesome brand icons also carry
		// `data-prefix` and `data-icon`.
		$svg_atts = [
			'xmlns'        => true,
			'viewBox'      => true,
			'width'        => true,
			'height'       => true,
			'class'        => true,
			'role'         => true,
			'aria-hidden'  => true,
			'aria-label'   => true,
			'focusable'    => true,
			'fill'         => true,
			'stroke'       => true,
			'stroke-width' => true,
			'data-prefix'  => true,
			'data-icon'    => true
		];

		// Attributes shared by the shape elements (`path`, `circle`, `rect`).
		$shape_atts = [
			'd'                => true,
			'fill'             => true,
			'stroke'           => true,
			'stroke-width'     => true,
			'stroke-linecap'   => true,
			'stroke-linejoin'  => true,
			'stroke-miterlimit'  => true,
			'stroke-dasharray'   => true,
			'fill-rule'        => true,
			'clip-rule'        => true,
			'transform'        => true,
			'class'            => true
		];

		return [
			'svg'      => $svg_atts,
			'path'     => $shape_atts,
			'circle'   => array_merge( $shape_atts, [
				'cx' => true,
				'cy' => true,
				'r'  => true
			] ),
			'rect'     => array_merge( $shape_atts, [
				'x'      => true,
				'y'      => true,
				'width'  => true,
				'height' => true,
				'rx'     => true
			] ),
			'g'        => array_merge( $shape_atts, [
				'clip-path' => true
			] ),
			'defs'     => [],
			'clipPath' => [
				'id' => true
			]
		];
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

		echo static::render( $name, $args );
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
