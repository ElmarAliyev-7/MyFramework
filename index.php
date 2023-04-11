<?php

use PhpMvcFramework\Core\Route;

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__ . '/vendor/autoload.php';

/*
 * Loads environment variables from .env to getenv(), $_ENV and $_SERVER automagically.
 */

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

/*
 * Define the "web" routes for the application.
 */
require __DIR__ . '/routes/web.php';

/*
 * Define the "api" routes for the application.
 */
Route::prefix('/api');
require __DIR__ . '/routes/api.php';
Route::$prefix = '';

/*
 * Run Route Process
 */
Route::dispatch();