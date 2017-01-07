<?php
/**
 * Custom template tags for MarsXI.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package MarsXI
 */

/**
 * DYNAMIC Copyright for the footer
 */
 function marsxi_dynamic_copyright() {

    global $wpdb;

    $copyright_dates = $wpdb->get_results( "SELECT YEAR(min(post_date_gmt)) AS firstdate, YEAR(max(post_date_gmt)) AS lastdate FROM $wpdb->posts WHERE post_status = 'publish' " );
    $output = '';
    $blog_name = get_bloginfo();

    if ( $copyright_dates ) {
        $copyright = "&copy; " . $copyright_dates[0]->firstdate;
        if ( $copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate ) {
            $copyright .= " &ndash; " . $copyright_dates[0]->lastdate;
        }
        $output = $copyright . " " . $blog_name;
    }
    echo $output;
}

/**
 * Prints HTML with meta information for the current post-date/time and categories.
 */
function marsxi_posted_on()
{
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf($time_string,
        esc_attr(get_the_date('c')),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date('c')),
        esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
        _x('%s', 'post date', 'marsxi'),
        '<a href="'.esc_url(get_permalink()).'" rel="bookmark">'.$time_string.'</a>'
    );

    $cat = get_the_category_list(' / ');

    if (!is_singular()) {
        echo '<span class="posted-on">'.$posted_on.'</span><span class="cat-link">'.$cat.'</span>';
    } elseif (!get_theme_mod('meta_singles')) {
        echo '<span class="posted-on">'.$posted_on.'</span>';
        if ('post' == get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(__(', ', 'marsxi'));
            if ($categories_list) {
                printf('<span class="cat-links">'.__('%1$s', 'marsxi').'</span>', $categories_list);
            }
        }
    }
}

/**
 * Footer credits for MarsXI.
 */
function marsxi_footer_credits()
{
    echo '<a href="'.esc_url(__('http://wordpress.org/', 'marsxi')).'" rel="nofollow">';
    printf(__('Proudly powered by %s', 'marsxi'), 'WordPress');
    echo '</a>';
    echo '<span class="sep"> | </span>';
    printf(__('Theme: %2$s by %1$s.', 'marsxi'),
       '<a href="http://www.aaronsnowberger.com" target="_blank" rel="nofollow">Aaron Snowberger</a>',
       '<a href="https://github.com/jekkilekki/theme-marsx" target="_blank" rel="nofollow">MarsXI</a>'
    );
}
add_action( 'marsxi_child_footer', 'marsxi_footer_credits' );



if ( ! function_exists( 'marsxi_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * Improve the post_nav() with post thumbnails. Help from this
 * @link: http://www.measureddesigns.com/adding-previous-next-post-wordpress-post/
 * @link: http://wpsites.net/web-design/add-featured-images-to-previous-next-post-nav-links/
 */
function marsxi_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
        $prevID   = $previous ? $previous->ID : '';
        $nextID   = $next ? $next->ID : '';

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation clear" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'marsxi' ); ?></h2>

                <div class="nav-links">
                    <?php // My custom code below FIRST, then _s code

                    // PREVIOUS POST LINK
                    if ( ! empty( $previous ) ) { ?>
                    <div class="nav-previous">
                        <a href="<?php echo get_permalink( $prevID ); ?>" rel="prev">

                            <?php if ( ( has_post_thumbnail( $prevID ) && has_post_thumbnail( $nextID ) ) /* || ( has_post_thumbnail( $prevID ) && empty( $next ) )*/ ) { 
                                    $prev_thumb = get_the_post_thumbnail_url( $prevID, 'medium' );
                                    $prev_thumb = $prev_thumb ? $prev_thumb : get_header_image();
                                    ?>
                                    <div class="post-nav-thumb" style="background-image: url( <?php echo $prev_thumb; ?> )">
                                        <!-- Placeholder for image -->
                                    </div>
                            <?php } ?>

                            <span class="meta-nav" aria-hidden="true"><?php _e( 'Previously', 'marsxi' ); ?></span>
                            <span class="screen-reader-text"><?php _e( 'Previous Post', 'marsxi' ); ?></span>
                            <span class="post-title"><?php echo $previous->post_title; ?></span>

                        </a>
                    </div>
                    <?php }

                    // NEXT POST LINK
                    if ( ! empty( $next ) ) { ?>
                    <div class="nav-next">
                        <a href="<?php echo get_permalink( $nextID ); ?>" rel="next">

                            <?php if ( ( has_post_thumbnail( $prevID ) && has_post_thumbnail( $nextID ) ) ) { 
                                    $next_thumb = get_the_post_thumbnail_url( $nextID, 'medium' );
                                    $next_thumb = $next_thumb ? $next_thumb : get_header_image();
                                    ?>
                                    <div class="post-nav-thumb"style="background-image: url( <?php echo $next_thumb; ?> )">
                                        <!-- Placeholder for image -->
                                    </div>
                            <?php } ?>

                            <span class="meta-nav" aria-hidden="true"><?php _e( 'Next time', 'marsxi' ); ?></span>
                            <span class="screen-reader-text"><?php _e( 'Next Post', 'marsxi' ); ?></span>
                            <span class="post-title"><?php echo $next->post_title; ?></span>

                        </a>
                    </div>
                    <?php } ?>

                </div><!-- .nav-links -->

	</nav><!-- .navigation -->
	<?php
}
endif;


/*
 * Customize the read-more indicator for excerpts
 */
function marsxi_excerpt_more( $more ) {
    return " …";
}
add_filter( 'excerpt_more', 'marsxi_excerpt_more' );


if ( ! function_exists( 'marsxi_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */
function marsxi_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 3,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'marsxi' ),
		'next_text' => __( 'Next &rarr;', 'marsxi' ),
                'type'      => 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'marsxi' ); ?></h1>
                <?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;