<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    if (hmr_enabled()) {
        $namespace = strtolower(wp_get_theme()->get('Name'));

        wp_enqueue_script($namespace, hmr_asset('app'), [], null, true);

        return;
    }

    bundle('app')->enqueue();
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    if (hmr_enabled()) {
        $namespace = strtolower(wp_get_theme()->get('Name'));

        wp_enqueue_script($namespace, hmr_asset('app'), [], null, true);

        return;
    }

    bundle('editor')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from the Soil plugin if activated.
     *
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls',
    ]);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});

/**
 * Create a .env file in theme
 *
 * @return void
 */
add_action('after_switch_theme', function () {
    // Path to the .env file in the theme directory
    $env_file = get_template_directory() . '/.env';

    try {
        // Check if the .env file does not exist
        if (!file_exists($env_file)) {
            // Get the site URL
            $site_url = get_site_url();

            // Content of the .env file
            $env_content = <<<EOD
            APP_URL={$site_url}
            HMR_HOST=localhost
            WP_ENV=production
            HMR_PORT=5143
            HMR_ENTRYPOINT=http://localhost:5143
            EOD;

            // Create the .env file and write the content
            file_put_contents($env_file, $env_content);
        }
    } catch (\Throwable $th) {
        //
    }
});

/**
 * Manifest catch exception.
 *
 * @return void
 */
add_action('init', function(){
    if(!is_file(public_path('manifest.json'),)){
        throw new \Exception("Manifest not found: You must have to run 'yarn build' command inside of the theme folder.");
    }
});

/**
 * remove jquery migrate
 *
 * @return void
 */
add_action( 'wp_default_scripts', function ( $scripts ) {
    if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
        $scripts->registered['jquery']->deps = array_diff(
            $scripts->registered['jquery']->deps,
            [ 'jquery-migrate' ]
        );
    }
} );


/**
 * Register Ajaxs Methods.
 *
 * @return void
 */
add_action( 'wp_ajax_example_ajax_func', 'Branch\Ajax\example_ajax_func' );
add_action( 'wp_ajax_nopriv_example_ajax_func', 'Branch\Ajax\example_ajax_func' );

