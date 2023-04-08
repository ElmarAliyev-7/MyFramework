<?php

require __DIR__ . '/vendor/autoload.php';

use \PhpMvcFramework\Core\{App, Route};

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

function route($name, $params = []) {
    return Route::url($name, $params);
}

Route::get('/', 'Home@index')->name('home');

Route::get('/user/:id/:id2', 'User@show')->name('user');
//Route::url('user', [':id' => 3]);
//echo \route('user', [':id' => 4]);

Route::dispatch();