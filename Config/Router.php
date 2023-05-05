<?php


$route = explode('/', $_SERVER['REQUEST_URI'])[2];

$routes = [
    '' => 'Views/pages/dashboard.php',
    'index' => 'Views/pages/dashboard.php',
    'dashboard' => 'Views/pages/dashboard.php',
    'account' => 'Views/pages/account.php',
    'login' => 'Views/auth/login.php',
    'signup' => 'Views/auth/signup.php',
    'forget' => 'Views/auth/forget.php',
    'reset' => 'Views/auth/reset.php',
];

require($routes[$route]);
