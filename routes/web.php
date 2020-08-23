<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashBoardController@index')->name('dashboard.index');

Route::resource('products', 'ProductController');

Route::resource('sales', 'ProductController');
