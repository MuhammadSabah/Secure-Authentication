<?php


$route = explode('/', $_SERVER['REQUEST_URI'])[2];

$routes = [
    '' => 'views/pages/dashboard.php',
    'index' => 'views/pages/dashboard.php',
    'dashboard' => 'views/pages/dashboard.php',
    'account' => 'views/pages/account.php',
    'login' => 'login.php',
    'signup' => 'signup.php',
    'forget' => 'forget.php',
    'reset' => 'reset.php',
];


require($routes[$route]);
