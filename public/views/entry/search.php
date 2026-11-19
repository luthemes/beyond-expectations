<?php
/**
 * Beyond Expectations - content-search.php
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */
?>
<article <?php Backdrop\Attr\display( 'entry', 'search' ); ?>>
    <header class="entry__header">
        <?php the_title(sprintf('<h2 class="entry__title"><a class="entry__title-anchor" href="%s">', esc_url(get_permalink())), '</a></h2>'); ?> 
    </header>
    <div class="entry__body cf">
        <div class="entry__metadata">
            <?php BeyondExpectations\entry_posted_on(); ?>
        </div>
        <div class="entry__content">
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
            <div class="entry__footer entry__terms">
                <?php BeyondExpectations\entry_taxonomies(); ?>
            </div>
        </div>
    </div>
</article>
<?php comments_template(); ?>