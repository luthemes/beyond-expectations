<?php
/**
 * App service provider.
 *
 * Service providers are essentially the bootstrapping code for your theme. They allow you to
 * add bindings to the container on registration and boot them once everything has been
 * registered.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations;

use Backdrop\Core\ServiceProvider;
use BeyondExpectations\Tools\Config;

/**
 * App service provider.
 *
 * @since  0.0.1
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Callback executed when the `Backdrop\Core\Application` class registers providers.
	 * Use this method to bind items to the container.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function register(): void {

		// Bind a single instance of theme mod defaults.
		$this->app->singleton( 'beyond-expectations/mods', function() {

			return array_merge(
				Config::get( '_settings-mods' )
			);
		} );

		// Bind the theme settings so they can be resolved from the container.
		$this->app->singleton( 'beyond-expectations/settings', function() {

			return [
				'content_width'  => 840,
				'avatar_size'    => 100,
				'header'         => [
					'default-text-color' => 'ffffff',
					'height'             => 300,
					'width'              => 1280,
					'max-width'          => 2000,
					'flex-height'        => true,
					'flex-width'         => true,
					'random-default'     => false,
				],
			];
		} );
	}
}
