<?php
/**
 * Enqueue scripts and styles.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations;

use Backdrop\Fonts;

/**
 * Enqueue scripts and styles.
 *
 * @link   https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @link   https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 *
 * @since  0.3.0
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {

	// Local fonts from the Backdrop fonts package.
	Fonts\enqueue( 'merriweather-sans' );
	Fonts\enqueue( 'sanchez' );

	// The built stylesheet. The theme's style.css only holds the theme header.
	if ( asset( 'resources/scss/screen.scss' ) ) {
		wp_enqueue_style( 'beyond-expectations-screen', asset( 'resources/scss/screen.scss' ), [], null );
	}

	// Search toggle and navigation scripts.
	if ( asset( 'resources/js/hide-search.js' ) ) {
		wp_enqueue_script( 'beyond-expectations-hide-search', asset( 'resources/js/hide-search.js' ), [ 'jquery' ], null, true );
	}

	if ( asset( 'resources/js/navigation.js' ) ) {
		wp_enqueue_script( 'beyond-expectations-navigation', asset( 'resources/js/navigation.js' ), [ 'jquery' ], null, true );
	}

	// Screen reader text for the child menu toggles.
	wp_localize_script( 'beyond-expectations-navigation', 'screenReaderText', [
		'expand'   => '<span class="screen-reader-text">' . esc_html__( 'expand child menu', 'beyond-expectations' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . esc_html__( 'collapse child menu', 'beyond-expectations' ) . '</span>',
	] );

	// Loads the comment reply script where appropriate.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
} );
