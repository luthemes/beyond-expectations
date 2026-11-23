<?php
/**
 * Customize defaults.
 *
 * Turns on the Layout, Footer credit and Featured image size components that
 * `backdrop-dev/customize` includes, and gives them the theme's choices and defaults.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations\Customize;

use Backdrop\Contracts\Bootable;
use WP_Customize_Manager;

use BeyondExpectations\Template\Footer;
use BeyondExpectations\Tools\Config;
use BeyondExpectations\Tools\Mod;

/**
 * Customize defaults.
 *
 * @since  0.0.1
 * @access public
 */
class Defaults implements Bootable {

	/**
	 * Adds the filters that enable and configure the built-in components.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function boot(): void {

		add_filter( 'backdrop/customize/layout',         '__return_true' );
		add_filter( 'backdrop/customize/footer_credit',  '__return_true' );
		add_filter( 'backdrop/customize/featured_image', '__return_true' );

		add_filter( 'backdrop/customize/layout_args',         [ $this, 'layout'        ] );
		add_filter( 'backdrop/customize/footer_credit_args',  [ $this, 'footerCredit'  ] );
		add_filter( 'backdrop/customize/featured_image_args', [ $this, 'featuredImage' ] );

		// After the components have registered their sections and controls.
		add_action( 'customize_register', [ $this, 'adjust' ], 20 );
	}

	/**
	 * Layout: Customize -> Theme: Global -> Layout.
	 *
	 * The layout has no live preview, so it refreshes the preview.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  array  $args
	 * @return array
	 */
	public function layout( array $args ): array {

		return array_merge( $args, [
			'panel'     => 'theme_global',
			'title'     => esc_html__( 'Layout', 'beyond-expectations' ),
			'choices'   => Config::get( 'layouts' ),
			'default'   => Mod::fallback( 'layout' ),
			'transport' => 'refresh',
		] );
	}

	/**
	 * Footer credit: Customize -> Theme: Footer -> Credit.
	 *
	 * The credit refreshes the preview: the footer view wraps the credit in its own element,
	 * which a partial would replace with `Footer::renderCredit()`'s default wrapper.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  array  $args
	 * @return array
	 */
	public function footerCredit( array $args ): array {

		return array_merge( $args, [
			'title'              => esc_html__( 'Credit', 'beyond-expectations' ),
			'powered_by_default' => Mod::fallback( 'theme_footer_powered_by' ),
			'powered_by_label'   => __( 'Show random "powered by" credit text.', 'beyond-expectations' ),
			'credit_default'     => Mod::fallback( 'theme_footer_custom_credit' ),
			'credit_label'       => __( 'Custom Footer Text', 'beyond-expectations' ),
			'allowed_html'       => Footer::allowedTags(),
			'selector'           => '',
			'transport'          => 'refresh',
		] );
	}

	/**
	 * Featured image size: Customize -> Theme: Content -> Feature Image.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  array  $args
	 * @return array
	 */
	public function featuredImage( array $args ): array {

		$choices = [];

		foreach ( Config::get( 'image-sizes' ) as $name => $attrs ) {
			$choices[ $name ] = $attrs['label'];
		}

		return array_merge( $args, [
			'title'     => esc_html__( 'Feature Image', 'beyond-expectations' ),
			'label'     => __( 'Feature Image Size', 'beyond-expectations' ),
			'choices'   => $choices,
			'default'   => Mod::fallback( 'featured_image_size' ),
			'transport' => 'refresh',
		] );
	}

	/**
	 * Moves the Colors section into the Global panel, and hides the custom footer text
	 * while the random "powered by" credit is on.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function adjust( WP_Customize_Manager $manager ): void {

		$colors = $manager->get_section( 'colors' );

		if ( $colors ) {
			$colors->panel = 'theme_global';
		}

		$credit = $manager->get_control( 'theme_footer_custom_credit' );

		if ( $credit ) {
			$credit->active_callback = function( $control ) {
				return ! $control->manager->get_setting( 'theme_footer_powered_by' )->value();
			};
		}
	}
}
