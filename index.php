<?php
/**
 * Beyond Expectations - index.php
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */
?>
<?php get_header(); ?>
    <div id="content-area" class="content-area">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php Backdrop\View\display( 'entry', get_post_format() ?: 'default' ); ?>
        <?php endwhile; ?>
                <div class="paging-navigation">
                    <?php the_posts_pagination(); ?>
                </div>
        <?php else : ?>
                <?php Backdrop\View\display( 'entry', 'none' ); ?>
        <?php endif; ?>
    </div>
<?php Backdrop\View\display( 'sidebar', 'primary' ); ?>
<?php get_footer(); ?>