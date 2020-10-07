<?php

session_start();
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
} else {
    $_SESSION['lang'] = 'en';
}

$lang = require('lang/config.php');
set_error_handler('myErrorHandler');
return require('views/index.php');
