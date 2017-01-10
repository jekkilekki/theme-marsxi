<?php
/**
 * Template part for displaying pages on the Front Page
 *
 * @package WordPress
 * @subpackage MarsXI
 * @since 1.0
 * @version 1.0
 */

global $twentyseventeencounter;
// Check for blog page (recent-posts-panel) FIRST, don't assign 'slide-panel' class if it exists
if ( get_the_ID() === (int) get_option( 'page_for_posts') ) {
    $extra_panel_class = 'recent-posts-panel';
} else if ( get_theme_mod( 'frontpage_slide_panel_images', false ) ) {
    $extra_panel_class = 'slide-panel';
} else {
    $extra_panel_class = '';
}
?>

<article id="panel-action" <?php post_class( 'twentyseventeen-panel ' . $extra_panel_class . ' ' ); ?> >

	<?php if ( has_post_thumbnail() && ! get_theme_mod( 'frontpage_slide_panel_images', false ) ) :
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

		// Calculate aspect ratio: h / w * 100%.
		$ratio = $thumbnail[2] / $thumbnail[1] * 100;
		?>

		<div class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
			<div class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></div>
		</div><!-- .panel-image -->

	<?php endif; ?>

	<div class="panel-content <?php echo get_theme_mod( 'page_layout' ) == 'one-column' ||
                                             get_theme_mod( 'frontpage_page_layout' ) == 'one-column' ? 'page-one-column' : ''; ?>">
		<div class="wrap">
			<header class="entry-header">
                                
                                <?php 
                                if ( has_post_thumbnail() && get_theme_mod( 'frontpage_slide_panel_images', false ) ) {
                                    
                                        echo '<figure class="slide-in-image">';
                                        the_post_thumbnail();
                                        echo '</figure>';
                                    
                                } else {
                            
                                        the_title( '<h2 class="entry-title">', '</h2>' );
                                        twentyseventeen_edit_link( get_the_ID() ); 
                                        
                                }
                                ?>

			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
                                        if ( has_post_thumbnail() && get_theme_mod( 'frontpage_slide_panel_images', false ) ) {
                                            
                                                the_title( '<h2 class="entry-title">', '</h2>' );
                                                twentyseventeen_edit_link( get_the_ID() ); 
                                                
                                        }

					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
						get_the_title()
					) );
				?>
                            
                                <?php if ( get_the_ID() !== (int) get_option( 'page_for_posts' ) ) : ?>
                            
                                        <div class="continue-reading button">
                                            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                                                <?php
                                                    printf(
                                                                /* translators: %s: Name of current post. */
                                                                wp_kses( __( 'Learn More … %s', 'jkl' ), array( 'span' => array( 'class' => array() ) ) ),
                                                                the_title( '<span class="screen-reader-text">"', '"</span>', false )
                                                        );
                                                ?>
                                            </a>
                                        </div><!-- .continue-reading -->
                                        
                                <?php endif; ?>
                                        
			</div><!-- .entry-content -->

			<?php
			// Show recent blog posts if is blog posts page (Note that get_option returns a string, so we're casting the result as an int).
			if ( get_the_ID() === (int) get_option( 'page_for_posts' )  ) : ?>

				<?php // Show four most recent posts.
				$recent_posts = new WP_Query( array(
					'posts_per_page'      => 3,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				) );
				?>

		 		<?php if ( $recent_posts->have_posts() ) : ?>

					<div class="recent-posts <?php echo get_theme_mod( 'page_layout' ) == 'one-column' ||
                                                                            get_theme_mod( 'frontpage_page_layout' ) == 'one-column' ? 'page-one-column' : ''; ?>">

						<?php
						while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
							get_template_part( 'template-parts/post/content', 'excerpt' );
						endwhile;
						wp_reset_postdata();
						?>
					</div><!-- .recent-posts -->
				<?php endif; ?>
			<?php endif; ?>

		</div><!-- .wrap -->
	</div><!-- .panel-content -->

</article><!-- #post-## -->
