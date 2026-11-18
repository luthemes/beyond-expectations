<?php
/**
 * Beyond Expectations - comment/ping.php
 *
 * A pingback or trackback, loaded by `wp_list_comments()` in `comments/default.php`. The closing
 * `</li>` is added by ClassicPress.
 *
 * @package   Beyond Expectations
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2016-2026 Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://luthemes.com/portfolio/beyond-expectations
 */
?>
<li <?php Backdrop\Attr\display( 'comment' ); ?>>

	<article id="div-comment-<?php comment_ID(); ?>" class="comment__body comment__body--ping">

		<header class="comment__meta">
			<span class="comment__type"><?php echo 'trackback' === get_comment_type() ? esc_html__( 'Trackback', 'beyond-expectations' ) : esc_html__( 'Pingback', 'beyond-expectations' ); ?></span>

			<span class="comment__author">
				<?php Backdrop\Theme\Comment\display_author_link( [ 'class' => 'comment__author-link' ] ); ?>
			</span>

			<?php Backdrop\Theme\Comment\display_edit_link( [ 'class' => 'comment__edit-link', 'text' => esc_html__( 'Edit', 'beyond-expectations' ), 'before' => BeyondExpectations\sep() ] ); ?>
		</header>

	</article>

<?php /* No closing </li> is needed. ClassicPress adds it. */ ?>
