<?php
/**
 * Powered By Text Class.
 *
 * A simple class for randomly displaying a "powered by..." line of text in the
 * theme footer.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations\Tools;

/**
 * Powered by class.
 *
 * @since  1.0.0
 * @access public
 */
class PoweredBy {

	/**
	 * Returns an array of all the powered by quotes.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public static function all() {

		return apply_filters( 'beyond-expectations/poweredby/collection', [
			esc_html__( 'Powered by heart and soul.', 'beyond-expectations' ),
			esc_html__( 'Powered by crazy ideas and passion.', 'beyond-expectations' ),
			esc_html__( 'Powered by the thing that holds all things together in the universe.', 'beyond-expectations' ),
			esc_html__( 'Powered by love.', 'beyond-expectations' ),
			esc_html__( 'Powered by the vast and endless void.', 'beyond-expectations' ),
			esc_html__( 'Powered by the code of a maniac.', 'beyond-expectations' ),
			esc_html__( 'Powered by peace and understanding.', 'beyond-expectations' ),
			esc_html__( 'Powered by coffee.', 'beyond-expectations' ),
			esc_html__( 'Powered by sleepness nights.', 'beyond-expectations' ),
			esc_html__( 'Powered by the love of all things.', 'beyond-expectations' ),
			esc_html__( 'Powered by something greater than myself.', 'beyond-expectations' ),
			esc_html__( 'Powered by whispers from the future.', 'beyond-expectations' ),
			esc_html__( 'Powered by the fusion of technology and dreams.', 'beyond-expectations' ),
			esc_html__( 'Powered by the strength found in kindness.', 'beyond-expectations' ),
			esc_html__( 'Powered by the melodies of the unseen world.', 'beyond-expectations' ),
			esc_html__( 'Powered by the courage of the unheard voices.', 'beyond-expectations' ),
			esc_html__( 'Powered by the beauty of the human spirit.', 'beyond-expectations' ),
			esc_html__( 'Powered by the quest for eternal wisdom.', 'beyond-expectations' ),
			esc_html__( 'Powered by the energy of uncharted galaxies.', 'beyond-expectations' ),
			esc_html__( 'Powered by the magic hidden in plain sight.', 'beyond-expectations' ),
			esc_html__( 'Powered by the legacy of the ancients.', 'beyond-expectations' ),
			esc_html__( 'Powered by the dance between light and darkness.', 'beyond-expectations' ),
			esc_html__( 'Powered by the touch of the morning sun.', 'beyond-expectations' ),
			esc_html__( 'Powered by the secrets of the deep ocean.', 'beyond-expectations' ),
			esc_html__( 'Powered by the echoes of laughter and joy.', 'beyond-expectations' ),
			esc_html__( 'Powered by the relentless pursuit of truth.', 'beyond-expectations' ),
		] );
	}

	/**
	 * Displays a random powered by quote.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public static function display() {

		echo esc_html( static::render() );
	}

	/**
	 * Returns a random powered by quote.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public static function render() {

		$collection = static::all();

		return $collection[ array_rand( $collection, 1 ) ];
	}
}