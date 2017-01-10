<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="site-info">
	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'marsxi' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'marsxi' ), 'WordPress' ); ?></a>
        <br>Twenty Seventeen Child Theme <a href="<?php echo esc_url( __( 'http://aaronsnowberger.com/', 'marsxi' ) ); ?>"><?php printf( __( '%s by %s', 'marsxi' ), 'MarsXI', 'Aaron Snowberger' ); ?></a>
        <br><?php marsxi_dynamic_copyright(); ?> 
</div><!-- .site-info -->
