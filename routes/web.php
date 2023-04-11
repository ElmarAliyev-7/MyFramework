<?php

use PhpMvcFramework\Core\{Route};

Route::get('/?', 'Front\Home@index')->name('home');
Route::get('/blogs', 'Front\Blog@index')->name('blogs');
Route::get('/blogs/:id', 'Front\Blog@show')->name('blog');

Route::prefix('/admin')->group( function () {
    Route::get('/?', 'Admin\Auth@login');
    Route::get('/blogs','Admin\Blog@index');
});
