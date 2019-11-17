<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package boylerplate
 */
if ( ! function_exists( 'theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function theme_setup() {

	// Add theme support for Post Formats
	add_theme_support( 'post-formats', array( 
                'status', 
                'quote', 
                'gallery', 
                'image', 
                'video', 
                'audio', 
                'link', 
                'aside', 
                'chat' 
    ) );

	// Add theme support for Featured Images
	add_theme_support( 'post-thumbnails' );

	// Add theme support for Custom Background
	$background_args = array(
            	'default-image'          => '',
            	'default-preset'         => 'default', // 'default', 'fill', 'fit', 'repeat', 'custom'
            	'default-position-x'     => 'left',    // 'left', 'center', 'right'
            	'default-position-y'     => 'top',     // 'top', 'center', 'bottom'
            	'default-size'           => 'auto',    // 'auto', 'contain', 'cover'
            	'default-repeat'         => 'repeat',  // 'repeat-x', 'repeat-y', 'repeat', 'no-repeat'
            	'default-attachment'     => 'scroll',  // 'scroll', 'fixed'
            	'default-color'          => '',
            	'wp-head-callback'       => '_custom_background_cb',
            	'admin-head-callback'    => '',
            	'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-background', $background_args );

	// Add theme support for Custom Header
	$header_args = array(
                'default-image'          => '',
                'width'                  => 0,
                'height'                 => 0,
                'flex-width'             => false,
                'flex-height'            => false,
                'uploads'                => true,
                'random-default'         => false,
                'header-text'            => false,
                'default-text-color'     => '',
                'wp-head-callback'       => '',
                'admin-head-callback'    => '',
                'admin-preview-callback' => '',
                'video'                  => true,
                'video-active-callback'  => '',
	);
	add_theme_support( 'custom-header', $header_args );

	// Add theme support for Custom Logo
	add_theme_support( 'custom-logo', array(
                'height'      => 100,
                'width'       => 400,
                'flex-height' => true,
                'flex-width'  => true,
                'header-text' => array( 'site-title', 'site-description' ),
	) );

	// Add theme support for Automatic Feed Links
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Add theme support for HTML5 Semantic Markup
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Add theme support for document Title tag
	add_theme_support( 'title-tag' );

	// Add theme support for selective refresh for widgets
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add theme support for Translation
	load_theme_textdomain( 'boylerplate', get_template_directory() . '/language' );

	// Add theme support for custom CSS in the TinyMCE visual editor
	add_editor_style();
}
endif;
add_action( 'after_setup_theme', 'theme_setup' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'theme_content_width', 0 );

// Register Navigation Menus
function custom_navigation_menus() {

	$locations = array(
		'menu-1' => __( 'Primary', 'boylerplate' ),
	);
	register_nav_menus( $locations );

}
add_action( 'init', 'custom_navigation_menus' );

// Register Sidebars
function custom_sidebars() {

	$args = array(
		'id'            => 'sidebar-1',
		'class'         => 'widget-area',
		'name'          => esc_html__( 'Sidebar1', 'boylerplate' ),
		'description'   => esc_html__( 'Add widgets here.', 'boylerplate' ),
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
	);
	register_sidebar( $args );

}
add_action( 'widgets_init', 'custom_sidebars' );

/**
 * Enqueue scripts and styles.
 */
function custom_scripts() {
    // Styles

    // Enqueue Normalize
    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/css/normalize.css', false, false );
    // Enqueue Main
    wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.css', false, false );
    // Enqueue UiKit
    wp_enqueue_style( 'uikit', get_template_directory_uri() . '/assets/css/uikit.min.css', false, false );
    // Enqueue FontAwesome
    wp_enqueue_style( 'FontAwesome', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css', false, false );
    // Enqueue Theme Style
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', false, false );

    // Scripts
	
	// Modernizr
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-3.6.0.min.js', array(), false, true );
	// JQuery
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', array(), false, true );
	// UiKit
	wp_enqueue_script( 'uikit', get_template_directory_uri() . '/assets/js/uikit.min.js', array(), false, true );
	// UiKit Icons
	wp_enqueue_script( 'uikit-icons', get_template_directory_uri() . '/assets/js/uikit-icons.min.js', array(), false, true );
	// Plugins
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/assets/js/plugins.js', array(), false, true );
	// Main
	wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array(), false, true );

//	wp_enqueue_script( 'widgetulclass', get_template_directory_uri() . '/assets/js/widgetulclass.js', array(), false, true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'custom_scripts' );

// Add class to navbar items
function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'uk-active ';
    }
    return $classes;
}
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

// Gestione del copyright del footer
	function data_copyright() {
		global $wpdb;
		$copyright_dates = $wpdb->get_results("
		  SELECT
		  YEAR(min(post_date_gmt)) AS firstdate,
		  YEAR(max(post_date_gmt)) AS lastdate
		  FROM
		  $wpdb->posts
		  WHERE
		  post_status = 'publish'
		  ");
		$output = '';
		if($copyright_dates) {
		  $copyright = "&copy; " . $copyright_dates[0]->firstdate;
		  if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
			$copyright .= '-' . $copyright_dates[0]->lastdate;
		  }
		$output = $copyright;
		}
		return $output;
		}



// Comment manager
require get_template_directory() . '/inc/comments-manager.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/*=============================================
=            PAGINATION			            =
* @param (int) $range
=============================================*/

function theme_pagination( $range = 5 ) {

    global $paged, $wp_query, $post;
    
    $nav_class = ( is_single() ) ? 'post-navigation uk-pagination' : 'paging-navigation uk-pagination uk-flex-center';

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages <= 1 && ( is_home() || is_archive() || is_search() ) )
		return;

    echo '<div id="pagination"><ul class="'. $nav_class .'" uk-margin>' . "\n";
    
    if ( is_single() ) { // navigation links for single posts

        $prev_post = get_adjacent_post(false, '', true);
        if(!empty($prev_post)) {
        echo '<li><a href="' . get_permalink($prev_post->ID) . '" title="' . $prev_post->post_title . '"><span class="uk-margin-small-right" uk-pagination-previous></span>' . $prev_post->post_title . '</a></li>'; }

        $next_post = get_adjacent_post(false, '', false);
        if(!empty($next_post)) {
        echo '<li class="uk-margin-auto-left"><a href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '">' . $next_post->post_title . '<span class="uk-margin-small-left" uk-pagination-next></span></a></li>'; }

    }
    
    elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { // navigation links for home, archive, and search pages
        
		// How much pages do we have?
		if ( !$max_page )
			$max_page = $wp_query->max_num_pages;
        
        /** Previous Page Link */
        if ( get_previous_posts_link() )
            printf( '<li>%s</li>' . "\n", get_previous_posts_link('<span title="Previous page" uk-pagination-previous></span><span class="uk-visible@m uk-margin-small-left">Indietro</span>') );
        
		// We need the sliding effect only if there are more pages than is the sliding range
		if ( $max_page > $range ) :
			// When closer to the beginning
			if ( $paged < $range ) :
				for ( $i = 1; $i <= ($range + 1); $i++ ) {
                    $liclass = $i == $paged ? 'uk-active' : ''; 
					$class = $i == $paged ? 'current' : '';
					echo '<li class="'.$liclass.'"><a href="'.get_pagenum_link($i).'" class="paged-num '.$class.'" title="'.$i.'"> '.$i.' </a></li>';
				}
			// When closer to the end
			elseif ( $paged >= ( $max_page - ceil($range/2)) ) :
				for ( $i = $max_page - $range; $i <= $max_page; $i++ ){
                    $liclass = $i == $paged ? 'uk-active' : '';
					$class = $i == $paged ? 'current' : '';
					echo '<li class="'.$liclass.'"><a href="'.get_pagenum_link($i).'" class="paged-num '.$class.'" title="'.$i.'"> '.$i.' </a></li>';
				}
			endif;
		// Somewhere in the middle
		elseif ( $paged >= $range && $paged < ( $max_page - ceil($range/2)) ) :
			for ( $i = ($paged - ceil($range/2)); $i <= ($paged + ceil($range/2)); $i++ ) {
                $liclass = $i == $paged ? 'uk-active' : '';
				$class = $i == $paged ? 'current' : '';
				echo '<li class="'.$liclass.'"><a href="'.get_pagenum_link($i).'" class="paged-num '.$class.'" title="'.$i.'"> '.$i.' </a></li>';
			}
		// Less pages than the range, no sliding effect needed
		else :
			for ( $i = 1; $i <= $max_page; $i++ ) {
                $liclass = $i == $paged ? 'uk-active' : '';
				$class = $i == $paged ? 'current' : '';
				echo '<li class="'.$liclass.'"><a href="'.get_pagenum_link($i).'" class="paged-num '.$class.'" title="'.$i.'"> '.$i.' </a></li>';
			}
		endif;
        
        /** Next Page Link */
        if ( get_next_posts_link() ) { 
                        
                printf( '<li>%s</li>' . "\n", get_next_posts_link('<span title="Next Page"  uk-pagination-next><span class="uk-visible@m uk-margin-small-right">Avanti</span></span>') );
 
        }
    }
    
    echo '</ul></div>' . "\n";
}

/*=============================================
=            BREADCRUMBS			            =
=============================================*/
//  to include in functions.php
function custom_breadcrumbs() {
       
    // Settings
//    $separator          = '&gt;';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'uk-breadcrumb';
    $home_title         = 'Home';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
//        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
//                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
//                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
//                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
//                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
//                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
//            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
//            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
//            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
       
        echo '</ul>';
           
    }
       
}