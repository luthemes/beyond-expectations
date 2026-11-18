<?php
/**
 * Default functions template
 *
 * This file is used to bootstrap the theme.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

/** ------------------------------------------------------------------------------------------
 * Bootstrap the theme.
 * -------------------------------------------------------------------------------------------
 * Load Composer's autoloader first so the Backdrop framework and the theme's classes are
 * available.
 */
if ( file_exists( get_parent_theme_file_path( 'vendor/autoload.php' ) ) ) {
	require_once get_parent_theme_file_path( 'vendor/autoload.php' );
}

// If the Backdrop framework isn't installed, show a notice instead of a fatal error.
if ( ! class_exists( 'Backdrop\\Core\\Application' ) ) {
	require_once get_parent_theme_file_path( 'app/framework-missing.php' );
	return;
}

// If the Vite-built assets haven't been built, show a notice instead of a
// silently unstyled site (see `app/assets-missing.php`).
if ( ! file_exists( get_parent_theme_file_path( 'public/assets/manifest.json' ) ) ) {
	require_once get_parent_theme_file_path( 'app/assets-missing.php' );
}

require_once get_parent_theme_file_path( 'app/bootstrap-autoload.php' );
require_once get_parent_theme_file_path( 'app/framework.php' );
