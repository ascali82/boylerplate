<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package boylerplate
 */
get_header();
?>

<article id="primary" class="content-area uk-width-1-1">
            <div id="content" class="site-content">
			<!-- start breadcrumbs -->
            <?php // the_breadcrumb();
		custom_breadcrumbs(); ?>
<!-- end breadcrumbs -->
			<section class="error-404 not-found">
			<div class="uk-background-cover uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle" style="background-image: url(<?php bloginfo('template_url'); ?>/assets/img/404.jpg );" >
				<header class="page-header">
					
					
					<h1 class="page-title uk-text-center">
								<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'boylerplate' ); ?></h1>

					
						 
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'boylerplate' ); ?></p>

                    <?php
                    get_template_part( 'searchform404' );
					get_search_form();
				//	the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'boylerplate' ); ?></h2>
						<ul>
							<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
							?>
						</ul>
					</div><!-- .widget -->

					<?php
					/* translators: %1$s: smiley */
					$boylerplate_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'boylerplate' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$boylerplate_archive_content" );
					the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div><!-- .page-content -->
				</div>
			</section><!-- .error-404 -->

            </div><!-- #content .site-content -->
        </article><!-- #primary .content-area -->

<?php
get_footer();