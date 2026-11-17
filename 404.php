<?php
/**
 * Beyond Expectations - 404.php
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
        <?php Backdrop\View\display( 'entry', 'none' ); ?>
    </div>
<?php Backdrop\View\display( 'sidebar', 'primary' ); ?>
<?php get_footer(); ?>