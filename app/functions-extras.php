<?php
/**
 * Extras.
 *
 * Sets the views folder and loads the fonts.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations;

use function Backdrop\Fonts\enqueue;

/**
 * Sets the folder that views are loaded from. Backdrop looks in `resources/views` by default,
 * but this theme keeps its views in `public/views`.
 *
 * @since  0.0.1
 * @access public
 * @return string
 */
add_filter( 'backdrop/template/path', function() {

	return 'public/views';
} );

/**
 * Enqueues the local fonts from the Backdrop fonts package.
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {

	array_map( function( $file ) {
		enqueue( $file );
	}, [
		'merriweather-sans',
		'sanchez'
	] );
} );
