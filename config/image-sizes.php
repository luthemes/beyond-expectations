<?php
/**
 * Image sizes config.
 *
 * The image sizes registered by the theme. The sizes are the choices for the Feature Image
 * Size option in the customizer (Theme: Content > Feature Image).
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

return [

	// The banner at the top of a page. This is the default.
	'beyond-expectations-banner' => [
		'label'  => __( 'Banner (840 by 260, cropped)', 'beyond-expectations' ),
		'width'  => 840,
		'height' => 260,
		'crop'   => true
	],

	// Landscape sizes.
	'beyond-expectations-landscape-medium' => [
		'label'  => __( 'Landscape: Medium', 'beyond-expectations' ),
		'width'  => 640,
		'height' => 360,
		'crop'   => true
	],
	'beyond-expectations-landscape-large' => [
		'label'  => __( 'Landscape: Large', 'beyond-expectations' ),
		'width'  => 896,
		'height' => 504,
		'crop'   => true
	]
];
