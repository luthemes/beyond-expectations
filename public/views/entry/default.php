<?php
/**
 * Beyond Expectations - content.php
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */
?>
<article <?php Backdrop\Attr\display( 'entry', 'default' ); ?>>
    <header class="entry__header">
        <?php the_title(sprintf('<h2 class="entry__title"><a href="%s">', esc_url(get_permalink())), '</a></h2>'); ?> 
    </header>
    <div class="entry__body cf">
        <div class="entry__metadata">
            <?php BeyondExpectations\entry_posted_on(); ?>
        </div>
        <div class="entry__content">
            <?php the_content(); ?>
            <div class="entry__footer">
                <?php BeyondExpectations\entry_taxonomies(); ?>
            </div>
        </div>
    </div>
</article>
<?php comments_template(); ?>