<?php
/**
 * Beyond Expectations - comment/default.php
 *
 * A single comment, loaded by `wp_list_comments()` in `comments/default.php`. `$data` holds the
 * `comment`, `args` and `depth`. The closing `</li>` is added by ClassicPress.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */
?>
<li <?php Backdrop\Attr\display( 'comment' ); ?>>

	<article id="div-comment-<?php comment_ID(); ?>" class="comment__body">

		<header class="comment__meta">
			<?php Backdrop\Theme\Comment\display_parent_link( [
				// Translators: %s is the name of the person being replied to.
				'text'   => __( 'In reply to %s', 'beyond-expectations' ),
				'depth'  => 3,
				'class'  => 'comment__parent-link',
				'before' => '<span class="comment__parent">',
				'after'  => '</span>',
			] ); ?>

			<?php echo get_avatar( $data->comment, $data->args['avatar_size'], '', '', [ 'class' => 'comment__avatar' ] ); ?>

			<span class="comment__author">
				<?php Backdrop\Theme\Comment\display_author_link( [ 'class' => 'comment__author-link' ] ); ?>
			</span>

			<span class="comment__metadata">
				<?php Backdrop\Theme\Comment\display_permalink( [
					'class' => 'comment__permalink',
					'text'  => Backdrop\Theme\Comment\render_date(),
				] ); ?>
				<?php Backdrop\Theme\Comment\display_edit_link( [
					'class'  => 'comment__edit-link',
					'text'   => esc_html__( 'Edit', 'beyond-expectations' ),
					'before' => BeyondExpectations\sep(),
				] ); ?>
				<?php Backdrop\Theme\Comment\display_reply_link( [
					'class'     => 'comment__reply-link',
					'add_below' => 'div-comment',
					'depth'     => $data->depth,
					'max_depth' => $data->args['max_depth'],
					'before'    => BeyondExpectations\sep(),
				] ); ?>
			</span>
		</header>

		<div class="comment__content">

			<?php if ( ! Backdrop\Theme\Comment\is_approved() ) : ?>
				<p class="comment__moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'beyond-expectations' ); ?></p>
			<?php endif; ?>

			<?php comment_text(); ?>
		</div>

	</article>

<?php /* No closing </li> is needed. ClassicPress adds it. */ ?>
