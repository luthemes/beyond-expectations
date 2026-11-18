<?php
/**
 * Built assets missing
 *
 * Loaded when the Vite-built styles and scripts haven't been built yet, which
 * usually means `npm install && npm run build` hasn't been run in the theme
 * folder. Rather than a silently unstyled site, administrators see a notice
 * explaining how to fix it. This mirrors `app/framework-missing.php`.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

/**
 * Returns the message shown when the built assets are missing.
 *
 * @since  0.0.1
 * @access public
 * @return string
 */
function beyond_expectations_assets_missing_message() {

	return sprintf(
		// Translators: 1 is the build command, 2 is the theme folder.
		esc_html__( 'The Beyond Expectations theme can\'t find its built styles and scripts. Run %1$s in the %2$s folder.', 'beyond-expectations' ),
		'<code>npm install && npm run build</code>',
		'<code>' . esc_html( get_template_directory() ) . '</code>'
	);
}

add_action( 'admin_notices', function() {

	if ( current_user_can( 'switch_themes' ) ) {
		printf( '<div class="notice notice-error"><p>%s</p></div>', wp_kses( beyond_expectations_assets_missing_message(), [ 'code' => [] ] ) );
	}
} );
