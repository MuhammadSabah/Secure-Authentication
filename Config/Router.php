<?php


$route = explode('/', $_SERVER['REQUEST_URI'])[2];

$routes = [
    '' => 'Views/pages/dashboard.php',
    'index' => 'Views/pages/dashboard.php',
    'dashboard' => 'Views/pages/dashboard.php',
    'account' => 'Views/pages/account.php',
    'login' => 'login.php',
    'signup' => 'signup.php',
    'forget' => 'forget.php',
    'reset' => 'reset.php',
];

require($routes[$route]);
