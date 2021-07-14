<?php

use Illuminate\Support\Facades\Route;



/*
Telas para ver o funcionamento sem dados
*/
Route::get('/', 'DashboardController@home')->name('home');
Route::get('/sales', function () {
    return view('sales.create');
});

Route::resource('/products', 'ProductController');

Route::resource('/clients', 'ClientController');

Route::resource('/sales', 'SaleController');

Route::post('/search', 'DashboardController@search')->name('search');