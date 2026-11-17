<?php
/**
 * Beyond Expectations - index.php
 *
 * This is the only template WordPress loads. The Backdrop template hierarchy decides which
 * header, content and footer views in `resources/views` are used for the current page.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

// Loads header/*.php views.
Backdrop\View\display( 'header', Backdrop\Template\Hierarchy\hierarchy() );

// Loads content/*.php views.
Backdrop\View\display( 'content', Backdrop\Template\Hierarchy\hierarchy() );

// Loads footer/*.php views.
Backdrop\View\display( 'footer', Backdrop\Template\Hierarchy\hierarchy() );
