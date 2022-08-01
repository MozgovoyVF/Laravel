<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';


Route::get('/', 'App\Http\Controllers\IndexController@index')->name('index');

Route::post('/', 'App\Http\Controllers\IndexController@store');

Route::get('/about', 'App\Http\Controllers\IndexController@about')->name('about');

Route::get('/contacts', 'App\Http\Controllers\IndexController@contacts')->name('contacts');

Route::group(['prefix' => 'articles', 'as' => 'article.'], function () {
    Route::get('/', function () {
        return redirect()->route('index');
    });

    Route::redirect('/articles', '/');

    Route::post('/', 'App\Http\Controllers\ArticlesController@store')->name('store');

    Route::get('/create', 'App\Http\Controllers\ArticlesController@create')->middleware('auth')->name('create');

    Route::get('/{article:code}', 'App\Http\Controllers\ArticlesController@show')->name('show');

    Route::patch('/{article:code}', 'App\Http\Controllers\ArticlesController@update')->name('update');

    Route::delete('/{article:code}', 'App\Http\Controllers\ArticlesController@destroy')->name('destroy');

    Route::get('/{article:code}/edit', 'App\Http\Controllers\ArticlesController@edit')->name('edit');


    Route::get('/tags/{tag:name}', 'App\Http\Controllers\TagsController@index')->name('tags.index');


    Route::post('/{article:code}/comments', 'App\Http\Controllers\CommentsController@store')->middleware('auth')->name('comments.store');
});

Route::group(['prefix' => 'news', 'as' => 'news.'], function () {
    Route::get('/', 'App\Http\Controllers\NewsController@index')->name('index');

    Route::get('/{news:id}', 'App\Http\Controllers\NewsController@show')->name('show');
});