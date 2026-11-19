<?php
/**
 * Beyond Expectations - default.php
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */
?>
    <div <?php Backdrop\Attr\display( 'content-area', '', [ 'id' => 'content-area', 'class' => 'content-area app-main' ] ); ?>>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php Backdrop\View\display( 'entry', get_post_format() ?: 'default' ); ?>
        <?php endwhile; ?>
                <div class="paging-navigation">
                    <?php Backdrop\Pagination\display( 'posts', [
                        'prev_text' => esc_html__( 'Previous', 'beyond-expectations' ),
                        'next_text' => esc_html__( 'Next', 'beyond-expectations' )
                    ] ); ?>
                </div>
        <?php else : ?>
                <?php Backdrop\View\display( 'entry', 'none' ); ?>
        <?php endif; ?>
    </div>
<?php Backdrop\View\display( 'sidebar', 'primary' ); ?>
