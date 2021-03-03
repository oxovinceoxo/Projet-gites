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
// Initialisation de la session
session_start();
// Include du fichier de configuration
include 'config.php';
// Include du fichier contenant les fonctions
include 'functions.php';
// Connexion à la base de données SQL
$pdo = pdo_connect_mysql();
// Stockage de var. str. en cas d'erreur
$error = '';
// Definition du routage 
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
// Vérification du routage
if ($url) {
    include $url;
} else {
    // La page par défaut lors de la connexion au site est "home".
    $page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
    // Include the requested page
    include $page . '.php';
}
?>
