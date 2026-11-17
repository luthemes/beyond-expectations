<?php
/**
 * Beyond Expectations - sidebar-page.php
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */
?>
<div <?php Backdrop\Attr\display( 'widget-area', 'secondary', [ 'id' => 'widget-area' ] ); ?>>
    <?php dynamic_sidebar('secondary'); ?>
</div>