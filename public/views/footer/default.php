<?php
/**
 * Beyond Expectations - footer.php
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */
?>
</section>
    <footer <?php Backdrop\Attr\display( 'site-footer', '', [ 'id' => 'site-footer', 'class' => 'site-footer app-footer' ] ); ?>>
        <div id="site-info" class="site-footer__info app-footer__inner container">
            <div class="site-footer__title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
            <?php BeyondExpectations\Template\Footer::displayCredit( [ 'before' => '<div class="site-footer__credit app-footer__credit">', 'after' => '</div>' ] ); ?>
        </div>
    </footer>
    </div>
    <?php wp_footer(); ?>
</body>
</html>