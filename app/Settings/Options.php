<?php
/**
 * Theme options.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations\Settings;

/**
 * Reads the options saved on the Beyond Expectations Settings page.
 *
 * @since  0.0.1
 * @access public
 */
class Options {

	/**
	 * Name of the option that holds all of the settings.
	 *
	 * @since  0.0.1
	 * @var    string
	 */
	const NAME = 'beyond_expectations_settings';

	/**
	 * Gets an option by name. If the name is omitted, returns all options.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  string  $name
	 * @return mixed
	 */
	public static function get( string $name = '' ) {

		$defaults = static::defaults();
		$saved    = get_option( static::NAME, [] );
		$settings = wp_parse_args( is_array( $saved ) ? $saved : [], $defaults );

		if ( '' === $name ) {
			return $settings;
		}

		return $settings[ $name ] ?? null;
	}

	/**
	 * Returns the default options. Everything is off so a site looks the same until
	 * an option is turned on.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return array
	 */
	public static function defaults(): array {

		return (array) apply_filters( 'beyond-expectations/settings/defaults', [
			'disable_emoji'    => false,
			'disable_toolbar'  => false,
			'disable_wp_embed' => false,
			'error_page'       => 0,
		] );
	}

	/**
	 * Sanitizes the options before they are saved.
	 *
	 * @since  0.0.1
	 * @access public
	 * @param  mixed  $settings
	 * @return array
	 */
	public static function sanitize( $settings ): array {

		$settings = is_array( $settings ) ? $settings : [];

		return [
			'disable_emoji'    => ! empty( $settings['disable_emoji'] ),
			'disable_toolbar'  => ! empty( $settings['disable_toolbar'] ),
			'disable_wp_embed' => ! empty( $settings['disable_wp_embed'] ),
			'error_page'       => absint( $settings['error_page'] ?? 0 ),
		];
	}
}
