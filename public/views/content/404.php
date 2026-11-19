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
    <div <?php Backdrop\Attr\display( 'content-area', '', [ 'id' => 'content-area', 'class' => 'content-area app-main' ] ); ?>>
        <?php Backdrop\View\display( 'entry', 'none', [ 'error' => $error ] ); ?>
    </div>
<?php Backdrop\View\display( 'sidebar', 'primary' ); ?>
