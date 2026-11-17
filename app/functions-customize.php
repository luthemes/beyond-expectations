<?php
/**
 * Customizer.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations;

/**
 * Removes the "Display Site Title and Tagline" control. The title and tagline are always
 * part of the header, so the header text color is the only option.
 *
 * @since  0.3.0
 * @access public
 * @param  \WP_Customize_Manager  $wp_customize
 * @return void
 */
add_action( 'customize_register', function( $wp_customize ) {

	$wp_customize->remove_control( 'display_header_text' );
} );
