<?php

use Illuminate\Support\Facades\Route;



/*
Telas para ver o funcionamento sem dados
*/
Route::get('/', 'DashboardController@home')->name('home');
Route::get('/sales', function () {
    return view('crud_sales');
});

Route::resource('/products', 'ProductController');

Route::resource('/clients', 'ClientController');
