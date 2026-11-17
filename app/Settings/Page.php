<?php
/**
 * Settings page.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

namespace BeyondExpectations\Settings;

/**
 * Adds the Beyond Expectations Settings page under Appearance, with options for the 404 page
 * and for removing front end extras that ClassicPress loads by default.
 *
 * @since  0.0.1
 * @access public
 */
class Page {

	/**
	 * Settings page slug.
	 *
	 * @since  0.0.1
	 * @var    string
	 */
	const SLUG = 'beyond-expectations-settings';

	/**
	 * Adds the hooks for the page.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function boot(): void {

		add_action( 'admin_menu', [ $this, 'addPage' ] );
		add_action( 'admin_init', [ $this, 'register' ] );
	}

	/**
	 * Adds the page to the Appearance menu.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function addPage(): void {

		add_theme_page(
			esc_html__( 'Beyond Expectations Settings', 'beyond-expectations' ),
			esc_html__( 'Beyond Expectations Settings', 'beyond-expectations' ),
			'edit_theme_options',
			static::SLUG,
			[ $this, 'template' ]
		);
	}

	/**
	 * Registers the setting, sections and fields.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function register(): void {

		register_setting( 'beyond_expectations_settings', Options::NAME, [
			'sanitize_callback' => [ Options::class, 'sanitize' ],
		] );

		add_settings_section( 'reading', esc_html__( 'Reading', 'beyond-expectations' ), function() {
			echo '<p>' . esc_html__( 'Settings related to what visitors see, including the 404 error page.', 'beyond-expectations' ) . '</p>';
		}, static::SLUG );

		$label = function_exists( 'classicpress_version' )
			? esc_html__( 'Clean ClassicPress', 'beyond-expectations' )
			: esc_html__( 'Clean WordPress', 'beyond-expectations' );

		add_settings_section( 'clean', $label, function() {
			echo '<p>' . esc_html__( 'Remove extras from the front end of your site for speed improvements.', 'beyond-expectations' ) . '</p>';
		}, static::SLUG );

		add_settings_field( 'error_page', esc_html__( '404 Page', 'beyond-expectations' ), [ $this, 'fieldErrorPage' ], static::SLUG, 'reading' );
		add_settings_field( 'emoji', esc_html__( 'Emoji', 'beyond-expectations' ), [ $this, 'fieldEmoji' ], static::SLUG, 'clean' );
		add_settings_field( 'toolbar', esc_html__( 'Toolbar', 'beyond-expectations' ), [ $this, 'fieldToolbar' ], static::SLUG, 'clean' );
		add_settings_field( 'embeds', esc_html__( 'Embeds', 'beyond-expectations' ), [ $this, 'fieldEmbeds' ], static::SLUG, 'clean' );
	}

	/**
	 * Prints a checkbox field.
	 *
	 * @since  0.0.1
	 * @access protected
	 * @param  string  $name
	 * @param  string  $label
	 * @param  string  $description
	 * @return void
	 */
	protected function checkbox( string $name, string $label, string $description ): void { ?>

		<p>
			<label>
				<input type="checkbox" name="<?php echo esc_attr( Options::NAME . '[' . $name . ']' ); ?>" value="1" <?php checked( (bool) Options::get( $name ) ); ?> />
				<?php echo esc_html( $label ); ?>
			</label>
		</p>
		<p class="description"><?php echo esc_html( $description ); ?></p>

	<?php }

	/**
	 * Prints the 404 page field.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function fieldErrorPage(): void {

		$dropdown = wp_dropdown_pages( [
			'name'              => Options::NAME . '[error_page]',
			'show_option_none'  => esc_html__( '&mdash; Default 404 message &mdash;', 'beyond-expectations' ),
			'option_none_value' => 0,
			'selected'          => absint( Options::get( 'error_page' ) ),
			'post_status'       => [ 'publish', 'private' ],
			'echo'              => false,
		] );

		if ( $dropdown ) {
			echo wp_kses( $dropdown, [
				'select' => [ 'name' => true, 'id' => true ],
				'option' => [ 'value' => true, 'selected' => true, 'class' => true ],
			] );
		} elseif ( current_user_can( 'publish_pages' ) ) {
			printf( '<a href="%s">%s</a>', esc_url( add_query_arg( 'post_type', 'page', admin_url( 'post-new.php' ) ) ), esc_html__( 'Add New Page', 'beyond-expectations' ) );
		} ?>

		<p class="description"><?php esc_html_e( 'Select a page to show when someone visits a URL that does not exist. Set the page to private so it does not appear in your menus or search results.', 'beyond-expectations' ); ?></p>

	<?php }

	/**
	 * Prints the emoji field.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function fieldEmoji(): void {

		$this->checkbox( 'disable_emoji', __( 'Disable Emoji Scripts', 'beyond-expectations' ), __( 'All modern browsers support emoji natively. Disabling the emoji scripts removes the JavaScript loaded on every page for a small number of visitors on outdated browsers.', 'beyond-expectations' ) );
	}

	/**
	 * Prints the toolbar field.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function fieldToolbar(): void {

		$this->checkbox( 'disable_toolbar', __( 'Disable Toolbar', 'beyond-expectations' ), __( 'Hides the toolbar on the front end of the site, which loads extra JavaScript and CSS on every page.', 'beyond-expectations' ) );
	}

	/**
	 * Prints the embeds field.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function fieldEmbeds(): void {

		$label = function_exists( 'classicpress_version' ) ? __( 'Disable ClassicPress Embeds', 'beyond-expectations' ) : __( 'Disable WordPress Embeds', 'beyond-expectations' );

		$this->checkbox( 'disable_wp_embed', $label, __( 'Removes the JavaScript that lets other sites embed your posts.', 'beyond-expectations' ) );
	}

	/**
	 * Prints the page.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function template(): void { ?>

		<div class="wrap">
			<h1 class="wp-heading-inline"><?php esc_html_e( 'Beyond Expectations Settings', 'beyond-expectations' ); ?></h1>

			<?php if ( current_user_can( 'customize' ) ) : ?>
				<a href="<?php echo esc_url( wp_customize_url() ); ?>" class="hide-if-no-js page-title-action"><?php esc_html_e( 'Customize', 'beyond-expectations' ); ?></a>
			<?php endif; ?>

			<hr class="wp-header-end" />

			<form method="post" action="options.php">
				<?php settings_fields( 'beyond_expectations_settings' ); ?>
				<?php do_settings_sections( static::SLUG ); ?>
				<?php submit_button( esc_attr__( 'Update Settings', 'beyond-expectations' ) ); ?>
			</form>
		</div>

	<?php }
}
