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

	$version = wp_get_theme()->get( 'Version' );

	// Local fonts from the Backdrop fonts package.
	Fonts\enqueue( 'merriweather-sans' );
	Fonts\enqueue( 'sanchez' );

	// Main stylesheet and Font Awesome.
	wp_enqueue_style( 'beyond-expectations-style', get_stylesheet_uri(), [], $version );
	wp_enqueue_style( 'font-awesome', get_parent_theme_file_uri( 'extras/font-awesome/css/font-awesome.css' ), [], '4.7.0' );

	// Search toggle and navigation scripts.
	wp_enqueue_script( 'beyond-expectations-hide-search', get_parent_theme_file_uri( 'js/hide-search.js' ), [ 'jquery' ], $version, true );
	wp_enqueue_script( 'beyond-expectations-navigation', get_parent_theme_file_uri( 'js/navigation.js' ), [ 'jquery' ], $version, true );

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
