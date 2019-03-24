<?php
/**
 * Custom template for the comments section
 *
 *
 * @package boylerplate
 */

 		// Hook test to add class to $link output
         function custom_hook( $return, $author, $comment_ID ) {
			$code = 'class="uk-link-reset"';
					return str_replace('<a href=', '<a '.$code.' href=', $return );
		}
		add_filter( 'get_comment_author_link', 'custom_hook', 10, 3 );


// Comments
function theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'boylerplate' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'boylerplate' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li id="li-comment-<?php comment_ID(); ?>">
		<article  id="comment-<?php comment_ID(); ?>" <?php $classes = array(
		'uk-comment',
		'uk-visible-toggle'
	); comment_class( $classes ); ?>>
	<header class="uk-comment-header uk-position-relative">
	<div class="uk-grid-medium uk-flex-middle comment-author vcard" uk-grid>
	<div class="uk-width-auto">
	<?php $args  = array(
    //    'size'            => 80,
        'class'         => 'uk-comment-avatar',
); echo get_avatar( $comment, $args ); ?> 
 </div>
 <div class="uk-width-expand">
 <?php printf( __( '%s <span class="says">says:</span>', 'boylerplate' ), sprintf( '<h4 class="uk-comment-title uk-margin-remove">%s</h4>', get_comment_author_link() ) ); ?>
                        <p class="uk-comment-meta uk-margin-remove-top"><a class="uk-link-reset" href="#">12 days ago</a></p>
                    </div>
                </div>
                <div class="uk-position-top-right uk-position-small uk-hidden-hover"><a class="uk-link-muted" href="#">Reply</a></div>
            </header>

			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'boylerplate' ); ?></em>
					<br />
				<?php endif; ?>
				<div class="comment-meta commentmetadata">
					
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'boylerplate' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( 'Edit', 'boylerplate' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
				<?php comment_text(); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</div>
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
// endif; // ends check for theme_comment()