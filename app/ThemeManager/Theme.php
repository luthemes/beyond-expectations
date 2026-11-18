<?php
/**
 * Theme class.
 *
 * Creates a theme object.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations\ThemeManager;

use WP_Theme;

/**
 * Theme class.
 *
 * @since  1.2.0
 * @access public
 */
class Theme {

	/**
	 * Theme name.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @var    string
	 */
	protected $name;

	/**
	 * Theme label.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @var    string
	 */
	protected $label;

	/**
	 * Download URL.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @var    string
	 */
	protected $download_url = '';

	/**
	 * Screenshot URL.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @var    string
	 */
	protected $screenshot = '';

	/**
	 * `WP_Theme` object.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @var    WP_Theme
	 */
	protected $wp_theme;

	/**
	 * Set up the object properties.
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $options
	 * @return void
	 */
	public function __construct( $name, array $options = [] ) {

		foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
			if ( isset( $options[ $key ] ) ) {
				$this->$key = $options[ $key ];
			}
		}

		$this->name = $name;

		// If we don't have an instance of the WP theme object, get it.
		if ( ! $this->wp_theme instanceof WP_Theme ) {
			$this->wp_theme = wp_get_theme( $this->name );
		}
	}

	/**
	 * Returns the name.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function name() {
		return $this->name;
	}

	/**
	 * Returns the label.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function label() {
		return $this->installed() ? $this->wp_theme->display( 'Name' ) : $this->label;
	}

	/**
	 * Conditional to check if theme is installed.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return bool
	 */
	public function installed() {
		return $this->wp_theme->exists();
	}

	/**
	 * Conditional to check if the theme is active.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function active() {
		return $this->name() === get_stylesheet();
	}

	/**
	 * Returns a valid HTML id base for this theme's card.
	 *
	 * The card id is built from the theme name, which is not guaranteed to
	 * be a valid id (e.g. a name with `/` or `.` in it), so the name is
	 * sanitized; the raw name is kept in `data-slug`.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @return string
	 */
	protected function cardId() {
		return sanitize_title( $this->name );
	}

	/**
	 * Returns the screenshot URL.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function screenshot() {

		$screenshot = $this->installed() ? $this->wp_theme->get_screenshot() : $this->screenshot;

		// The screenshot URL may contain `%1$s` / `%2$s` placeholders for the
		// parent and child theme URIs. Substitute them directly: sprintf()
		// would mangle any other `%` in the URL, e.g. `%20` in an encoded path.
		$screenshot = str_replace(
			[ '%1$s', '%2$s' ],
			[ get_template_directory_uri(), get_stylesheet_directory_uri() ],
			$screenshot
		);

		// The version is the parent theme's, and wp_get_theme() reloads it on
		// every call — cache it; it only changes when the theme updates.
		static $parent_version = null;

		if ( null === $parent_version ) {
			$parent_version = wp_get_theme( get_template() )->get( 'Version' );
		}

		return add_query_arg(
			'version',
			$parent_version,
			$screenshot
		);
	}

	/**
	 * Returns the download URL.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function downloadUrl() {
		return $this->download_url;
	}

	/**
	 * Returns the activation URL.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function activateUrl() {

		if ( ! $this->installed() ) {
			return '';
		}

		return wp_nonce_url(
			add_query_arg( [
				'action'     => 'activate',
				'stylesheet' => rawurlencode( $this->wp_theme->get_stylesheet() )
			], admin_url( 'themes.php' ) ),
			'switch-theme_' . $this->wp_theme->get_stylesheet()
		);
	}

	/**
	 * Returns the customize URL.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function customizeUrl() {

		$url = admin_url( 'customize.php' );

		if ( ! $this->active() ) {

			$url = add_query_arg( [
				'theme' => rawurlencode( $this->name() )
			], $url );
		}

		return $url;
	}

	/**
	 * Displays the theme "card".
	 *
	 * @since  1.2.0
	 * @access public
	 * @return void
	 */
	public function displayCard() { ?>

		<div class="theme<?php echo $this->active() ? ' active' : '' ?>" aria-describedby="<?php echo esc_attr( sprintf( '%1$s-action %1$s-name', $this->cardId() ) ) ?>" data-slug="<?php echo esc_attr( $this->name() ) ?>">

			<div class="theme-screenshot">
				<img src="<?php echo esc_url( $this->screenshot() ) ?>" alt="" />
			</div>

			<div class="theme-id-container">

				<h2 class="theme-name" id="<?php echo esc_attr( sprintf( '%s-name', $this->cardId() ) ) ?>">
					<?php if ( $this->active() ) : ?>
						<?php printf(
							'<span>%s</span> %s',
							esc_html__( 'Active:', 'beyond-expectations' ),
							esc_html( $this->label() )
						) ?>
					<?php else : ?>
						<?php echo esc_html( $this->label() ) ?>
					<?php endif ?>
				</h2>

				<div class="theme-actions" id="<?php echo esc_attr( sprintf( '%s-action', $this->cardId() ) ) ?>">
					<?php foreach ( $this->themeActions() as $action ) : ?>
						<?php echo $action // phpcs:ignore ?>
					<?php endforeach ?>
				</div>
			</div>

		</div>
	<?php }

	/**
	 * Returns an array of theme action links.
	 *
	 * @since  1.2.0
	 * @access private
	 * @return array
	 */
	private function themeActions() {

		$actions = [];

		if ( $this->installed() ) {

			if ( $this->active() && current_user_can( 'customize' ) ) {

				$actions[] = sprintf(
					'<a class="button button-primary load-customize hide-if-no-customize" href="%s">%s</a>',
					esc_url( $this->customizeUrl() ),
					esc_html__( 'Customize', 'beyond-expectations' )
				);
			}

			if ( ! $this->active() && current_user_can( 'switch_themes' ) ) {

				$actions[] = sprintf(
					'<a class="button activate" href="%s" aria-label="%s">%s</a>',
					esc_url( $this->activateUrl() ),
					// Translators: %s is the theme name.
					esc_attr( sprintf( __( 'Activate %s', 'beyond-expectations' ), $this->label() ) ),
					esc_html__( 'Activate', 'beyond-expectations' )
				);
			}

			if ( ! $this->active() && current_user_can( 'customize' ) ) {

				$actions[] = sprintf(
					'<a class="button button-primary load-customize hide-if-no-customize" href="%s">%s</a>',
					esc_url( $this->customizeUrl() ),
					esc_html__( 'Live Preview', 'beyond-expectations' )
				);
			}

		} elseif ( $this->downloadUrl() ) {

			$actions[] = sprintf(
				'<a class="button button-primary" href="%s" target="_blank">%s</a>',
				esc_url( $this->downloadUrl() ),
				esc_html__( 'Download', 'beyond-expectations' )
			);
		}

		return $actions;
	}
}
