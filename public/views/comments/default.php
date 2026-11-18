<?php
/**
 * Beyond Expectations - comments/default.php
 *
 * The comments area: the comment list, comment navigation and the comment form. Each comment is
 * loaded from `public/views/comment` (see `comment/default.php`).
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */

if ( post_password_required() ) {
	return;
}
?>
<section <?php Backdrop\Attr\display( 'comments-area', '', [ 'id' => 'comments' ] ); ?>>

	<?php if ( have_comments() ) : ?>

		<h2 class="comments-area__title">
			<?php
			printf(
				// Translators: %s is the number of comments.
				esc_html( _nx( 'One Comment', '%s Comments', get_comments_number(), 'comments title', 'beyond-expectations' ) ),
				esc_html( number_format_i18n( get_comments_number() ) )
			);
			?>
		</h2>

		<ol class="comments-area__list">
			<?php
			wp_list_comments( [
				'style'       => 'ol',
				'avatar_size' => 50,
				'callback'    => function( $comment, $args, $depth ) {
					Backdrop\View\display( 'comment', Backdrop\Theme\Comment\hierarchy(), compact( 'comment', 'args', 'depth' ) );
				},
			] );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="comments-area__navigation cf" aria-label="<?php esc_attr_e( 'Comments', 'beyond-expectations' ); ?>">
				<div class="comments-area__previous"><?php previous_comments_link( BeyondExpectations\Tools\Svg::render( 'arrow-left-circle' ) . esc_html__( 'Older Comments', 'beyond-expectations' ) ); ?></div>
				<div class="comments-area__next"><?php next_comments_link( BeyondExpectations\Tools\Svg::render( 'arrow-right-circle' ) . esc_html__( 'Newer Comments', 'beyond-expectations' ) ); ?></div>
			</nav>
		<?php endif; ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="comments-area__closed"><?php esc_html_e( 'Comments are closed.', 'beyond-expectations' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>

	<?php comment_form( [
		'class_container'    => 'comment-respond comments-area__respond',
		'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title comments-area__reply-title">',
	] ); ?>

</section>
