<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
		</div><!-- #content -->
                
                <?php
                /**
                 * Call to Action Section
                 * 
                 * Description
                 * 
                 * @since MarsXI 1.0
                 */
                if( get_theme_mod( 'cta_page_display' ) != false && get_theme_mod( 'cta_options' ) == 'all-pages' ) {
                        global $post;
                        $post = get_post( get_theme_mod( 'cta_page_display' ) );
                        setup_postdata( $post );
                        //set_query_var( 'panel', ++$id );

                        get_template_part( 'template-parts/page/content', 'front-page-action' );

                        wp_reset_postdata();       
                }
                ?>
                
                <div class="site-footer footer-widgets">
                        <div class="wrap">
                                <?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>
                        </div>
                </div>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">
                                <?php
				if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation" role="navigation" aria-label="<?php _e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
							) );
						?>
					</nav><!-- .social-navigation -->
				<?php endif;

				get_template_part( 'template-parts/footer/site', 'info' );
				?>
			</div><!-- .wrap -->
		</footer><!-- #colophon -->
                
                <?php if ( get_theme_mod( 'show_footer_credits', true ) != false ) { ?>
                
                        <div class="theme-info">
                                <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'marsxi' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'marsxi' ), 'WordPress' ); ?></a>
                                <br>Twenty Seventeen Child Theme <a href="<?php echo esc_url( __( 'http://aaronsnowberger.com/', 'marsxi' ) ); ?>"><?php printf( __( '%s by %s', 'marsxi' ), 'MarsXI', 'Aaron Snowberger' ); ?></a>
                        </div>
                
                <?php } ?>
                
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
