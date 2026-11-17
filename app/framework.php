<?php
/**
 * Boot the Framework
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

/** ------------------------------------------------------------------------------------------
 * Create a new application.
 * -------------------------------------------------------------------------------------------
 *
 * Backdrop 2.0 is the application and the service container. If an application has already
 * been booted (for example, by a plugin or a parent theme), it is reused instead of creating
 * a new one.
 */
$theme = Backdrop\booted() ? Backdrop\app() : new Backdrop\Core\Application();

/** ------------------------------------------------------------------------------------------
 * Register service providers with the application.
 * -------------------------------------------------------------------------------------------
 */
$theme->provider( Backdrop\Attr\Provider::class );
$theme->provider( Backdrop\Pagination\Provider::class );
$theme->provider( Backdrop\Theme\Provider::class );
$theme->provider( Backdrop\Template\Hierarchy\Provider::class );
$theme->provider( Backdrop\View\Provider::class );
$theme->provider( BeyondExpectations\Provider::class );

/** ------------------------------------------------------------------------------------------
 * Perform any actions.
 * -------------------------------------------------------------------------------------------
 *
 * Child themes can hook into this action to add their own bindings before the application
 * is booted. The callback receives the application instance.
 */
do_action( 'beyond-expectations/bootstrap', $theme );

/** ------------------------------------------------------------------------------------------
 * Boot the application.
 * -------------------------------------------------------------------------------------------
 */
$theme->boot();
