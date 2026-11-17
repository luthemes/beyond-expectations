<?php
/**
 * Index template.
 *
 * The Backdrop template hierarchy looks for templates in `public/views`, so the real index
 * template is `public/views/index.php`. This file only has to exist for the theme to be valid.
 * If it is ever loaded (for example, by a plugin that bypasses the hierarchy), it loads
 * `public/views/index.php`.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

// The Backdrop framework isn't installed (see `app/framework-missing.php`).
if ( ! function_exists( 'Backdrop\\View\\display' ) ) {
	wp_die(
		current_user_can( 'switch_themes' ) ? wp_kses( beyond_expectations_framework_missing_message(), [ 'code' => [] ] ) : esc_html__( 'This site is temporarily unavailable.', 'beyond-expectations' ),
		esc_html__( 'Theme dependencies are missing', 'beyond-expectations' ),
		[ 'response' => 503 ]
	);
}

// Loads the `public/views/index.php` template.
Backdrop\View\display( 'index' );
