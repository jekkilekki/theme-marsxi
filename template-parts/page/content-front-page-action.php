<?php
/**
 * Template part for displaying the Call to Action on the Front Page
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

<article id="panel-action" <?php post_class( 'twentyseventeen-panel ' . $frontpage_layout . ' ' ); ?> >

	<?php if ( has_post_thumbnail() /* && ! get_theme_mod( 'frontpage_slide_panel_images', false ) */ ) :
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

		// Calculate aspect ratio: h / w * 100%.
		$ratio = $thumbnail[2] / $thumbnail[1] * 100;
		?>

		<div class="panel-image panel-image-small" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
			<div class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></div>
		</div><!-- .panel-image -->

	<?php endif; ?>

	<div class="panel-content call-to-action-panel">
            
            <header class="entry-header">
                                
                                <?php 
                                if ( get_theme_mod( 'cta_headline', '' ) != '' ) : 
                                        
                                        echo '<h1 class="call-to-action site-title">' . get_theme_mod( 'cta_headline' ) . '</h1>';
                                    
                                endif;

                                
//                                if ( has_post_thumbnail() && get_theme_mod( 'frontpage_slide_panel_images', false ) ) :
//                                    
//                                        echo '<figure class="slide-in-image">';
//                                        the_post_thumbnail();
//                                        echo '</figure>';
//                                    
//                                else :
                            
                                    if ( get_theme_mod( 'cta_button', '' ) != '' && get_theme_mod( 'cta_button_dest' ) ) : ?>
                                    
                                            <div class="call-to-action-buttons">

                                                <?php the_title( '<p class="button"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></p>' ); ?>
                                                <p class="button button-inverse highlight-bg highlight-line"><a href="<?php echo esc_url( get_permalink( get_theme_mod( 'cta_button_dest' ) ) ); ?>">
                                                        <?php echo get_theme_mod( 'cta_button' ); ?>
                                                </a></p>

                                            </div>
                                    
                                    <?php 
                                    else : 
                                    
                                            the_title( '<p class="entry-title button"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></p>' );
                                            twentyseventeen_edit_link( get_the_ID() ); 
                                       
                                    endif;
                                        
                                //endif;
                                
                                
                                ?>

			</header><!-- .entry-header -->
            
	</div><!-- .panel-content -->

</article><!-- #post-## -->
