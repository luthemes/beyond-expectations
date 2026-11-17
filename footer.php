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
    <footer id="site-footer" class="site-footer">
        <div id="site-info" class="site-info">
            <div class="info-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
            <?php if ( function_exists( 'classicpress_version' ) ) : ?>
                <a href="<?php echo esc_url( 'https://www.classicpress.net/' ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'beyond-expectations' ), 'ClassicPress' ); ?></a>
            <?php else : ?>
                <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'beyond-expectations' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'beyond-expectations' ), 'WordPress' ); ?></a>
            <?php endif; ?>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>