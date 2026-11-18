<?php

namespace BeyondExpectations\PluginManager;

class Plugin {

    protected $name;
    protected $label;
    protected $author;
    protected $download_url = '';
    protected $description = '';

    public function __construct( $name ) {
        if ( ! function_exists( 'plugins_api' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
        }

        $this->name = $name;
        $this->fetchPluginData($name);
    }

    protected function fetchPluginData($slug) {

        // Active plugins are passed as `folder/file.php`; the directories use the folder name.
        $slug = false !== strpos( $slug, '/' ) ? dirname( $slug ) : basename( $slug, '.php' );

        // Directory data is cached for a day, so the page doesn't call both directories for
        // every plugin on every load.
        $key    = 'beyond_expectations_plugin_' . md5( $slug );
        $cached = get_transient( $key );

        if ( is_array( $cached ) ) {
            foreach ( [ 'label', 'description', 'download_url', 'author' ] as $field ) {
                $this->$field = $cached[ $field ] ?? '';
            }
            return;
        }

        $this->fetchWordPressPluginData($slug);

        if ( empty( $this->label ) ) {
            $this->fetchClassicPressPluginData($slug);
        }

        // Fall back to the installed plugin's own header, then to the slug.
        if ( empty( $this->label ) ) {
            $this->fetchInstalledPluginData( $this->name );
        }

        if ( empty( $this->label ) ) {
            $this->label = $slug;
        }

        set_transient( $key, [
            'label'        => $this->label,
            'description'  => $this->description,
            'download_url' => $this->download_url,
            'author'       => $this->author,
        ], DAY_IN_SECONDS );
    }

    /**
     * Reads the name, description and author from an installed plugin's header.
     *
     * @since  0.0.1
     * @access protected
     * @param  string  $file  Plugin file, such as `akismet/akismet.php`.
     * @return void
     */
    protected function fetchInstalledPluginData( $file ) {

        if ( ! function_exists( 'get_plugins' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $plugins = get_plugins();

        if ( isset( $plugins[ $file ] ) ) {
            $this->label       = $plugins[ $file ]['Name'] ?? '';
            $this->description = $plugins[ $file ]['Description'] ?? '';
            $this->author      = $plugins[ $file ]['AuthorName'] ?? '';
        }
    }

    protected function fetchWordPressPluginData($slug) {
        $api = plugins_api(
            'plugin_information',
            array(
                'slug'   => $slug,
                'fields' => array(
                    'short_description' => true,
                    'download_link' => true,
                    'author' => true,
                ),
            )
        );

        if ( is_object( $api ) && ! is_wp_error( $api ) && ! empty( $api->name ) ) {
            $this->label = $api->name;
            if ( isset( $api->download_link ) ) {
                $this->download_url = $api->download_link;
            }
            if ( isset( $api->short_description ) ) {
                $this->description = $api->short_description;
            }

            if ( isset ( $api->author ) ) {
                $this->author = $api->author;
            }
        }
    }

    protected function fetchClassicPressPluginData($slug) {
        $response = wp_remote_get( "https://directory.classicpress.net/wp-json/wp/v2/plugins?byslug=" . rawurlencode( $slug ) );

        if ( is_wp_error( $response ) ) {
            return;
        }

        $body = wp_remote_retrieve_body( $response );
        $data = json_decode( $body, true );

        if ( ! empty( $data ) && is_array( $data ) && isset( $data[0] ) ) {
            $plugin = $data[0];
            $this->label = $plugin['title']['rendered'] ?? '';
            $this->description = $plugin['excerpt']['rendered'] ?? '';
            $this->download_url = $plugin['meta']['download_url'] ?? '';
            $this->author = $plugin['meta']['developer_name'] ?? '';
        }
    }

    public function name() {
        return $this->name;
    }

    public function label() {
        return $this->label;
    }

    public function downloadUrl() {
        return $this->download_url;
    }

    public function description() {
        return $this->description;
    }

    public function author() {
        return $this->author;
    }

	/**
	 * Returns a valid HTML id base for this plugin's card.
	 *
	 * Plugin names are file paths (`akismet/akismet.php`), so the raw name
	 * is not a valid id — `/` and `.` are not allowed in one. Sanitizing
	 * turns them into `-` (`akismet-akismet-php`).
	 *
	 * @since  0.0.1
	 * @access protected
	 * @return string
	 */
	protected function cardId() {
		return sanitize_title( $this->name );
	}

    public function displayCard() {
            if ( $this->name === 'classicpress-directory-integration/classicpress-directory-integration.php' ) {
                return;
            }
        ?>
        <div class="plugin-card" aria-describedby="<?php echo esc_attr( sprintf( '%s-name', $this->cardId() ) ) ?>" data-slug="<?php echo esc_attr( $this->name() ) ?>">

            <div class="plugin-title" style="padding: 0 1rem">
                <h2 class="plugin-name" id="<?php echo esc_attr( sprintf( '%s-name', $this->cardId() ) ) ?>" style="margin-bottom: 0.25rem;">
                    <?php echo esc_html( $this->label() ) ?>
                </h2>
                <?php echo esc_html( wp_strip_all_tags( $this->author() ) ); ?>
            </div>

            <div class="plugin-description" style="padding: 1rem; margin-bottom: 1rem;">
                <p><?php echo esc_html( wp_strip_all_tags( $this->description() ) ); ?></p>
            </div>



        </div>
        <?php
    }
}