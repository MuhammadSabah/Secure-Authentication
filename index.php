<?php

use App\Config\Application;

require_once __Dir__ . '/vendor/autoload.php';

$app = new Application();

$app->router->get('/', function () {
    ob_start();
    include __DIR__ . '/src/views/home.php';
    return ob_get_clean();
});

$app->run();
