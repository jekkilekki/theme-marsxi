<?php
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
	'marsxi' => array(
		'url'           => '%2$s/images/marsxi-header.jpg',
		'thumbnail_url' => '%2$s/images/marsxi-thumbnail.jpg',
		'description'   => __( 'Underground', 'marsxi' )
                )
	)
);

/**
 * Register additional widget areas here
 * 
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function marsxi_widgets_init() {
        // Unregister Twenty Seventeen Widgets so we can load these in the right order
        unregister_sidebar( 'sidebar-1' );
        unregister_sidebar( 'sidebar-2' );
        unregister_sidebar( 'sidebar-3' );
    
        // Re-register Twenty Seventeen Widgets (so they are placed in the right order in Customizer, etc)
        register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentyseventeen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'twentyseventeen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'twentyseventeen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
        // Register NEW MarsXI Widgets
        register_sidebar( array(
		'name'          => __( 'Footer 3', 'marsxi' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'marsxi' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'marsxi' ),
		'id'            => 'sidebar-5',
		'description'   => __( 'Add widgets here to appear in your footer.', 'marsxi' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'marsxi_widgets_init' );


/**
 * This will output the custom WordPress settings to the live theme's WP head.
 * 
 * Used by hook: 'wp_head'
 * 
 * @see add_action('wp_head',$func)
 * @since MarsXI 1.0
 */
function marsxi_customizer_css() {
  ?>
  <!--Customizer CSS--> 
  <style type="text/css">
       .highlight-text { color: <?php echo get_theme_mod( 'highlight_color', '#f68b1f' ); ?>; }
       .highlight-line { border-color: <?php echo get_theme_mod( 'highlight_color', '#f68b1f' ); ?>; }
       .highlight-bg { background-color: <?php echo get_theme_mod( 'highlight_color', '#f68b1f' ); ?>; }
  </style> 
  <!--/Customizer CSS-->
  <?php
}
add_action( 'wp_head', 'marsxi_customizer_css' );

/**
 * Enqueue MarsXI Scripts
 */
function marsxi_scripts() {
    
    // Enqueue Parent Theme (Twenty Seventeen) Styles
    wp_enqueue_style( 'marsxi-parent-style', get_template_directory_uri() . '/style.css' );
    
    // Add Front Page Image Slider script IF it is the front page and slide-in images is selected in the Customizer
    if ( is_front_page() && is_page() && get_theme_mod( 'frontpage_slide_panel_images', false ) ) {
        wp_enqueue_script( 'marsxi-slide-in-images', get_stylesheet_directory_uri() . '/js/slide-in-images.js', array( 'jquery' ), '01082017', true );
    }
    
}
add_action( 'wp_enqueue_scripts', 'marsxi_scripts' );

/*
 * Load MarsXI Customizer
 */
require get_stylesheet_directory() . '/inc/marsxi_customizer.php';

/*
 * Load MarsXI Template Tags
 */
require get_stylesheet_directory() . '/inc/marsxi_template_tags.php';
