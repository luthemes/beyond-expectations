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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title(sprintf('<h1 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h1>'); ?> 
    </header>
    <div class="metadata-content cf">
        <div class="entry-metadata">
            <?php BeyondExpectations\entry_posted_on(); ?>
        </div>
        <div class="entry-content">
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
            <div class="entry-footer">
                <?php BeyondExpectations\entry_taxonomies(); ?>
            </div>
        </div>
    </div>
</article>
<?php comments_template(); ?>