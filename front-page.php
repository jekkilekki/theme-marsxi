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
<div class="panel-content site-headline-panel">
    <div class="wrap">
        <header class="entry-header">
            <h2 class="entry-title"><?php echo get_theme_mod( 'site_headline', '' ); ?></h1>
        </header>
        <?php echo get_theme_mod( 'site_headline_description', '' ); ?>
    </div>
</div>
<?php 
endif; 
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php // Show the selected frontpage content.
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
                if ( get_theme_mod( 'panel_last' ) != false ) {
                        global $post;
                        $post = get_post( get_theme_mod( 'panel_last' ) );
                        setup_postdata( $post );
                        //set_query_var( 'panel', $id );

                        get_template_part( 'template-parts/page/content', 'front-page-panel-last' );

                        wp_reset_postdata();
                }
                ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
