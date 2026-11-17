<?php
/**
 * Beyond Expectations - full-width.php
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */
?>
    <div id="content-area" class="content-area full-width">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php Backdrop\View\display( 'entry', 'full-width' ); ?>
        <?php endwhile; ?>
                <div class="paging-navigation">
                    <?php the_posts_pagination(); ?>
                </div>
        <?php else : ?>
                    <?php Backdrop\View\display( 'entry', 'none' ); ?>
        <?php endif; ?>
    </div>
