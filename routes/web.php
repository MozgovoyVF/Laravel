<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\IndexController@index');

Route::post('/', 'App\Http\Controllers\IndexController@store');

Route::get('/about', 'App\Http\Controllers\IndexController@about');

Route::get('/contacts', 'App\Http\Controllers\IndexController@contacts');


Route::get('/admin/feedback', 'App\Http\Controllers\AdminController@feedback');


Route::post('/articles', 'App\Http\Controllers\ArticlesController@store');

Route::get('/articles/create', 'App\Http\Controllers\ArticlesController@create');

Route::get('/articles/{article:code}', 'App\Http\Controllers\ArticlesController@show');


