<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage MarsXI
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site <?php echo get_theme_mod( 'top_menu_position', 'below' ) == 'top' ? 'fixed-top-menu' : ''; ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
            
                <?php get_template_part( 'template-parts/header/header', 'image' ); ?>

		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<div class="navigation-top <?php echo get_theme_mod( 'logo_position_options', 'header' ) == 'top-menu' ? 'menu-logo': ''; ?>">
				<div class="wrap">
                                    
                                        <?php if( get_theme_mod( 'logo_position_options', 'header' ) == 'top-menu' ) { ?>
                                            <div class="top-menu-logo">
                                                <?php the_custom_logo(); ?>
                                            </div>
                                        <?php } ?>
                                    
					<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
				</div><!-- .wrap -->
			</div><!-- .navigation-top -->
		<?php endif; ?>

	</header><!-- #masthead -->

	<?php
        /**
         * ALL Page Headline -> Front Page ONLY option in front-page.php
         */
        if ( get_theme_mod( 'site_headline', '' ) != '' && get_theme_mod( 'site_headline_options', 'all-pages' ) != 'front-page' ) : ?>
        <div class="panel-content site-headline-panel <?php echo get_theme_mod( 'page_layout' ) == 'one-column' ? 'panel-one-column' : ''; ?>">
            <div class="wrap">
                <header class="entry-header">
                    <h2 class="entry-title"><?php echo get_theme_mod( 'site_headline', '' ); ?></h1>
                </header>
                <div class="entry-content">
                    <?php echo get_theme_mod( 'site_headline_description', '' ); ?>
                </div>
            </div>
        </div>
        <?php 
        endif; 
        
	// If a regular post or page, and not the front page, show the featured image.
	if ( has_post_thumbnail() && ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) ) :
		echo '<div class="single-featured-image-header">';
		the_post_thumbnail( 'twentyseventeen-featured-image' );
		echo '</div><!-- .single-featured-image-header -->';
	endif;
	?>

	<div class="site-content-contain">
		<div id="content" class="site-content">
                    
                    
