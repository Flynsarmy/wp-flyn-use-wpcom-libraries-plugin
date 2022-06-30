<?php

/**
 * Plugin Name: Flyn Use WPCom Libraries
 * Description: Replaces all wp-includes/wp-admin script/style URLs with the wordpress.com equivalent to take load off the local server.
 * Version: 0.0.1
 * Author: Flynsarmy
 * Author URI: https://www.flynsarmy.com/
 */

class FlynUseWPComLibraries
{
    protected static string $site_url = '';

    /**
     * Rewrites the registered script/style urls to point to https://wordpress.com
     *
     * @param string $src
     * @param string $handle
     * @return string
     */
    public static function rewriteSrc(string $src, string $handle): string
    {
        if (self::$site_url === '') {
            self::$site_url = site_url('/');
        }

        if (strpos($src, self::$site_url . 'wp-includes') === 0 ||
            strpos($src, self::$site_url . 'wp-admin') === 0
        ) {
            $src = str_replace(self::$site_url, 'https://wordpress.com/', $src);
        }

        return $src;
    }
}

add_filter('script_loader_src', ['FlynUseWPComLibraries', 'rewriteSrc'], 1, 2);
add_filter('style_loader_src', ['FlynUseWPComLibraries', 'rewriteSrc'], 1, 2);
