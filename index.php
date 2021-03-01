<?php
define('shoppingcart', true);
// Determine the base URL
$protocol = 'http://';
if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) {
    $protocol = 'https://';
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
    $protocol = 'https://';
}
define('base_url', rtrim($protocol . $_SERVER['HTTP_HOST'] . substr(str_replace('\\', '/', realpath(__DIR__)), strlen($_SERVER['DOCUMENT_ROOT'])), '/') . '/');
// Initialize a new session
session_start();
// Include the configuration file, this contains settings you can change.
include 'config.php';
// Include functions and connect to the database using PDO MySQL
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Output error variable
$error = '';
// Define all the routes for all pages
$url = routes([
    '/',
    '/home',
    '/product/{id}',
    '/products',
    '/products/{category}/{sort}',
    '/products/{p}/{category}/{sort}',
    '/myaccount',
    '/download/{id}',
    '/cart',
    '/cart/{remove}',
    '/checkout',
    '/placeorder',
    '/search/{query}',
    '/logout'
]);
// Check if route exists
if ($url) {
    include $url;
} else {
    // Page is set to home (home.php) by default, so when the visitor visits that will be the page they see.
    $page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
    // Include the requested page
    include $page . '.php';
}
?>
