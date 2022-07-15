<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/', 'App\Http\Controllers\IndexController@index')->name('index');

Route::post('/', 'App\Http\Controllers\IndexController@store');

Route::get('/about', 'App\Http\Controllers\IndexController@about');

Route::get('/contacts', 'App\Http\Controllers\IndexController@contacts');


Route::get('/admin/feedback', 'App\Http\Controllers\AdminController@feedback');


Route::post('/articles', 'App\Http\Controllers\ArticlesController@store')->name('article');

Route::get('/articles/create', 'App\Http\Controllers\ArticlesController@create')->middleware('auth')->name('article.create');

Route::get('/articles/{article:code}', 'App\Http\Controllers\ArticlesController@show')->name('article.show');

Route::patch('/articles/{article:code}', 'App\Http\Controllers\ArticlesController@update')->name('article.update');

Route::delete('/articles/{article:code}', 'App\Http\Controllers\ArticlesController@destroy')->name('article.destroy');

Route::get('/articles/{article:code}/edit', 'App\Http\Controllers\ArticlesController@edit')->name('article.edit');


Route::get('/articles/tags/{tag:name}', 'App\Http\Controllers\TagsController@index')->name('article.tags.index');