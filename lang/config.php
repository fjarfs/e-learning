<?php

if (! function_exists('myErrorHandler')) {
    /**
     * Get the language.
     *
     * @return bool
     *
     */
    function myErrorHandler($errno, $errstr, $errfile, $errline)
    {
        if (!!$errstr) {
            throw new Exception($errstr);
        }
        return false;
    }
}

if (! function_exists('lang')) {
    /**
     * Get the language.
     *
     * @return string
     * @var string $key
     *
     * @throws \RuntimeException
     */
    function lang($key)
    {
        if (isset($_SESSION['lang'])) {
            $lang = require($_SESSION['lang'] . '.php');
        } else {
            $lang = require('en.php');
        }

        try {
            $key = explode('.', $key);
            for ($i = 0; $i < count($key); $i++) {
                $lang = $lang[$key[$i]];
            }

            return $lang;
        } catch (\Exception $e) {
            return '';
        }
    }
}

if (! function_exists('flag')) {
    /**
     * Get the flag.
     *
     * @return string
     *
     */
    function flag()
    {
        if (isset($_SESSION['lang'])) {
            if ($_SESSION['lang'] == 'id') {
                return "<a class='nav-link' href='?lang=en'><img src='assets/img/en.gif'> English </a>";
            }
        }

        return "<a class='nav-link' href='?lang=id'><img src='assets/img/id.gif'> Indonesia </a>";
    }
}
