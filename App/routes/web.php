<?php

use PhpMvcFramework\Core\{Route};

Route::get('/', 'Home@index')->name('home');
Route::get('/blogs', 'Blog@index')->name('blogs');
Route::get('/blog/:id', 'Blog@show')->name('blog');

Route::prefix('/admin')->group( function () {
    Route::get('/?', 'Admin\Auth@login');
    Route::get('/blogs','Admin\Blog@index');
});
