<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashBoardController@index')->name('dashboard.index');

Route::resource('products', 'ProductController')->except(['index', 'show']);

Route::resource('sales', 'ProductController')->except(['index', 'show']);
