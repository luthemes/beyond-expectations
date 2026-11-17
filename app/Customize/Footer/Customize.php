<?php
/**
 * Footer customizer component.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations\Customize\Footer;

use BeyondExpectations\Customize\Customizable;
use WP_Customize_Manager;

use function BeyondExpectations\footer_credit_tags;
use function BeyondExpectations\mod;

/**
 * Adds the Credit section to the Footer panel.
 *
 * @since  0.0.1
 * @access public
 */
class Customize extends Customizable {

	/**
	 * Registers the Credit section.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerSections( WP_Customize_Manager $manager ) {

		$manager->add_section( 'theme_footer_credit', [
			'panel' => 'theme_footer',
			'title' => esc_html__( 'Credit', 'beyond-expectations' ),
		] );
	}

	/**
	 * Registers the footer settings.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerSettings( WP_Customize_Manager $manager ) {

		$manager->add_setting( 'theme_footer_powered_by', [
			'default'           => mod( 'footer_powered_by' ),
			'sanitize_callback' => 'wp_validate_boolean',
		] );

		$manager->add_setting( 'theme_footer_custom_credit', [
			'default'           => mod( 'footer_credit' ),
			'sanitize_callback' => function( $value ) {
				return wp_kses( $value, footer_credit_tags() );
			},
		] );
	}

	/**
	 * Registers the footer controls.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerControls( WP_Customize_Manager $manager ) {

		$manager->add_control( 'theme_footer_powered_by', [
			'section' => 'theme_footer_credit',
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Show the "Proudly powered by" credit.', 'beyond-expectations' ),
		] );

		$manager->add_control( 'theme_footer_custom_credit', [
			'section'     => 'theme_footer_credit',
			'type'        => 'textarea',
			'label'       => esc_html__( 'Custom Footer Text', 'beyond-expectations' ),
			'description' => esc_html__( 'Shown instead of the credit above when it is turned off. Leave it empty for the copyright line. Links, line breaks, bold and italic text are allowed.', 'beyond-expectations' ),
		] );
	}
}
