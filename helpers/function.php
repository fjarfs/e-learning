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
            $lang = require('views/lang/' . $_SESSION['lang'] . '.php');
        } else {
            $lang = require('views/lang/en.php');
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
    function flag($assets)
    {
        if (isset($_SESSION['lang'])) {
            if ($_SESSION['lang'] == 'id') {
                return "<a class='nav-link' href='?lang=en'><img src=" . $assets . "/img/en.gif> English </a>";
            }
        }

        return "<a class='nav-link' href='?lang=id'><img src=" . $assets . "/img/id.gif> Indonesia </a>";
    }
}


if (! function_exists('accessLog')) {
    /**
     * Get the flag.
     *
     * @return string
     *
     */
    function accessLog()
    {
        $data = [
            "URL" => isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '',
            "IP" => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '',
            "AGENT" => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
            "COUNTRY" => isset($_SERVER['HTTP_CF_IPCOUNTRY']) ? $_SERVER['HTTP_CF_IPCOUNTRY'] : '',
        ];

        $data = "[" . date("Y-m-d H:i:s") . "] " . json_encode($data);

        $log_filename = "logs";
        if (! file_exists($log_filename)) {
            mkdir($log_filename, 0777, true);
        }
        $log_file_data = $log_filename . '/log-' . date('d-M-Y') . '.log';
        file_put_contents($log_file_data, $data . "\n", FILE_APPEND);
    }
}
