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
 * @since  0.0.1
 * @access public
 * @param  \WP_Customize_Manager  $wp_customize
 * @return void
 */
add_action( 'customize_register', function( $wp_customize ) {

	$wp_customize->remove_control( 'display_header_text' );
} );

/**
 * Adds the Layout, Featured Image and Footer sections to the customizer.
 *
 * @since  0.0.1
 * @access public
 * @param  \WP_Customize_Manager  $wp_customize
 * @return void
 */
add_action( 'customize_register', function( $wp_customize ) {

	// Layout.
	$wp_customize->add_section( 'beyond_expectations_layout', [
		'title'    => esc_html__( 'Layout', 'beyond-expectations' ),
		'priority' => 120,
	] );

	$wp_customize->add_setting( 'beyond_expectations_layout', [
		'default'           => mod( 'layout' ),
		'sanitize_callback' => function( $value ) {
			return array_key_exists( $value, layouts() ) ? $value : 'sidebar';
		},
	] );

	$wp_customize->add_control( 'beyond_expectations_layout', [
		'section'     => 'beyond_expectations_layout',
		'type'        => 'select',
		'label'       => esc_html__( 'Global Layout', 'beyond-expectations' ),
		'description' => esc_html__( 'Select the layout used for posts, archives and pages.', 'beyond-expectations' ),
		'choices'     => layouts(),
	] );

	// Featured image.
	$wp_customize->add_section( 'beyond_expectations_feature_image', [
		'title'    => esc_html__( 'Featured Image', 'beyond-expectations' ),
		'priority' => 121,
	] );

	$wp_customize->add_setting( 'beyond_expectations_feature_image_size', [
		'default'           => mod( 'feature_image_size' ),
		'sanitize_callback' => function( $value ) {
			return array_key_exists( $value, feature_image_sizes() ) ? $value : 'beyond-expectations-banner';
		},
	] );

	$wp_customize->add_control( 'beyond_expectations_feature_image_size', [
		'section'     => 'beyond_expectations_feature_image',
		'type'        => 'select',
		'label'       => esc_html__( 'Featured Image Size', 'beyond-expectations' ),
		'description' => esc_html__( 'The size of the featured image at the top of a page.', 'beyond-expectations' ),
		'choices'     => feature_image_sizes(),
	] );

	// Footer.
	$wp_customize->add_section( 'beyond_expectations_footer', [
		'title'    => esc_html__( 'Footer', 'beyond-expectations' ),
		'priority' => 122,
	] );

	$wp_customize->add_setting( 'beyond_expectations_footer_powered_by', [
		'default'           => mod( 'footer_powered_by' ),
		'sanitize_callback' => 'wp_validate_boolean',
	] );

	$wp_customize->add_control( 'beyond_expectations_footer_powered_by', [
		'section' => 'beyond_expectations_footer',
		'type'    => 'checkbox',
		'label'   => esc_html__( 'Show the "Proudly powered by" credit.', 'beyond-expectations' ),
	] );

	$wp_customize->add_setting( 'beyond_expectations_footer_credit', [
		'default'           => '',
		'sanitize_callback' => function( $value ) {
			return wp_kses( $value, footer_credit_tags() );
		},
	] );

	$wp_customize->add_control( 'beyond_expectations_footer_credit', [
		'section'     => 'beyond_expectations_footer',
		'type'        => 'textarea',
		'label'       => esc_html__( 'Custom Footer Text', 'beyond-expectations' ),
		'description' => esc_html__( 'Shown instead of the credit above when it is turned off. Leave it empty for the copyright line. Links, line breaks, bold and italic text are allowed.', 'beyond-expectations' ),
	] );
} );
