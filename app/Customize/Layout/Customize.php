<?php
/**
 * Layout customizer component.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations\Customize\Layout;

use Backdrop\Customize\Controls\RadioImage;
use Backdrop\Customize\Helpers\Sanitize;
use BeyondExpectations\Customize\Customizable;
use WP_Customize_Manager;

use function BeyondExpectations\layouts;
use function BeyondExpectations\mod;

/**
 * Adds the Layout section, with a radio image control, to the Global panel.
 *
 * @since  0.0.1
 * @access public
 */
class Customize extends Customizable {

	/**
	 * Registers the Layout section and moves the core Colors section into the Global panel,
	 * because the theme uses the header text color and the background color.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerSections( WP_Customize_Manager $manager ) {

		$manager->add_section( 'theme_global_layout', [
			'panel' => 'theme_global',
			'title' => esc_html__( 'Layout', 'beyond-expectations' ),
		] );

		$colors = $manager->get_section( 'colors' );

		if ( $colors ) {
			$colors->panel = 'theme_global';
		}
	}

	/**
	 * Registers the layout setting.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerSettings( WP_Customize_Manager $manager ) {

		$manager->add_setting( 'theme_global_layout', [
			'default'           => mod( 'layout' ),
			'sanitize_callback' => [ Sanitize::class, 'choices' ],
		] );
	}

	/**
	 * Registers the layout control.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerControls( WP_Customize_Manager $manager ) {

		$choices = [];

		foreach ( layouts() as $layout => $label ) {
			$choices[ $layout ] = [
				'label' => $label,
				// `%1$s` is replaced with the theme folder URL by the control.
				'url'   => '%1$s/public/images/layout-' . $layout . '.svg',
			];
		}

		$manager->add_control( new RadioImage( $manager, 'theme_global_layout', [
			'section'     => 'theme_global_layout',
			'label'       => esc_html__( 'Global Layout', 'beyond-expectations' ),
			'description' => esc_html__( 'Select the layout used for posts, archives and pages.', 'beyond-expectations' ),
			'choices'     => $choices,
		] ) );
	}
}
