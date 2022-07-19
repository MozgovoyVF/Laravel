<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
  Route::get('/feedback', 'App\Http\Controllers\Admin\IndexController@feedback')->name('feedback');

  Route::get('articles', 'App\Http\Controllers\Admin\IndexController@index')->name('article.index');

  Route::get('articles/{article:code}', 'App\Http\Controllers\Admin\IndexController@show')->name('article.show');

  Route::patch('articles/{article:code}', 'App\Http\Controllers\Admin\IndexController@update')->name('article.update');

  Route::delete('articles/{article:code}', 'App\Http\Controllers\Admin\IndexController@destroy')->name('article.destroy');

  Route::get('articles/{article:code}/edit', 'App\Http\Controllers\Admin\IndexController@edit')->name('article.edit');
});
