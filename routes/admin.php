<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
  Route::get('/feedback', 'App\Http\Controllers\Admin\IndexController@feedback')->name('feedback');

  Route::get('articles', 'App\Http\Controllers\Admin\IndexController@index')->name('article.index');

  Route::get('articles/{article:code}', 'App\Http\Controllers\Admin\IndexController@show')->name('article.show');

  Route::patch('articles/{article:code}', 'App\Http\Controllers\Admin\IndexController@update')->name('article.update');

  Route::delete('articles/{article:code}', 'App\Http\Controllers\Admin\IndexController@destroy')->name('article.destroy');

  Route::get('articles/{article:code}/edit', 'App\Http\Controllers\Admin\IndexController@edit')->name('article.edit');
  
  
  Route::get('/news/create', 'App\Http\Controllers\Admin\NewsController@create')->name('news.create');

  Route::post('/news', 'App\Http\Controllers\Admin\NewsController@store')->name('news.store');

  Route::get('/news/{news:id}/edit', 'App\Http\Controllers\Admin\NewsController@edit')->name('news.edit');

  Route::patch('/news/{news:id}', 'App\Http\Controllers\Admin\NewsController@update')->name('news.update');

  Route::delete('/news/{news:id}', 'App\Http\Controllers\Admin\NewsController@destroy')->name('news.destroy');

  Route::get('/news', 'App\Http\Controllers\Admin\NewsController@index')->name('news.index');

  Route::get('/news/{news:id}', 'App\Http\Controllers\Admin\NewsController@show')->name('news.show');


  Route::get('/reports', 'App\Http\Controllers\Admin\ReportsController@index')->name('reports.index');

  Route::post('/reports', 'App\Http\Controllers\Admin\ReportsController@queue')->name('reports.queue');

  Route::get('/reports/total', 'App\Http\Controllers\Admin\ReportsController@total')->name('reports.total');

});
