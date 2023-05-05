<?php

namespace App\Config;

class Router
{
    public Request $request;
    protected array $routes = [];

    public function __construct(\App\Config\Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        echo $path;
        $method = $this->request->getMethod();
        echo $method;
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            echo "Not found";
            exit;
        }

        echo call_user_func($callback);
    }
}


// namespace App\Config;

// $route = explode('/', $_SERVER['REQUEST_URI'])[2];

// $routes = [
//     '' => '../views/pages/dashboard.php',
//     'index' => '../views/pages/dashboard.php',
//     'dashboard' => '../views/pages/dashboard.php',
//     'account' => '../views/pages/account.php',
//     'login' => '../views/auth/login.php',
//     'signup' => '../views/auth/signup.php',
//     'forget' => '../views/auth/forget.php',
//     'reset' => '../views/auth/reset.php',
// ];

// require($routes[$route]);
