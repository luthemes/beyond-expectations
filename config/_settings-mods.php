<?php
/**
 * Theme mods settings Config.
 *
 * Defines the default theme mods for the theme. Child themes can overwrite this
 * with a `config/settings-mod.php` file for changing the defaults.
 *
 * Configs are loaded early in the load process. If a default value requires PHP
 * code to execute, use a closure. It will be invoked at an appropriate time when
 * all functions/variables are set up and available for use.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

use function Backdrop\Theme\is_classicpress;
use function Backdrop\Theme\Site\render_home_link;
use function Backdrop\Theme\Site\render_cp_link;
use function Backdrop\Theme\Site\render_wp_link;
use function Backdrop\Theme\Site\render_theme_link;

return [

	# ----------------------------------------------------------------------
	# Global layout.
	# ----------------------------------------------------------------------
	#
	# Handles the global theme layout mods.

	// Set the default layout.
	'layout' => 'sidebar',

	# ----------------------------------------------------------------------
	# Header.
	# ----------------------------------------------------------------------
	#
	# Handles various header mods.

	'theme_header_custom_logo' => false,

	// Branding separator (see `config/character-entities.php` for options).
	'branding_sep' => '&#183;',


	# ----------------------------------------------------------------------
	# Footer.
	# ----------------------------------------------------------------------
	#
	# Handles various footer mods.

	// Whether to show a random powered by quote by default. If set to `false`,
	// the `footer_credit` value will be used.
	'theme_footer_powered_by' => false,

	// Default footer credit text.
	'theme_footer_custom_credit' => function() {
		$year = gmdate( 'Y' ); // Get the current year
		// Translators: 1 is the current year, 2 is a link to the site.
		$copyright = sprintf( __( "&#169; %1\$s. %2\$s.", 'beyond-expectations' ), $year, render_home_link() );

		if ( is_classicpress() ) {
			// Translators: 1 is a link to ClassicPress or WordPress, 2 is a link to the theme.
			$footer_text = sprintf( __( "Powered by %1\$s and %2\$s.", 'beyond-expectations' ), render_cp_link(), render_theme_link() );
		} else {
			// Translators: 1 is a link to ClassicPress or WordPress, 2 is a link to the theme.
			$footer_text = sprintf( __( "Powered by %1\$s and %2\$s.", 'beyond-expectations' ), render_wp_link(), render_theme_link() );
		}

		return $copyright . ' <br /> ' . $footer_text;
	},

	'featured_image_size' => 'beyond-expectations-banner'
];
