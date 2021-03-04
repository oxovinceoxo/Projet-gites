<?php
// Fonction de connexion à la BDD MySQL
function pdo_connect_mysql() {
    try {
        // Connexion à la BDD en utilisant PDO
    	return new PDO('mysql:host=' . db_host . ';dbname=' . db_name . ';charset=utf8', db_user, db_pass);
    } catch (PDOException $exception) {
    	// Message d'erreur en cas d'erreur de connexion à la BDD!
    	exit('[!] Erreur lors de la connexion à la base de donnée');
    }
}

// Temple Header (à customiser)
function template_header($title, $head = '') {
    // Get the amount of items in the shopping cart, this will be displayed in the header.
    $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    $home_link = url('index.php');
    $products_link = url('index.php?page=products');
    $myaccount_link = url('index.php?page=myaccount');
    $cart_link = url('index.php?page=cart');
    $admin_link = isset($_SESSION['account_loggedin']) && $_SESSION['account_admin'] ? '<a href="' . base_url . 'admin/index.php" target="_blank">Admin</a>' : '';
    $logout_link = isset($_SESSION['account_loggedin']) ? '<a title="Logout" href="' . url('index.php?page=logout') . '"><i class="fas fa-sign-out-alt"></i></a>' : '';
    $site_name = site_name;
    $base_url = base_url;
    echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width,minimum-scale=1">
            <title>$title</title>
            <link rel="icon" type="image/png" href="{$base_url}favicon.png">
            <link href="{$base_url}style.css" rel="stylesheet" type="text/css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
            $head
        </head>
        <body>
            <header>
                <div class="content-wrapper">
                    <h1>$site_name</h1>
                    <nav>
                        <a href="$home_link">Home</a>
                        <a href="$products_link">Products</a>
                        <a href="$myaccount_link">My Account</a>
                        $admin_link
                    </nav>
                    <div class="link-icons">
                        <div class="search">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search...">
                        </div>
                        <a href="$cart_link" title="Shopping Cart">
                            <i class="fas fa-shopping-cart"></i>
                            <span>$num_items_in_cart</span>
                        </a>
                        $logout_link
                        <a class="responsive-toggle" href="#">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                </div>
            </header>
            <main>
    EOT;
    }

// Rewrite URL function
function url($url) {
    if (rewrite_url) {
        $url = preg_replace('/\&(.*?)\=/', '/', str_replace(['index.php?page=', 'index.php'], '', $url));
    }
    return base_url . $url;
}

// Fonction routeur
function routes($urls) {
    foreach ($urls as $url) {
        $url = '/' . ltrim($url, '/');
        $prefix = dirname($_SERVER['PHP_SELF']);
        $uri = $_SERVER['REQUEST_URI'];
        if (substr($uri, 0, strlen($prefix)) == $prefix) {
            $uri = substr($uri, strlen($prefix));
        }
        $uri = '/' . ltrim($uri, '/');
        $path = explode('/', parse_url($uri)['path']);
        $routes = explode('/', $url);
        $values = [];
        foreach ($path as $pk => $pv) {
            if (isset($routes[$pk]) && preg_match('/{(.*?)}/', $routes[$pk])) {
                $var = str_replace(['{','}'], '', $routes[$pk]);
                $routes[$pk] = preg_replace('/{(.*?)}/', $pv, $routes[$pk]);
                $values[$var] = $pv;
            }
        }
        if ($routes === $path && rewrite_url) {
            foreach ($values as $k => $v) {
                $_GET[$k] = $v;
            }
            return file_exists($routes[1] . '.php') ? $routes[1] . '.php' : 'home.php';
        }
    }
    if (rewrite_url) {
        http_response_code(404);
        exit;
    }
    return null;
}

