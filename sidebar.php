<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package boylerplate
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
        <aside id="secondary" class="widget-area uk-width-1-4@s" role="complementary">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </aside><!-- #secondary .widget-area -->