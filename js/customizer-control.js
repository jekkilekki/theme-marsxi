/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */

jQuery( document ).ready( function ($) {

	/* Customizer sections */
        // var static_home = $( '#sub-accordion-section-static_front_page li:not(nth-child(1)):not(nth-child(2))' );
	var icon_blocks = $( '#customize-control-icon_block_1_icon, #customize-control-icon_block_2_icon, #customize-control-icon_block_3_icon, #customize-control-icon_block_4_icon, #customize-control-icon_block_1_content, #customize-control-icon_block_2_content, #customize-control-icon_block_3_content, #customize-control-icon_block_4_content' );
        var feat_pages = $( '#customize-control-featured_page_1, #customize-control-featured_page_2, #customize-control-featured_page_3');

        /* On page load, hide or show the rest of the Front Page Options */
//	if ( $( '#customize-control-icon_blocks_display input' ).prop( "checked" ) ) {
//		static_home.show();
//	} else {
//		static_home.hide();
//	}
//        /* On page load, hide or the rest of the Front Page Options */
//	if ( $( '#customize-control-featured_pages_display input' ).prop( "checked" ) ) {
//		static_home.show();
//	} else {
//		static_home.hide();
//	}

	/* On page load, hide or show Icon Blocks */
	if ( $( '#customize-control-icon_blocks_display input' ).prop( "checked" ) ) {
		icon_blocks.show();
	} else {
		icon_blocks.hide();
	}
        /* On page load, hide or show Featured Pages */
	if ( $( '#customize-control-featured_pages_display input' ).prop( "checked" ) ) {
		feat_pages.show();
	} else {
		feat_pages.hide();
	}

	/* on change, hide or show Icon Blocks */
	$( '#customize-control-icon_blocks_display input' ).change( function() {
		if ( $(this).prop( "checked" ) ) {
			icon_blocks.show();
		} else {
			icon_blocks.hide();
		}
	});
        /* on change, hide or show Featured Pages */
	$( '#customize-control-featured_pages_display input' ).change( function() {
		if ( $(this).prop( "checked" ) ) {
			feat_pages.show();
		} else {
			feat_pages.hide();
		}
	});
});
//(function() {
//    // WP Customizer stuff
//	wp.customize.bind( 'ready', function() {
//
//		// Only show the color hue control when there's a custom color scheme.
////		wp.customize( 'colorscheme', function( setting ) {
////			wp.customize.control( 'colorscheme_hue', function( control ) {
////				var visibility = function() {
////					if ( 'custom' === setting.get() ) {
////						control.container.slideDown( 180 );
////					} else {
////						control.container.slideUp( 180 );
////					}
////				};
////
////				visibility();
////				setting.bind( visibility );
////			});
////		});
////
////		// Detect when the front page sections section is expanded (or closed) so we can adjust the preview accordingly.
////		wp.customize.section( 'theme_options' ).expanded.bind( function( isExpanding ) {
////
////			// Value of isExpanding will = true if you're entering the section, false if you're leaving it.
////			wp.customize.previewer.send( 'section-highlight', { expanded: isExpanding });
////		});
//	});
//})( jQuery );
