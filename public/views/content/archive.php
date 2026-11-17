<?php
/**
 * Beyond Expectations - archive.php
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
	       <header class="archive-header">
                <h2 class="archive-header__title">
                    <?php the_archive_title(); ?>
                </h2>
            </header>
            <?php while (have_posts()) : the_post(); ?>
                <?php Backdrop\View\display( 'entry', 'archive' ); ?>
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
