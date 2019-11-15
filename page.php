<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile; // End of the loop.
		?>

            </div><!-- #content .site-content -->
        </article><!-- #primary .content-area -->


<?php
get_sidebar();
get_footer();