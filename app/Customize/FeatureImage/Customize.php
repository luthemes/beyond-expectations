<?php
/**
 * Featured image customizer component.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations\Customize\FeatureImage;

use BeyondExpectations\Customize\Customizable;
use WP_Customize_Manager;

use function BeyondExpectations\feature_image_sizes;
use function BeyondExpectations\mod;

/**
 * Adds the Feature Image section to the Content panel.
 *
 * @since  0.0.1
 * @access public
 */
class Customize extends Customizable {

	/**
	 * Registers the Feature Image section.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerSections( WP_Customize_Manager $manager ) {

		$manager->add_section( 'theme_content_feature_image', [
			'panel' => 'theme_content',
			'title' => esc_html__( 'Feature Image', 'beyond-expectations' ),
		] );
	}

	/**
	 * Registers the feature image size setting.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerSettings( WP_Customize_Manager $manager ) {

		$manager->add_setting( 'theme_content_feature_image', [
			'default'           => mod( 'feature_image_size' ),
			'sanitize_callback' => function( $value ) {
				return array_key_exists( $value, feature_image_sizes() ) ? $value : mod( 'feature_image_size' );
			},
		] );
	}

	/**
	 * Registers the feature image size control.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerControls( WP_Customize_Manager $manager ) {

		$manager->add_control( 'theme_content_feature_image', [
			'section'     => 'theme_content_feature_image',
			'type'        => 'select',
			'label'       => esc_html__( 'Feature Image Size', 'beyond-expectations' ),
			'description' => esc_html__( 'The size of the featured image at the top of a page.', 'beyond-expectations' ),
			'choices'     => feature_image_sizes(),
		] );
	}
}
