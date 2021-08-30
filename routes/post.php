<?php

use Illuminate\Support\Facades\Route;


//post
Route::middleware('auth')->group(function(){

    Route::get('/posts/create','PostController@create')->name('post.create');
    Route::post('/posts/store','PostController@store')->name('post.store');
    Route::get('/posts','PostController@index')->name('post.index');
    Route::delete('/posts/{post}/destroy','PostController@destroy')->name('post.destroy');
    Route::get('/posts/{post}/edit','PostController@edit')->name('post.edit');
    Route::put('/posts/{post}/update','PostController@update')->name('post.update');
});