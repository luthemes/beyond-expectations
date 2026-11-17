<?php
/**
 * Autoload bootstrap file.
 *
 * Classes use the PSR-4 autoloader defined in `composer.json`. The functions files below are
 * loaded here because they hook into ClassicPress and are not classes.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

// Add additional files to the array without the `.php` extension.
array_map( function( $file ) {
	require_once get_parent_theme_file_path( "app/{$file}.php" ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
}, [
	'functions-assets',
	'functions-customize',
	'functions-header',
	'functions-icons',
	'functions-settings',
	'functions-setup',
	'functions-template',
	'functions-vite'
] );
