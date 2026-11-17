<?php
/**
 * Layouts config.
 *
 * The global layouts that can be chosen in the customizer (Theme: Global > Layout). `%1$s` in
 * the image URL is replaced with the theme folder URL.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

return [
	'sidebar' => [
		'label' => __( 'Content with sidebar', 'beyond-expectations' ),
		'url'   => '%1$s/public/images/layout-sidebar.svg'
	],
	'full'    => [
		'label' => __( 'Full width, no sidebar', 'beyond-expectations' ),
		'url'   => '%1$s/public/images/layout-full.svg'
	]
];
