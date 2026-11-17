<?php
/**
 * Custom header.
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
 * Adds custom header support.
 *
 * @since  0.3.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	$args = app()->resolve( 'beyond-expectations/settings' )['header'];

	$args['wp-head-callback'] = __NAMESPACE__ . '\\header_style';

	add_theme_support( 'custom-header', $args );
} );

/**
 * Outputs the header text color styles.
 *
 * @since  0.3.0
 * @access public
 * @return void
 */
function header_style() {

	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $text_color ) {
		return;
	}

	if ( ! display_header_text() ) {
		$css = '.header-image, .site-branding { display: none; }';
	} else {
		$css = sprintf( '.site-title a, .site-description { color: #%s; }', esc_attr( $text_color ) );
	}

	printf( '<style type="text/css">%s</style>' . "\n", $css ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
