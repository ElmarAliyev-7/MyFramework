<?php

require __DIR__ . '/vendor/autoload.php';

use \PhpMvcFramework\Core\{App, Route};

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

Route::get('/', 'Home@index');

Route::get('users/:id', 'User@show');

Route::get('/user/:id', function ($id){
    return 'user id = ' . $id;
});

Route::get('/users', function (){
    return 'users page';
});

Route::post('/updateUser', function (){
   return 'update user';
});

Route::dispatch();