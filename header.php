<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package boylerplate
 */
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->
    
    <meta name="theme-color" content="#fafafa">    

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->
    
    <header id="masthead" class="site-header" role="banner">
        
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'boylerplate' ); ?></a>
        
        <div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title uk-heading-primary"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title uk-text-lead"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$_s_description = get_bloginfo( 'description', 'display' );
			if ( $_s_description || is_customize_preview() ) :
				?>
				<p class="site-description uk-text-lead"><?php echo $_s_description; /* WPCS: xss ok. */ ?></p>
            <?php endif; ?>			
        </div><!-- .site-branding -->
        
        <nav role="navigation" class="site-navigation main-navigation uk-navbar-container uk-navbar-transparent">
        <!-- This is a button toggling the modal -->
        <button uk-toggle="target: #my-id" type="button" class="uk-align-right uk-hidden@m"><i class="fas fa-bars"></i></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'container_class' => 'uk-navbar-left uk-visible@m',
				'menu_class' 	=> 'uk-navbar-nav',
			) );
			?>		
<!-- This is the modal -->
<div id="my-id" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog uk-padding" uk-height-viewport>
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Headline</h2>
        </div>
        <div class="uk-modal-body">        
        <?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'container_class' => 'uk-nav',
				'menu_class' 	=> 'uk-nav',
			) );
			?>
        </div>
        <div class="uk-modal-footer"></div>	
    </div>
</div>            	
        </nav><!-- .site-navigation .main-navigation -->

    </header><!-- #masthead .site-header -->
    
    <main class="site-main" uk-grid>