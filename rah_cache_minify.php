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

    public function minify($event, $step, $data)
    {
        return rah_cache__minify_Minify_HTML::minify($data['contents']);
    }
}

new rah_cache_minify();