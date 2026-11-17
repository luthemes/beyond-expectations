<?php
/**
 * Beyond Expectations - content-page.php
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */
?>
<article <?php Backdrop\Attr\display( 'entry', 'page' ); ?>>
    <?php the_post_thumbnail( BeyondExpectations\feature_image_size() ); ?>
    <header class="entry__header">
        <?php the_title(sprintf('<h1 class="entry__title"><a href="%s">', esc_url(get_permalink())), '</a></h1>'); ?> 
    </header>
    <div class="entry__content entry__content--full-width">
        <?php the_content(); ?>
        <?php wp_link_pages(); ?>
        <div class="entry__footer">
            <?php BeyondExpectations\entry_taxonomies(); ?>
        </div>
    </div>
</article>
<?php comments_template(); ?>