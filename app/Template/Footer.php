<?php
/**
 * Footer Class.
 *
 * A simple class for outputting the appropriate footer credit text.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations\Template;

use BeyondExpectations\Tools\Mod;
use BeyondExpectations\Tools\PoweredBy;

/**
 * Powered by class.
 *
 * @since  1.0.0
 * @access public
 */
class Footer {

	/**
	 * Displays a random powered by quote.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public static function displayCredit( array $args = [] ) {

		echo static::renderCredit( $args ); // phpcs:ignore
	}

	/**
	 * Returns a random powered by quote.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public static function renderCredit( array $args = [] ) {

		$args = wp_parse_args( $args, [
			'before' => '<p class="site-footer-credit">',
			'after'  => '</p>'
		] );

		$text = Mod::get( 'theme_footer_powered_by' ) ? PoweredBy::render() : Mod::get( 'theme_footer_custom_credit' );

		// Links in the credit can come from the custom credit setting, so make
		// sure every link carries rel="noopener" (a link with a rel attribute
		// already — e.g. rel="author" — is left alone).
		$text = preg_replace_callback(
			'/<a\b[^>]*>/i',
			function( $matches ) {
				return false === stripos( $matches[0], 'rel=' ) ? str_replace( '<a', '<a rel="noopener"', $matches[0] ) : $matches[0];
			},
			wp_kses( $text, static::allowedTags() )
		);

		return sprintf(
			'%s%s%s',
			$args['before'],
			$text,
			$args['after']
		);
	}

	/**
	 * Returns an array of allowed tags in footer text.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public static function allowedTags() {

		return [
			'a'       => [ 'href' => true, 'title' => true, 'class' => true, 'rel' => true ],
			'abbr'    => [ 'title' => true ],
			'acronym' => [ 'title' => true ],
			'bold'    => [ 'class' => true ],
			'code'    => [ 'class' => true ],
			'em'      => [ 'class' => true ],
			'i'       => [ 'class' => true ],
			'span'    => [ 'class' => true ],
			'strong'  => [ 'class' => true ],
			'br'		=> []
		];
	}
}
