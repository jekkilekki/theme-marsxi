<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage MarsXI
 * @since 1.0
 * @version 1.0
 */


if( get_theme_mod( 'frontpage_page_layout' ) == 'one-column' ) {
    $frontpage_layout = 'page-one-column';
} else if ( get_theme_mod( 'frontpage_page_layout' ) === 'two-column' ) {
    $frontpage_layout = 'page-two-column';
} else {
    $frontpage_layout = '';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'twentyseventeen-panel last-panel ' . $frontpage_layout . ' ' ); ?> >

	<?php if ( has_post_thumbnail() && get_theme_mod( 'frontpage_full_main_image', true ) ) :
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

		$post_thumbnail_id = get_post_thumbnail_id( $post->ID );

		$thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

		// Calculate aspect ratio: h / w * 100%.
		$ratio = $thumbnail_attributes[2] / $thumbnail_attributes[1] * 100;
		?>

		<div class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
			<div class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></div>
		</div><!-- .panel-image -->

	<?php endif; ?>

	<div class="panel-content">
		<div class="wrap">
                    
			<?php if ( get_theme_mod( 'frontpage_show_title', false ) ) : ?>
                    
                                <header class="entry-header">
                                        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

                                        <?php twentyseventeen_edit_link( get_the_ID() ); ?>

                                </header><!-- .entry-header -->
                                
                        <?php endif; ?>

			<div class="entry-content">
				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
						get_the_title()
					) );
				?>
			</div><!-- .entry-content -->
                        
                        <?php if ( ! get_theme_mod( 'frontpage_show_title', false ) ) : ?> 
                        
                                <footer>
                                        <?php twentyseventeen_edit_link( get_the_ID() ); ?>
                                </footer>
                        
                        <?php endif; ?>

		</div><!-- .wrap -->
	</div><!-- .panel-content -->

</article><!-- #post-## -->
