<?php
/**
 * MarsXI Theme Customizer
 * Parent Theme: Twenty Seventeen
 * 
 * @package MarsXI
 */

/**
 * Add in the MarsXI Customizer script
 */
function marsxi_customize_register( $wp_customize ) {
    
    /**
     * Modify some values in the Customizer
     */
    $wp_customize->get_section( 'title_tagline' )->title            = __( 'Site Title / Logo', 'marsxi' );
    $wp_customize->get_section( 'static_front_page' )->title        = __( 'Static Front Page Options', 'marsxi' );
    $wp_customize->get_control( 'header_textcolor' )->description   = __( 'This also controls the color of your Call to Action headline.', 'marsxi' );
    $wp_customize->get_control( 'page_on_front' )->label            = __( 'Front Page (First Panel)', 'marsxi' );
    $wp_customize->get_setting( 'header_textcolor' )->transport     = 'refresh';
    
    /**
     * Reorganize some things in the Customizer
     */   
    $wp_customize->get_section( 'title_tagline' )->priority     = 10;
    $wp_customize->get_section( 'header_image' )->priority      = 11;
    $wp_customize->get_section( 'static_front_page' )->priority = 12; 
    $wp_customize->get_section( 'theme_options' )->priority     = 13;
    $wp_customize->get_control( 'page_layout' )->priority       = 7;
    $wp_customize->get_control( 'blogname' )->priority          = 11;
    $wp_customize->get_control( 'blogdescription' )->priority   = 12;
    $wp_customize->get_control( 'show_on_front' )->priority     = 8;
    $wp_customize->get_control( 'page_for_posts' )->priority    = 9;
    $wp_customize->get_control( 'page_on_front' )->priority     = 10;
    
    
    /**
     * Add New stuff to the Customizer
     */
        /*
         * Highlight Color
         */
        // Highlight Color Setting
        $wp_customize->add_setting( 'highlight_color', array(
            'default'           => '#f68b1f', // marsx orange
            'type'              => 'theme_mod',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        ) );
        
        // Highlight Color Control
        $wp_customize->add_control(
                new WP_Customize_Color_Control(
                        $wp_customize,
                        'highlight_color', array(
                            'label'         => esc_html__( 'Highlight Color', 'marsxi' ),
                            'description'   => esc_html__( 'Change the color of site highlights, inluding links.', 'marsxi' ),
                            'section'       => 'colors',
                        )
        ) );
        
        
        /**
         * Logo Position Options
         */
        $wp_customize->add_setting( 'logo_position_options',
                array(
                    'default'           => 'header',
                    'sanitize_callback' => 'marsxi_sanitize_logo_position_options',
                ) );
        
        $wp_customize->add_control( 'logo_position_options',
                array(
                    'label'             => __( 'Logo Position Options', 'marsxi' ),
                    'section'           => 'title_tagline',
                    'type'              => 'radio',
                    'description'       => __( 'Where should the logo appear? (Top Menu option only works if there is a Top Menu.)', 'marsxi' ),
                    'choices'           => array(
                            'header'        => __( 'Header', 'marsxi' ),
                            'top-menu'      => __( 'Top Menu', 'marsxi' ),
                    ),
                    'priority'          => 10
                ) );
        
        /**
         * Create Front Page Options Section
         */
//        $wp_customize->add_section( 'frontpage_options',
//                array(
//                    'title'             => __( 'Front Page Options', 'marsxi' ),
//                    'priority'          => 14
//                ) );
        
        /**
         * Front Page Options
         */
        $wp_customize->add_setting( 'frontpage_full_main_image',
                array(
                    'default'           => false,
                    'sanitize_callback' => 'marsxi_sanitize_checkbox',
                ) );
        
        $wp_customize->add_control( 'frontpage_full_main_image',
                array(
                    'section'           => 'static_front_page',
                    'type'              => 'checkbox',
                    'label'             => __( 'Show Front First Panel Featured Image?', 'marsxi' ),
                    'active_callback'   => 'marsxi_is_static_front_page',
                    'priority'          => 10,
                ) );
        
        /**
         * Front Page Content Blocks
         * @todo Come back and fix/add these in
         */
//        $num_f_pages_sections = 3;
//        
//        // Create a setting and control for each of the featured page sections available in the theme.
//        for ( $i = 1; $i < ( 1 + $num_f_pages_sections ); $i++ ) {
//                $wp_customize->add_setting( 'featured_page_' . $i,
//                        array(
//                            'default'           => false,
//                            'sanitize_callback' => 'absint',
//                        ) );
//                
//                $wp_customize->add_control( 'featured_page_' . $i, 
//                        array(
//                            /* Translators: %d is the Featured Page number. */
//                            'label'             => sprintf( __( 'Featured Page %d.', 'marsxi' ), $i ),
//                            'type'              => 'dropdown-pages',
//                            'section'           => 'static_front_page',
//                ) );
//        }
        
        /**
         * Slide Panel images? One or two columns?
         */
        $wp_customize->add_setting( 'frontpage_slide_panel_images',
                array(
                    'default'           => false,
                    'sanitize_callback' => 'marsxi_sanitize_checkbox',
                ) );
        
        $wp_customize->add_control( 'frontpage_slide_panel_images',
                array(
                    'section'           => 'static_front_page',
                    'type'              => 'checkbox',
                    'label'             => __( 'Make Front Panel Images slide in?', 'marsxi' ),
                    'active_callback'   => 'marsxi_is_static_front_page',
                    'priority'          => 10,
                ) );
        
        $wp_customize->add_setting( 'frontpage_slide_images_one_column',
                array(
                    'default'           => false,
                    'sanitize_callback' => 'marsxi_sanitize_checkbox',
                ) );
        
        $wp_customize->add_control( 'frontpage_slide_images_one_column',
                array(
                    'section'           => 'static_front_page',
                    'type'              => 'checkbox',
                    'label'             => __( 'Slide Images in One Column?', 'marsxi' ),
                    'active_callback'   => 'marsxi_is_static_front_page',
                    'priority'          => 10,
                ) );
                
        /**
         * Move Twenty Seventeen Front Panel Sections to Front Page Options
         */
        $num_sections = apply_filters( 'twentyseventeen_front_page_sections', 4 );
        
        for( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
            $wp_customize->get_control( 'panel_' . $i )->section    = 'static_front_page';
            $wp_customize->get_control( 'panel_' . $i )->priority   = 11;
        }
        
        /**
         * Show first/last panel title
         */
        $wp_customize->add_setting( 'frontpage_show_title',
                array(
                    'default'           => false,
                    'sanitize_callback' => 'marsxi_sanitize_checkbox',
                ) );
        
        $wp_customize->add_control( 'frontpage_show_title',
                array(
                    'section'           => 'static_front_page',
                    'type'              => 'checkbox',
                    'label'             => __( 'Show Front First & Last Panel title?', 'marsxi' ),
                    'active_callback'   => 'marsxi_is_static_front_page',
                    'priority'          => 10,
                ) );
        
        
        /**
         * Front Page LAST Section (will obey the Front Page Page Layout setting)
         */
        $wp_customize->add_setting( 'panel_last', 
                array(
                    'default'           => false,
                    'sanitize_callback' => 'absint',
                ) );
        
        $wp_customize->add_control( 'panel_last',
                array(
                    'label'             => __( 'Front Page LAST Panel Content', 'marsxi' ),
                    'description'       => __( 'The LAST Front Page Section will obey the Front Page Page Layout rules so the top "section" (Front Page) and this last section match layouts.', 'marsxi' ),
                    'section'           => 'static_front_page',
                    'type'              => 'dropdown-pages',
                    'allow_addition'    => true,
                    'active_callback'   => 'marsxi_is_static_front_page',
                    'priority'          => 12,
                ) );
        
        $wp_customize->selective_refresh->add_partial( 'panel_last', 
                array(
                    'selector'              => '#panellast',
                    'render_callback'       => 'twentyseventeen_front_page_section',
                    'container_inclusive'   => true,
                ) );
        
        /**
         * Call To Action
         */
        $wp_customize->add_setting( 'cta_page_display',
                array(
                    'default'           => false,
                    'sanitize_callback' => 'absint',
                ) );
        
        $wp_customize->add_control( 'cta_page_display',
                array(
                    'label'             => __( 'Call to Action', 'marsxi' ),
                    'description'       => __( 'Select a Page to display in the Call to Action section. (This will only display the Featured Image as a background and a button link to the page.)', 'marsxi' ),
                    'section'           => 'theme_options',
                    'type'              => 'dropdown-pages',
                ) );
        
        $wp_customize->add_setting( 'cta_headline',
                array(
                    'default'           => __( 'Call to Action', 'marsxi' ),
                    'sanitize_callback' => 'marsxi_sanitize_text',
                ) );
        
        $wp_customize->add_control( 'cta_headline', 
                array(
                    'type'              => 'text',
                    'section'           => 'theme_options',
                    'description'       => __( 'Put a nice attention-grabbing headline here.', 'marsxi' ),
                ) );
        
        $wp_customize->add_setting( 'cta_button',
                array(
                    'default'           => __( 'Button', 'marsxi' ),
                    'sanitize_callback' => 'marsxi_sanitize_text',
                ) );
        
        $wp_customize->add_control( 'cta_button', 
                array(
                    'type'              => 'text',
                    'section'           => 'theme_options',
                    'description'       => __( 'Call to Action Button text.', 'marsxi' ),
                ) );
        
        $wp_customize->add_setting( 'cta_button_dest',
                array(
                    'default'           => false,
                    'sanitize_callback' => 'absint',
                ) );
        
        $wp_customize->add_control( 'cta_button_dest',
                array(
                    'type'              => 'dropdown-pages',
                    'section'           => 'theme_options',
                    'description'       => __( 'Select the Page for the Call to Action Button to link to.', 'marsxi' ),
                ) );
        
        /**
         * Call To Action Options
         */
        $wp_customize->add_setting( 'cta_options',
                array(
                    'default'           => 'all-pages',
                    'sanitize_callback' => 'marsxi_sanitize_site_headline_options',
                ) );
        
        $wp_customize->add_control( 'cta_options',
                array(
                    'label'             => __( 'Call To Action Display Options', 'marsxi' ),
                    'section'           => 'theme_options',
                    'type'              => 'radio',
                    'description'       => __( 'Choose whether or not to have the Call To Action visible on all pages or just the front page.', 'marsxi' ),
                    'choices'           => array(
                            'all-pages'     => __( 'All Pages', 'marsxi' ),
                            'front-page'    => __( 'Only Front Page', 'marsxi' )
                    ),
                ) );

    
        /**
         * Add a Site Headline Area (Theme Options)
         */
        $wp_customize->add_setting( 'site_headline',
                array(
                    'default'           => __( 'Site Headline title', 'marsxi' ),
                    'sanitize_callback' => 'marsxi_sanitize_text',
                ) );
        
        $wp_customize->add_control( 'site_headline', 
                array(
                    'type'              => 'text',
                    'section'           => 'theme_options',
                    'label'             => __( 'Site Headline', 'marsx' ),
                    'description'       => __( 'Put a nice attention-grabbing headline here.', 'marsx' ),
                    'priority'          => 9
                ) );
        
        $wp_customize->add_setting( 'site_headline_description',
                array(
                    'default'           => __( 'Site Headline description', 'marsxi' ),
                    'sanitize_callback' => 'marsxi_sanitize_text',
                ) );
        
        $wp_customize->add_control( 'site_headline_description',
                array(
                    'type'              => 'text',
                    'section'           => 'theme_options',
                    'description'       => __( 'If there is no description text, the headline will appear bigger and centered on the page.', 'marsxi' ),
                    'priority'          => 9
                ) );
        
        
        /**
         * Site Headline Options
         */
        $wp_customize->add_setting( 'site_headline_options',
                array(
                    'default'           => 'all-pages',
                    'sanitize_callback' => 'marsxi_sanitize_site_headline_options',
                ) );
        
        $wp_customize->add_control( 'site_headline_options',
                array(
                    'label'             => __( 'Site Headline Display Options', 'marsxi' ),
                    'section'           => 'theme_options',
                    'type'              => 'radio',
                    'description'       => __( 'Choose whether or not to have the site headline visible on all pages or just the front page.', 'marsxi' ),
                    'choices'           => array(
                            'all-pages'     => __( 'All Pages', 'marsxi' ),
                            'front-page'    => __( 'Only Front Page', 'marsxi' )
                    ),
                    'priority'          => 9
                ) );
        
        /**
         * Custom Footer Copyright Text
         */
        $wp_customize->add_setting( 'footer_text',
                array(
                    'default'           => '',
                    'sanitize_callback' => 'marsxi_sanitize_text',
                ) );
        
        $wp_customize->add_control( 'footer_text',
                array(
                    'type'              => 'text',
                    'section'           => 'theme_options',
                    'label'             => __( 'Custom Footer text', 'marsxi' ),
                    'description'       => __( 'This text appears after the blog name in the copyright text in the footer.', 'marsxi' ),     
                ) );
        
        /**
         * Footer Credits
         */
        $wp_customize->add_setting( 'show_footer_credits',
                array(
                    'default'           => true,
                    'sanitize_callback' => 'marsxi_sanitize_checkbox',
                ) );
        
        $wp_customize->add_control( 'show_footer_credits',
                array(
                    'type'              => 'checkbox',
                    'section'           => 'theme_options',
                    'label'             => __( 'Show Footer Credits?', 'marsxi' ),
                    ''
                ) );
        
        
        /**
         * Top Menu Position
         */
        $wp_customize->add_setting( 'top_menu_position',
                array( 
                    'default'           => 'below',
                    'sanitize_callback' => 'marsxi_sanitize_top_menu_position',
                ) );
        
        $wp_customize->add_control( 'top_menu_position',
                array(
                    'label'             => __( 'Top Menu Position', 'marsxi' ),
                    'section'           => 'header_image',
                    'type'              => 'radio',
                    'description'       => __( 'Place the top menu either above or below the header media on every page.', 'marsxi' ),
                    'choices'           => array(
                            'top'   => __( 'Top', 'marsxi' ),
                            'below' => __( 'Below', 'marsxi' ),
                    ),
                    'priority'          => 1,
                    'active_callback'   => 'marsxi_has_top_menu'
                ) );
        
        
                /**
         * Front Page Page Layout
         * 
         * @deprecated 1.0.1 Possibly to revisit later
         */
//        $wp_customize->add_setting( 'frontpage_page_layout',
//                array(
//                    'default'           => 'page-layout',
//                    'sanitize_callback' => 'marsxi_sanitize_front_page_layout',
//                    'transport'         => 'postMessage',
//                ) );
//        
//        $wp_customize->add_control( 'frontpage_page_layout',
//                array(
//                    'label'             => __( 'Front Page Page Layout', 'marsxi' ),
//                    'section'           => 'frontpage_options',
//                    'type'              => 'radio',
//                    'description'       => __( 'Keep the site\'s page layout (as above) or assign a different one separately just for the front page. (Scroll up to view.)', 'marsxi' ),
//                    'choices'           => array(
//                            // 'page-layout'   => __( 'Page Layout (same as above)', 'marsxi' ),
//                            'one-column'    => __( 'One Column', 'marsxi' ),
//                            'two-column'    => __( 'Two Column', 'marsxi' ),
//                    ),
//                    'active_callback'   => 'marsxi_is_static_front_page',
//                    'priority'          => 8
//                ) );
        
        /**
         * Login Section options
         */
        $wp_customize->add_section( 'login_options',
                array(
                    'title'             => __( 'Login Options', 'marsxi' ),
                ) );
        
        $wp_customize->add_setting( 'show_login_button',
                array(
                    'default'           => true,
                    'sanitize_callback' => 'marsxi_sanitize_checkbox',
                ) );
        
        $wp_customize->add_control( 'show_login_button',
                array(
                    'type'              => 'checkbox',
                    'section'           => 'login_options',
                    'label'             => __( 'Show Login button in Top Menu?', 'marsxi' ),
                ) );

}
add_action( 'customize_register', 'marsxi_customize_register', 12 );


/**
 * Sanitize Text
 */
function marsxi_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Checkboxes
 */
function marsxi_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Sanitize logo position options
 */
function marsxi_sanitize_logo_position_options( $input ) {
    $valid = array(
            'header'        => __( 'Header', 'marsxi' ),
            'top-menu'      => __( 'Top Menu', 'marsxi' ),
    );
    
    if( array_key_exists( $input, $valid ) ) {
            return $input;
    }
    
    return '';
}

/**
 * Sanitize the top menu options
 */
function marsxi_sanitize_top_menu_position( $input ) {
    $valid = array( 
            'top'   => __( 'Top', 'marsxi' ),
            'below' => __( 'Below', 'marsxi' ),
    );
    
    if( array_key_exists( $input, $valid ) ) {
            return $input;
    }
    
    return '';
}

/**
 * Sanitize page layout options
 */
function marsxi_sanitize_page_layout( $input ) {
    $valid = array(
            'one-column'    => __( 'One Column', 'marsxi' ),
            'two-column'    => __( 'Two Column', 'marsxi' ),
            'slide-in'      => __( 'Front Page Panel images slide in', 'marsxi' )
    );
    
    if( array_key_exists( $input, $valid ) ) {
            return $input;
    }
    
    return '';
}

/**
 * Sanitize front page layout options
 */
function marsxi_sanitize_front_page_layout( $input ) {
    $valid = array(
            // 'page-layout'   => __( 'Page Layout (same as above)', 'marsxi' ),
            'one-column'    => __( 'One Column', 'marsxi' ),
            'two-column'    => __( 'Two Column', 'marsxi' ),
    );
    
    if( array_key_exists( $input, $valid ) ) {
            return $input;
    }
    
    return '';
}

/**
 * Sanitize Site Headline options
 */
function marsxi_sanitize_site_headline_options( $input ) {
    $valid = array(
            'all-pages'     => __( 'All Pages', 'marsxi' ),
            'front-page'    => __( 'Only Front Page', 'marsxi' )
    );
    
    if( array_key_exists( $input, $valid ) ) {
            return $input;
    }
    
    return '';
}

/**
 * Return whether there's an active Top Menu or not
 */
function marsxi_has_top_menu() {
    return has_nav_menu( 'top' );
}

/**
 * Return whether this is the Static Front Page or not
 */
function marsxi_is_static_front_page() {
    return ( is_front_page() && ! is_home() );
}

/**
 * Increase the saturation for Custom colors
 */
function marsxi_custom_colors_saturation() {
    return 75;
}
add_filter( 'twentyseventeen_custom_colors_saturation', 'marsxi_custom_colors_saturation' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function marsxi_customize_preview_js() {
        
        /* Remove Twenty Seventeen Customizer functions */
        wp_dequeue_script( 'twentyseventeen-customize-preview' );
        /* Load MarsXI Customizer functions instead */
	wp_enqueue_script( 'marsxi_customizer', get_stylesheet_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20170108', true );
        
}
add_action( 'customize_preview_init', 'marsxi_customize_preview_js' );

function marsxi_customizer_control() {
    
    /* MarsXI Customizer controller script */
    wp_enqueue_script( 'marsxi_customizer_control', get_stylesheet_directory_uri() . '/assets/js/customize-controls.js', array( 'jquery' ), '20170108', true );
    
}
//add_action( 'customize_controls_print_footer_scripts', 'marsxi_customizer_control' );
