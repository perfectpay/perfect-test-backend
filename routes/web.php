<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashBoardController@index')->name('dashboard.index');
Route::get('search', 'DashBoardController@search')->name('dashboard.search');

Route::resource('products', 'ProductsController')->except(['index', 'show']);

Route::resource('sales', 'SalesController')->except(['index', 'show']);
