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
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://gmpg.org/xfn/11" rel="profile" />
        <?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>
    <?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>
    <div id="social-search" class="social-search">
    <nav class="align-center">
        <div class="social-navigation cf">
        <div class="search-toggle cf">
            <i class="fa fa-search cf"> </i>
            <a href ="#search-container" class="screen-reader-text cf"><?php _e('Search', 'beyond-expectations'); ?></a>
        </div>
            <?php BeyondExpectations\social_navigation(); ?>
        </div>
    </nav>
    </div>
    <div id="search-container" class="search-box-wrapper cf">
        <div class="search-box cf">
            <?php get_search_form(); ?>
        </div>
    </div>
    <?php if (get_header_image()) { ?>
        <header id="site-header" class="site-header" style="background: url(<?php echo esc_url( get_header_image() ); ?>);">
    <?php } else { ?>
            <header id="site-header" class="site-header">
    <?php } ?>
        <div id="site-branding" class="site-branding">
            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
            <h4 class="site-description"><?php bloginfo('description'); ?></h4>
        </div>
    </header>
    <nav id="site-navigation" class="primary-navigation">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Menu', 'beyond-expectations'); ?></button>
        <?php
            wp_nav_menu(array(
                'theme_location'    => 'primary-navigation',
                'menu_id'           => 'primary-menu',
                'menu_class'        => 'nav-menu'   
            )); 
        ?>
    </nav>
    <section id="site-content" class="site-content cf">