<?php
/**
 * Trims the excerpt allowing links.
 *
 * I got this nice funcion from here
 *   https://lewayotte.com/2010/09/22/allowing-hyperlinks-in-your-wordpress-excerpts/
 * If you want to understand this code, you should definitely visit this link
 *
 * @param string $text Text to trim keeping links
 */
function new_wp_trim_excerpt($text)
{
    $raw_excerpt = $text;
    if ('' == $text) {
        $text = get_the_content('');

        $text = strip_shortcodes($text);

        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
        /*
         * Hi, future...
         *
         * Maybe I should not allow iframes... but I want the videos
         * to show in the excerpt too, maybe I will remove <iframe> from
         * here and add post custom field to add video right after the post content
         */
        $text = strip_tags($text, '<a><iframe><p><br><strong><ul><li>');
        $excerpt_length = apply_filters('excerpt_length', 55);
        $excerpt_length = 155;

        $excerpt_more = apply_filters('excerpt_more', ' '.'[...]');
        $words = preg_split('/(<a.*?a>)|\n|\r|\t|\s/', $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        if (count($words) > $excerpt_length) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text.$excerpt_more;
        } else {
            $text = implode(' ', $words);
        }
    }

    return apply_filters('new_wp_trim_excerpt', $text, $raw_excerpt);
}

// remove_filter('get_the_excerpt', 'wp_trim_excerpt');
// add_filter('get_the_excerpt', 'new_wp_trim_excerpt');
