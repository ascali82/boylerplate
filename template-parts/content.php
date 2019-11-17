
<article id="post-<?php the_ID(); ?>" <?php post_class('uk-section uk-section-small uk-padding-remove-top'); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title uk-article-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title uk-margin-remove-adjacent uk-text-bold uk-margin-small-bottom"><a class="uk-link-reset" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
        ?>
	</header><!-- .entry-header -->
        <?php
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
                <p class="uk-article-meta">
				<?php
				theme_posted_on();
				theme_posted_by();
                theme_entry_cat();
				?>
                </p>
			</div><!-- .entry-meta -->
		<?php endif; ?>        

	 <?php //_s_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', '_s' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<p>
            <span class="uk-button uk-button-text">
 			<?php
			$_s_comment_count = get_comments_number();
			if ( '1' === $_s_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One Comment', 'boylerplate' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s comment', '%1$s comments', $_s_comment_count, 'comments title', '_s' ) ),
					number_format_i18n( $_s_comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?> 
            </span>
        </p>
	</footer><!-- .entry-footer -->
    <hr>
</article><!-- #post-<?php the_ID(); ?> -->