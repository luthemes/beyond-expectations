<?php
/**
 * Beyond Expectations - single.php
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */
?>
    <div <?php Backdrop\Attr\display( 'content-area', '', [ 'id' => 'content-area' ] ); ?>>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php Backdrop\View\display( 'entry', 'single' ); ?>
        <?php endwhile; ?>
        <?php else : ?>
        <?php endif; ?>
    </div>
<?php Backdrop\View\display( 'sidebar', 'primary' ); ?>
