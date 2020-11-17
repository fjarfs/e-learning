<?php

require('helpers/function.php');

accessLog();
set_error_handler('myErrorHandler');

session_start();
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
} else {
    $_SESSION['lang'] = 'en';
}

$template = 1;
$assets = "assets/" . $template;


return require(__DIR__ . '/views/templates/' . $template . '/' . $template . '.php');
