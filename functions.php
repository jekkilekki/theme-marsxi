<?php
/**
 * Enqueue Parent Theme (Twenty Seventeen) Styles
 */
function marsxi_enqueue_parent_styles() {
    wp_enqueue_style( 'marsxi-parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'marsxi_enqueue_parent_styles' );

/**
 * Do Theme Setup
 */
function marsxi_setup_theme() {
    // Prepare theme for translation
    load_child_theme_textdomain( 'marsxi', get_stylesheet_directory() . '/languages' );
    
    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );    
}
add_action( 'after_setup_theme', 'marsxi_setup_theme' );

/**
 * Register default header image
 */
register_default_headers( array(
	'marsi' => array(
		'url'           => '%2$s/images/marsx-header.jpg',
		'thumbnail_url' => '%2$s/images/marsx-thumbnail.jpg',
		'description'   => __( 'Mars', 'marsx' )
                )
	)
);

/**
 * Enqueue MarsXI Scripts
 */
function marsxi_scripts() {
    /*
     * Add Font Awesome (4.7)
     */
    wp_enqueue_style( 'marsxi-font-awesome', get_stylesheet_directory_uri() . '/fonts/font-awesome.min.css' );
    /*
     * Add Front Page Image Slider script IF it is the front page and slide-in images is selected in the Customizer
     */
    if ( is_front_page() && is_page() && get_theme_mod( 'frontpage_slide_panel_images', false ) ) {
        wp_enqueue_script( 'marsxi-slide-in-images', get_stylesheet_directory_uri() . '/js/slide-in-images.js', array( 'jquery' ), '01082017', true );
    }
}
add_action( 'wp_enqueue_scripts', 'marsxi_scripts' );

/*
 * Load MarsXI_Misc_Control class
 */
require get_stylesheet_directory() . '/inc/MarsXI_Misc_Control.class.php';

/*
 * Load MarsXI Customizer
 */
require get_stylesheet_directory() . '/inc/marsxi_customizer.php';

/*
 * Load MarsXI Template Tags
 */
require get_stylesheet_directory() . '/inc/marsxi_template_tags.php';

/**
 * Allow some tags on excerpts.
 */
require_once get_stylesheet_directory().'/inc/marsxi_excerpts.php';
