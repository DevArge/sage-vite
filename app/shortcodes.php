<?php
namespace App;

use function Roots\view;

/**
 * Add the shortcodes
 * optional can add to app/setup.php instead of creating app/shortcodes.php
 */
add_action('init', function () {

    /**
     * Example shortcode
     * @param $atts
     * @param null $content
     * @return \Illuminate\View\View|string
     */
    add_shortcode('example-shortcode', function ($atts, $content = null) {

        // Set the template we're going to use for the Shortcode
        $template = 'components/shortcodes/example';

        // Set the arguments for the template
        $args = [
            'title' => 'Hello world',
        ];

        return view( $template, $args )->render();

    });

});
