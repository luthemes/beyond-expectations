<?php
/**
 * Beyond Expectations - header.php
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */
?>
<!DOCTYPE html>
<html <?php Backdrop\Attr\display( 'html' ); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://gmpg.org/xfn/11" rel="profile" />
        <?php wp_head(); ?>
    </head>
<body <?php Backdrop\Attr\display( 'body' ); ?>>
    <?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>
    <div class="app">
    <a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e( 'Skip to content', 'beyond-expectations' ); ?></a>
    <div id="social-search" <?php Backdrop\Attr\display( 'top-bar' ); ?>>
    <nav class="top-bar__inner">
        <div class="social-navigation cf">
        <button type="button" class="search-toggle cf" aria-controls="search-container" aria-expanded="false">
            <?php BeyondExpectations\Tools\Svg::display( 'search' ); ?>
            <span class="screen-reader-text"><?php esc_html_e( 'Search', 'beyond-expectations' ); ?></span>
        </button>
            <?php BeyondExpectations\social_navigation(); ?>
        </div>
    </nav>
    </div>
    <div <?php Backdrop\Attr\display( 'search-box', '', [ 'id' => 'search-container', 'class' => 'search-box cf' ] ); ?>>
        <div class="search-box__inner cf">
            <?php get_search_form(); ?>
        </div>
    </div>
    <?php
        $header_attr = [
            'id'    => 'site-header',
            'class' => 'site-header app-header',
        ];

        if ( get_header_image() ) {
            $header_attr['style'] = sprintf( 'background: url(%s);', esc_url( get_header_image() ) );
        }
    ?>
    <header <?php Backdrop\Attr\display( 'site-header', '', $header_attr ); ?>>
        <div class="app-header__inner container">
            <div id="site-branding" class="site-header__branding">
                <?php
                    // The site title is the page H1 only on the blog home
                    // (is_home() covers both the blog-as-front-page and the
                    // posts page). On a static front page the page title is
                    // the H1, and on every other page the entry/archive
                    // title is, so the site title is a plain link there.
                ?>
                <?php if ( is_home() ) : ?>
                <h1 class="site-header__title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                <?php else : ?>
                <p class="site-header__title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></p>
                <?php endif; ?>
                <p class="site-header__description"><?php bloginfo('description'); ?></p>
            </div>
        </div>
    </header>
    <nav <?php Backdrop\Attr\display( 'primary-navigation', '', [ 'id' => 'site-navigation', 'class' => 'primary-navigation app-nav' ] ); ?>>
        <button class="primary-navigation__toggle app-nav__toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Menu', 'beyond-expectations'); ?></button>
        <?php
            wp_nav_menu(array(
                'theme_location'    => 'primary-navigation',
                'menu_id'           => 'primary-menu',
                'menu_class'        => 'primary-navigation__menu app-nav__menu'));
        ?>
    </nav>
    <?php
        // Whether the page gets the sidebar grid. #site-content opens here
        // in the header, but whether a sidebar exists depends on the content
        // template — and every content template renders one except the
        // full-width page template (registered in functions-setup.php as
        // 'custom-templates/full-width.php', which is the value WordPress
        // stores, so is_page_template() matches it).
        $has_sidebar = ! is_page_template( 'custom-templates/full-width.php' );
    ?>
    <section <?php Backdrop\Attr\display( 'site-content', '', [ 'id' => 'site-content', 'class' => 'site-content app-content container' . ( $has_sidebar ? ' app-content--sidebar-right' : '' ), 'tabindex' => '-1' ] ); ?>>