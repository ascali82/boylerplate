<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
            <?php
		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;
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
		//	the_posts_navigation();
		//	learnplus_blog_pagination();
		theme_pagination();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>

            </div><!-- #content .site-content -->
        </article><!-- #primary .content-area -->


<?php
get_sidebar();
get_footer();