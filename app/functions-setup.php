<?php
/**
 * Theme setup functions.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations;

use function Backdrop\app;
use BeyondExpectations\Tools\Config;

/**
 * Content width.
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	$GLOBALS['content_width'] = apply_filters( 'beyond_expectations_content_width_setup', app()->resolve( 'beyond-expectations/settings' )['content_width'] );
}, 0 );

/**
 * Set up theme support. This is where calls to `add_theme_support()` happen.
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	$settings = app()->resolve( 'beyond-expectations/settings' );

	// Load theme translations.
	load_theme_textdomain( 'beyond-expectations', get_parent_theme_file_path( 'languages' ) );

	// Automatically add the `<title>` tag.
	add_theme_support( 'title-tag' );

	// Automatically add feed links to `<head>`.
	add_theme_support( 'automatic-feed-links' );

	// Outputs HTML5 markup for core features. ClassicPress 2.0 and later use HTML5 by default.
	if ( ! function_exists( 'classicpress_version' ) || version_compare( classicpress_version(), '2.0.0', '<' ) ) {
		add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'caption' ] );
	}

	// Adds custom background support.
	add_theme_support( 'custom-background', [ 'default-color' => 'ffffff' ] );

	// Adds featured image support and the image sizes in `config/image-sizes.php`.
	add_theme_support( 'post-thumbnails' );

	foreach ( Config::get( 'image-sizes' ) as $name => $size ) {
		add_image_size( $name, $size['width'], $size['height'], $size['crop'] ?? false );
	}

	// Adds the custom header, which prints its styles with `header_style()`.
	$header = $settings['header'];

	$header['wp-head-callback'] = __NAMESPACE__ . '\\header_style';

	add_theme_support( 'custom-header', $header );
}, 5 );

/**
 * Register menus.
 *
 * @link   https://developer.wordpress.org/reference/functions/register_nav_menus/
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
add_action( 'init', function() {

	register_nav_menus( [
		'primary-navigation' => esc_html__( 'Primary Navigation', 'beyond-expectations' ),
		'social-navigation'  => esc_html__( 'Social Navigation', 'beyond-expectations' )
	] );
}, 5 );

/**
 * Register sidebars.
 *
 * @link   https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
add_action( 'widgets_init', function() {

	$sidebars = [
		'primary'   => __( 'Primary Sidebar', 'beyond-expectations' ),
		'secondary' => __( 'Secondary Sidebar', 'beyond-expectations' ),
		'custom'    => __( 'Custom Sidebar', 'beyond-expectations' )
	];

	foreach ( $sidebars as $id => $name ) {

		register_sidebar( [
			'name'          => $name,
			'id'            => $id,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
		] );
	}
} );

/**
 * Registers the page templates with Backdrop Template Manager. They are views in
 * `public/views/content/custom-templates`, and the keys match the file names that earlier
 * versions of the theme saved for pages.
 *
 * @since  0.0.1
 * @access public
 * @param  \Backdrop\Template\Manager\Templates  $templates
 * @return void
 */
add_action( 'backdrop/templates/register', function( $templates ) {

	$templates->add( 'custom-templates/full-width.php', [
		'label'      => esc_html__( 'Full Width Template', 'beyond-expectations' ),
		'post_types' => [ 'page' ]
	] );

	$templates->add( 'custom-templates/custom-sidebar.php', [
		'label'      => esc_html__( 'Custom Sidebar Template', 'beyond-expectations' ),
		'post_types' => [ 'page' ]
	] );
} );

/**
 * Outputs the header text color styles.
 *
 * @since  0.0.1
 * @access public
 * @return void
 */
function header_style() {

	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $text_color ) {
		return;
	}

	if ( ! display_header_text() ) {
		$css = '.site-header__branding { display: none; }';
	} else {
		$css = sprintf( '.site-header__title a, .site-header__description { color: #%s; }', esc_attr( $text_color ) );
	}

	printf( '<style type="text/css">%s</style>' . "\n", $css ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
