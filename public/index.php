<?php

require __DIR__ . '/../vendor/autoload.php';

define('VIEW_PATH', __DIR__ . '/../views');
define('STORAGE_PATH', __DIR__ . '/../storage');

use App\App;
use App\Router;
use App\Controllers\HomeController;

$router = new Router();

$router
  ->get('/', [HomeController::class, 'index'])
  ->post('/upload', [HomeController::class, 'upload'])
  ->get('/showData', [HomeController::class, 'showData']);

(new App($router, [
  'uri' => $_SERVER['REQUEST_URI'],
  'method' => $_SERVER['REQUEST_METHOD']
]))->run();
