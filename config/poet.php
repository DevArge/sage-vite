<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Post Types by Poet
    |--------------------------------------------------------------------------
    |
    | Here you can define the custom post types that you would like to be
    | registered by Poet. You can also define the default configuration
    | for each post type. You can create as many post types and taxonomies
    | as you like.
    | 
    | For more information on the configuration options available, see:
    | https://developer.wordpress.org/reference/functions/register_post_type/
    |
    |
    */

    'post' => [
        'pokemons' => [
            'enter_title_here' => 'Pokemon Name',
            'menu_icon' => 'dashicons-buddicons-replies',
            'supports' => ['title', 'editor', 'author', 'revisions', 'thumbnail'],
            'show_in_rest' => true,
            'has_archive' => false,
            'labels' => [
                'singular' => 'Pokemon',
                'plural' => 'Pokemons',
            ],
        ],  
   
    ],
];
