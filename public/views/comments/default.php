<?php
/**
 * Beyond Expectations - comments.php
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */
?>
<?php
if ( post_password_required() ) {
	return;
}
?>

<div <?php Backdrop\Attr\display( 'comments-area', '', [ 'id' => 'comments-area' ] ); ?>>

<?php // You can start editing here -- including this comment! ?>

<?php if (have_comments()) : ?>
    <h2 class="comments-area__title">
            <?php
                    printf(_nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'beyond-expectations' ),
                            number_format_i18n( get_comments_number() ));
            ?>
    </h2>

    <ol class="comments-area__list">
            <?php
                    wp_list_comments( array(
                            'style'      => 'ol',
                            'short_ping' => true,
                            'avatar_size' => 50,
                    ) );
            ?>
    </ol><!-- .comments-area__list -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav-below" class="comments-area__navigation cf" role="navigation">
            <div class="comments-area__previous"><?php previous_comments_link( BeyondExpectations\svg( 'arrow-left-circle' ) . __( 'Older Comments', 'beyond-expectations' ) ); ?></div>
            <div class="comments-area__next"><?php next_comments_link( BeyondExpectations\svg( 'arrow-right-circle' ) . __( 'Newer Comments', 'beyond-expectations' ) ); ?></div>
    </nav>
    <?php endif; ?>

<?php endif; ?>
<?php comment_form(); ?>

</div>