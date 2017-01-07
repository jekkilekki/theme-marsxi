<?php
/** 
 * Custom Customizer Control Class
 * 
 * A Customizer Control class that allows us to output arbitrary HTML into the Theme Customizer.
 * 
 * @link http://coreymckrill.com/blog/2014/01/09/adding-arbitrary-html-to-a-wordpress-theme-customizer-section/
 * @link https://github.com/devinsays/customizer-library/issues/20
 * @since 1.0.0
 */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'MarsXI_Misc_Control' ) ) :
    class MarsXI_Misc_Control extends WP_Customize_Control {
        public $settings = 'blogname';
        public $description = '';
        
        public function render_content() {
            switch ( $this->type ) {
                default:
                case 'text':
                    echo '<p class="description">' . $this->description . '</p>';
                    break;
                case 'heading':
                    echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
                    break;
                case 'line':
                    echo '<hr>';
                    break;
            }
        }
    }
endif;
