<?php
/**
 * Assets.
 *
 * Enqueues the styles and scripts built by Vite (see `app/Vite`).
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations;

use function BeyondExpectations\Vite\asset;

/**
 * Enqueue scripts/styles for the front end.
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {

	// Rather than enqueue the main style.css stylesheet, we are going to enqueue screen.css.
	wp_enqueue_style( 'beyond-expectations-screen', asset( 'resources/scss/screen.scss' ), null, null );

	// Search toggle.
	wp_enqueue_script( 'beyond-expectations-hide-search', asset( 'resources/js/hide-search.js' ), [ 'jquery' ], null, true );

	// Enqueue Navigation.
	wp_enqueue_script( 'beyond-expectations-navigation', asset( 'resources/js/navigation.js' ), [ 'jquery' ], null, true );

	// Screen reader text for the child menu toggles.
	wp_localize_script( 'beyond-expectations-navigation', 'screenReaderText', [
		'expand'   => '<span class="screen-reader-text">' . esc_html__( 'expand child menu', 'beyond-expectations' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . esc_html__( 'collapse child menu', 'beyond-expectations' ) . '</span>',
	] );

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

	wp_enqueue_script( 'beyond-expectations-customize-controls', asset( 'resources/js/customize-controls.js' ), [ 'customize-controls' ], null, true );

	wp_add_inline_style( 'customize-controls', 'li.customize-control.beyond-expectations-control-inactive { display: none !important; }' );
} );
