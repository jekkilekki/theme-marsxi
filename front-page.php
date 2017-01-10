<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage MarsXI
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php
/**
 * Front Page Headline (Front Page ONLY)
 */
if ( get_theme_mod( 'site_headline', '' ) != '' && get_theme_mod( 'site_headline_options', 'all-pages' ) == 'front-page' ) : ?>
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
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php // Show the selected Frontpage Content.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/page/content', 'front-page' );
			endwhile;
		else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
			get_template_part( 'template-parts/post/content', 'none' );
		endif; ?>

		<?php
		// Get each of our panels and show the post data.
		if ( 0 !== twentyseventeen_panel_count() || is_customize_preview() ) : // If we have pages to show.

			/**
			 * Filter number of front page sections in Twenty Seventeen.
			 *
			 * @since Twenty Seventeen 1.0
			 *
			 * @param $num_sections integer
			 */
			$num_sections = apply_filters( 'twentyseventeen_front_page_sections', 4 );
			global $twentyseventeencounter;

			// Create a setting and control for each of the sections available in the theme.
			for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
				$twentyseventeencounter = $i;
				twentyseventeen_front_page_section( null, $i );
			}

                endif; // The if ( 0 !== twentyseventeen_panel_count() ) ends here. ?>
            
                <?php
                /**
                 * Last Panel Section (light gray background)
                 * 
                 * The last panel on the page (if set) follows the style of Frontpage Content (above)
                 * but has a light gray background
                 * 
                 * @since MarsXI 1.0
                 */
                if ( get_theme_mod( 'panel_last' ) != false ) {
                        global $post;
                        $post = get_post( get_theme_mod( 'panel_last' ) );
                        setup_postdata( $post );
                        //set_query_var( 'panel', $id );

                        get_template_part( 'template-parts/page/content', 'front-page-panel-last' );

                        wp_reset_postdata();
                }
                ?>
            
                <?php
                /**
                 * Call to Action Section
                 * 
                 * Description
                 * 
                 * @since MarsXI 1.0
                 */
                if( get_theme_mod( 'cta_page_display' ) != false && get_theme_mod( 'cta_options' ) != 'all-pages' ) {
                        global $post;
                        $post = get_post( get_theme_mod( 'cta_page_display' ) );
                        setup_postdata( $post );
                        //set_query_var( 'panel', ++$id );

                        get_template_part( 'template-parts/page/content', 'front-page-action' );

                        wp_reset_postdata();       
                }
                ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
