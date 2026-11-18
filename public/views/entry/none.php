<?php
/**
 * Beyond Expectations - content-none.php
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */
?>
<?php $error_page = isset( $error ) && $error->hasPost() ? $error : null; ?>
<?php $error_page && $error_page->setup(); ?>
<?php
	// This view is the page heading on 404 / empty archive / empty
	// search pages, where there is no other H1 — so it is the H1
	// there. On an empty blog home the site title is already the
	// H1, so it stays an H2.
	$none_title_tag = is_home() ? 'h2' : 'h1';
?>
<article <?php Backdrop\Attr\display( 'entry', 'none' ); ?>>
    <header class="archive-header">
        <<?php echo esc_html( $none_title_tag ); ?> class="archive-header__title">
            <?php if ($error_page) {
                $error_page->displayTitle();
            } else if (is_404()) {
                _e('Page Not Available', 'beyond-expectations');
            } else if (is_search()) {
                printf(__('Nothing found for: <small>', 'beyond-expectations') . get_search_query() . '</small>');
            } else {
                _e('Nothing Found', 'beyond-expectations');
            }
            ?>
        </<?php echo esc_html( $none_title_tag ); ?>>
    </header>
    <div class="entry__content entry__content--full-width">
        <?php if ($error_page) : ?>
            <?php $error_page->displayContent(); ?>
            <?php get_search_form(); ?>
        <?php elseif (is_home() && current_user_can('publish_posts')) : ?>
            <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'beyond-expectations' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
        <?php elseif (is_404()) : ?>
            <p><?php printf(__( "You tried going to %s, which doesn't exist, so that means I probably broke something.", 'beyond-expectations'), '<code>' . esc_url( home_url( $_SERVER['REQUEST_URI'] ) ) . '</code>' ); ?></p>
            <?php get_search_form(); ?>
        <?php elseif (is_search()) : ?>
            <p><?php _e( 'Nothing matched your search terms. Check out the most recent articles below or try searching for something else:', 'beyond-expectations' ); ?></p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p><?php _e( 'It seems we cannot find what you are looking for. Perhaps searching can help.', 'beyond-expectations' ); ?></p>
            <?php get_search_form(); ?>
        <?php endif; ?>
    </div>
</article>
<div class="recent-posts">
    <?php if (is_404() || is_search()) { ?>
        <h3 class="recent-posts__title"><?php _e('Most Recent Posts', 'beyond-expectations'); ?></h3>
            <ul>
                <?php
                    $args = array('numberposts' => '10');
                    $recent_posts = wp_get_recent_posts($args);
                        foreach ($recent_posts as $recent) {
                            echo '<li><a href="' . esc_url( get_permalink( $recent["ID"] ) ) . '">' . esc_html( $recent["post_title"] ) . '</a></li>';
                        }
                ?>
            </ul>
    <?php
    }
    ?>
</div>
<?php $error_page && $error_page->reset(); ?>
