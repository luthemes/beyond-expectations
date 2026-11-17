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

<div id="comments-area" class="comments-area">

<?php // You can start editing here -- including this comment! ?>

<?php if (have_comments()) : ?>
    <h2 class="comments-title">
            <?php
                    printf(_nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'beyond-expectations' ),
                            number_format_i18n( get_comments_number() ));
            ?>
    </h2>

    <ol class="comment-list">
            <?php
                    wp_list_comments( array(
                            'style'      => 'ol',
                            'short_ping' => true,
                            'avatar_size' => 50,
                    ) );
            ?>
    </ol><!-- .comment-list -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav-below" class="comment-navigation cf" role="navigation">
            <div class="comment-previous"><?php previous_comments_link( '<i class="fa fa-arrow-circle-o-left"></i> ' . __( 'Older Comments', 'beyond-expectations' ) ); ?></div>
            <div class="comment-next"><?php next_comments_link( '<i class="fa fa-arrow-circle-o-right"></i> '.__( 'Newer Comments', 'beyond-expectations' ) ); ?></div>
    </nav>
    <?php endif; ?>

<?php endif; ?>
<?php comment_form(); ?>

</div>