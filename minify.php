<?php 

/**
 * Minify module for rah_cache.
 *
 * @package rah_cache
 * @author  Jukka Svahn
 * @license GPLv2
 */

class rah_cache_minify
{
    /**
     * Constructor.
     */

    public function __construct()
    {
        register_callback(array($this, 'minify'), 'rah_cache.store');
    }

    /**
     * Minify.
     */

    public function minify()
    {
        $data = rah_cache::data();
        $data = rah_cache__minify_Minify_HTML::minify($data);
        rah_cache::data($data);
    }
}

new rah_cache_minify();