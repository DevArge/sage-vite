<?php

namespace App;

/**
 * Get hot module replacement status.
 *
 * @return bool
 */
function hmr_enabled(): bool
{
    return file_exists(get_theme_file_path('/public/manifest.dev.json'));
}

/**
 * Get hmr asset uri
 *
 * @param string $asset
 * @return string
 */
function hmr_asset(string $asset): string
{
    $manifest = json_decode(file_get_contents(get_theme_file_path('/public/manifest.dev.json')), true);

    $asset = $manifest['inputs'][$asset];
    $hmr = $manifest['url'];

    return "{$hmr}{$asset}";
}


