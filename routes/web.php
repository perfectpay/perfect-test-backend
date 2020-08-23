<?php

use Illuminate\Support\Facades\Route;



/*
Telas para ver o funcionamento sem dados
*/
Route::get('/', ['uses'=>'DashboardController@carregarInformacoes']);

Route::get('/sales', function () {
    return view('crud_sales');
});

Route::get('/products', function () {
    return view('crud_products');
});
