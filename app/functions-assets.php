<?php
/**
 * Assets.
 *
 * Enqueues the styles and scripts built by Vite, with the Backdrop resources package.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations;

use function Backdrop\Resources\enqueue_script;
use function Backdrop\Resources\enqueue_style;

/**
 * Enqueue scripts/styles for the front end.
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {

	// Rather than enqueue the main style.css stylesheet, we are going to enqueue screen.css.
	enqueue_style( 'beyond-expectations-screen', 'resources/scss/screen.scss' );

	// Search toggle.
	enqueue_script( 'beyond-expectations-hide-search', 'resources/js/hide-search.js', [ 'jquery' ] );

	// Enqueue Navigation.
	enqueue_script( 'beyond-expectations-navigation', 'resources/js/navigation.js', [ 'jquery' ] );

	// Loads ClassicPress' comment-reply script where appropriate.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
} );

/**
 * Enqueue the customizer controls script, which hides controls whose active callback is
 * false (see `resources/js/customize-controls.js`).
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
add_action( 'customize_controls_enqueue_scripts', function() {

	enqueue_script( 'beyond-expectations-customize-controls', 'resources/js/customize-controls.js', [ 'customize-controls' ] );

	wp_add_inline_style( 'customize-controls', 'li.customize-control.beyond-expectations-control-inactive { display: none !important; }' );
} );
