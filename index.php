<?php

require __DIR__ . '/vendor/autoload.php';

use PhpMvcFramework\Core\Route;

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

require __DIR__ . '/App/routes/web.php';

Route::prefix('/api');
require __DIR__ . '/App/routes/api.php';
Route::$prefix = '';

Route::dispatch();