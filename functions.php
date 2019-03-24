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
