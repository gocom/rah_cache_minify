<?php 

/*
 * Minify module for rah_cache
 * https://github.com/gocom/rah_cache_minify
 *
 * Copyright (C) 2013 Jukka Svahn
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

/**
 * Minifies HTML.
 */

class Rah_Cache_Minify
{
    /**
     * Constructor.
     */

    public function __construct()
    {
        register_callback(array($this, 'minify'), 'textpattern_end');
    }

    /**
     * Whether the page is a plain old HTML.
     *
     * @return bool
     */

    protected function isHTML()
    {
        if (function_exists('headers_list') && $headers = headers_list())
        {
            foreach ((array) $headers as $header)
            {
                $header = strtolower($header);

                if (strpos($header, 'content-type:') === 0 && !strpos($header, 'text/html'))
                {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Minifies the HTML page.
     *
     * Replaces output buffer with minified HTML.
     */

    public function minify()
    {
        if ($this->isHTML() && class_exists('Minify_HTML'))
        {
            $page = ob_get_contents();
            ob_clean();
            echo Minify_HTML::minify($page);
        }
    }
}

new Rah_Cache_Minify();