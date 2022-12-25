<?php

require __DIR__ . '/../vendor/autoload.php';

define('VIEW_PATH', __DIR__ . '/../views');

use App\Router;
use App\Controllers\HomeController;

$router = new Router();

$router->get('/', [HomeController::class, 'index']);

echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
