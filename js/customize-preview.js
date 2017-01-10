/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {

	// Collect information from customize-controls.js about which panels are opening.
	wp.customize.bind( 'preview-ready', function() {

		// Initially hide the theme option placeholders on load
		$( '.panel-placeholder' ).hide();

		wp.customize.preview.bind( 'section-highlight', function( data ) {

			// Only on the front page.
			if ( ! $( 'body' ).hasClass( 'twentyseventeen-front-page' ) ) {
				return;
			}

			// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
			if ( true === data.expanded ) {
				$( 'body' ).addClass( 'highlight-front-sections' );
				$( '.panel-placeholder' ).slideDown( 200, function() {
					$.scrollTo( $( '#panel1' ), {
						duration: 600,
						offset: { 'top': -70 } // Account for sticky menu.
					});
				});

			// If we've left the panel, hide the placeholders and scroll back to the top.
			} else {
				$( 'body' ).removeClass( 'highlight-front-sections' );
				// Don't change scroll when leaving - it's likely to have unintended consequences.
				$( '.panel-placeholder' ).slideUp( 200 );
			}
		});
	});

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
                                // But always show the Call To Action headline
                                $( '.call-to-action' ).css({
                                        clip: 'auto',
					position: 'relative'
                                });
				// Add class for different logo styles if title and description are hidden.
				$( 'body' ).addClass( 'title-tagline-hidden' );
			} else {

				// Check if the text color has been removed and use default colors in theme stylesheet.
				if ( ! to.length ) {
					$( '#twentyseventeen-custom-header-styles' ).remove();
				}
				$( '.site-title, .site-description' ).css({
					clip: 'auto',
					position: 'relative'
				});
				$( '.site-branding, .site-branding a, .site-description, .site-description a, .call-to-action' ).css({
					color: to
				});
				// Add class for different logo styles if title and description are visible.
				$( 'body' ).removeClass( 'title-tagline-hidden' );
			}
		});
	});

	// Color scheme.
	wp.customize( 'colorscheme', function( value ) {
		value.bind( function( to ) {

			// Update color body class.
			$( 'body' )
				.removeClass( 'colors-light colors-dark colors-custom' )
				.addClass( 'colors-' + to );
		});
	});

	// Custom color hue.
	wp.customize( 'colorscheme_hue', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS.
			var style = $( '#custom-theme-colors' ),
				hue = style.data( 'hue' ),
				css = style.html();

			// Equivalent to css.replaceAll, with hue followed by comma to prevent values with units from being changed.
			css = css.split( hue + ',' ).join( to + ',' );
			style.html( css ).data( 'hue', to );
		});
	});
        
        // Highlight color
        wp.customize( 'highlight_color', function( value ) {
                value.bind( function( to ) {
                   
                        // Update all highlight colors
                        $( '.highlight-text' ).css({
                                color: to
                        });
                        $( '.highlight-line' ).css({
                                borderColor: to
                        });
                        $( '.highlight-bg' ).css({
                                backgroundColor: to
                        });
                    
                });
        });

	// Page layouts.
	wp.customize( 'page_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'one-column' === to ) {
				$( 'body, .panel-content' ).addClass( 'page-one-column' ).removeClass( 'page-two-column' );
			} else {
				$( 'body' ).removeClass( 'page-one-column' ).addClass( 'page-two-column' );
                                $( '.panel-content' ).removeClass( 'page-one-column' );
                                $( '.first-panel, .last-panel' ).addClass( 'page-one-column' );
			}
		} );
	} );
        
        // Front Page only Page layouts.
	wp.customize( 'frontpage_page_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'one-column' === to ) {
                                $( '.first-panel, .last-panel' ).addClass( 'page-one-column' ).removeClass( 'page-two-column' );
			} else {
				$( 'body.twentyseventeen-front-page' ).removeClass( 'page-one-column' ).addClass( 'page-two-column' );
                                $( '.twentyseventeen-front-page .panel-content' ).removeClass( 'page-one-column' );
                                $( '.twentyseventeen-front-page .first-panel, .twentyseventeen-front-page .last-panel' ).addClass( 'page-one-column' );
			}
		} );
	} );

	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}

	// Whether a header video is available.
	function hasHeaderVideo() {
		var externalVideo = wp.customize( 'external_header_video' )(),
			video = wp.customize( 'header_video' )();

		return '' !== externalVideo || ( 0 !== video && '' !== video );
	}

	// Toggle a body class if a custom header exists.
	$.each( [ 'external_header_video', 'header_image', 'header_video' ], function( index, settingId ) {
		wp.customize( settingId, function( setting ) {
			setting.bind(function() {
				if ( hasHeaderImage() ) {
					$( document.body ).addClass( 'has-header-image' );
				} else {
					$( document.body ).removeClass( 'has-header-image' );
				}

				if ( ! hasHeaderVideo() ) {
					$( document.body ).removeClass( 'has-header-video' );
				}
			} );
		} );
	} );

} )( jQuery );
