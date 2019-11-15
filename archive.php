<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package boylerplate
 */
get_header();
?>

<article id="primary" class="content-area uk-section-default uk-width-3-4@s">
            <div id="content" class="site-content">
			<!-- start breadcrumbs -->
<?php // the_breadcrumb();
		custom_breadcrumbs(); ?>
<!-- end breadcrumbs -->

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
			wpbeginner_numeric_posts_nav();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>

</div><!-- #content .site-content -->
        </article><!-- #primary .content-area -->

<?php
get_sidebar();
get_footer();