<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * Load script assets as module during development.
 *
 * @param string $tag
 * @param string $handle
 * @param string $src
 *
 * @return string
 */
add_filter('script_loader_tag', function ($tag, $handle, $src) {
    $namespace = strtolower(wp_get_theme()->get('Name'));

    if ($namespace !== $handle) {
        return $tag;
    }

    $tag = str_replace(' src', ' type="module" src', $tag);

    return $tag;
}, 10, 3);
