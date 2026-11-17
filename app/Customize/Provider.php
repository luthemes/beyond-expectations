<?php
/**
 * Customize service provider.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations\Customize;

use Backdrop\Core\ServiceProvider;
use Backdrop\Customize\Component;

/**
 * Binds the Backdrop customize component to the container with the theme's customizable
 * components and boots it. The component registers the `Theme: Global`, `Theme: Header`,
 * `Theme: Content` and `Theme: Footer` panels, moves the core sections into them, and
 * registers the `radio-image` control type, so the theme only adds its own sections,
 * settings and controls.
 *
 * `Backdrop\Customize\Provider` is intentionally not registered in `app/framework.php`; this
 * provider replaces it so the component is only booted once.
 *
 * @since  0.0.1
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Adds a single instance of the customize component to the container.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function register(): void {

		// Keep the core Colors section: the theme uses the header text color and the background
		// color. The Layout component moves it into the Global panel.
		add_filter( 'backdrop/customize/remove_colors_section', '__return_false' );

		$this->app->singleton( Component::class, function() {

			return new Component( [
				Layout\Customize::class,
				FeatureImage\Customize::class,
				Footer\Customize::class,
			] );
		} );
	}

	/**
	 * Boots the customize component.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function boot(): void {

		$this->app->resolve( Component::class )->boot();
	}
}
