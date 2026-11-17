<?php
/**
 * Template Name: Custom Sidebar Template
 *
 * Beyond Expectations - custom-sidebar.php
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
                <?php get_template_part('template-parts/content', 'custom-sidebar'); ?>
        <?php endwhile; ?>
                <div class="paging-navigation">
                    <?php the_posts_pagination(); ?>
                </div>
        <?php else : ?>
                    <?php get_template_part('template-parts/content', 'none'); ?>
        <?php endif; ?>
    </div>
<?php get_sidebar('custom'); ?>
<?php get_footer(); ?>