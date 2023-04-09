<?php

use PhpMvcFramework\Core\{Route};

Route::get('/', 'Home@index')->name('home');
Route::get('/blogs', 'Blog@index')->name('blogs');
Route::get('/blog/:id', 'Blog@show')->name('blog');

//Route::get('/user/:id', 'User@show')->name('user');
//
//Route::get('/@:username', function ($username){
//    return 'Username :' . $username;
//})->where('username', '[a-z]+');
//
//Route::get('/search/:search', function ($q){
//    return 'Searched word :' . rawurldecode($q);
//})->where('search', '.*');
//
//Route::prefix('/admin')->group( function () {
//    Route::get('/?', function () {
//        return 'admin home page';
//    });
//    Route::get('/users', function () {
//        return 'admin users page';
//    });
//});

//Route::redirect('/salam', 'hello');