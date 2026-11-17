<?php
/**
 * Vite assets.
 *
 * The styles and scripts in `resources` are built by Vite into `public/assets`, along with a
 * `manifest.json` that maps each source file to its hashed build file. These helpers read the
 * manifest so the right file is loaded.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations;

/**
 * Returns the decoded Vite manifest, or an empty array when the theme hasn't been built.
 *
 * @since  0.3.0
 * @access public
 * @return array
 */
function manifest(): array {

	static $manifest = null;

	if ( null === $manifest ) {
		$file     = get_parent_theme_file_path( 'public/assets/manifest.json' );
		$decoded  = is_readable( $file ) ? json_decode( (string) file_get_contents( $file ), true ) : null; // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		$manifest = is_array( $decoded ) ? $decoded : [];
	}

	return $manifest;
}

/**
 * Returns the URL of a built asset from its source path, such as `resources/scss/screen.scss`.
 * Returns an empty string when the asset isn't in the manifest.
 *
 * @since  0.3.0
 * @access public
 * @param  string $path
 * @return string
 */
function asset( string $path ): string {

	$manifest = manifest();
	$key      = ltrim( $path, '/' );

	if ( empty( $manifest[ $key ]['file'] ) ) {
		return '';
	}

	return get_parent_theme_file_uri( 'public/assets/' . ltrim( $manifest[ $key ]['file'], '/' ) );
}

/**
 * Tells administrators when the assets haven't been built, which leaves the theme without
 * styles. A packaged release already includes them.
 *
 * @since  0.3.0
 * @access public
 * @return void
 */
add_action( 'admin_notices', function() {

	if ( manifest() || ! current_user_can( 'switch_themes' ) ) {
		return;
	}

	printf(
		'<div class="notice notice-warning"><p>%s</p></div>',
		esc_html__( 'Beyond Expectations has no built styles or scripts. Run "npm install" and "npm run build" in the theme folder, or install a packaged release.', 'beyond-expectations' )
	);
} );
