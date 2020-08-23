<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashBoardController@index')->name('dashboard.index');

Route::resource('products', 'ProductsController')->except(['index', 'show']);

Route::resource('sales', 'SalesController')->except(['index', 'show']);
