<?php

use Illuminate\Support\Facades\Route;



/*
Telas para ver o funcionamento sem dados
*/
Route::get('/', 'Controller@index')->name('dashboard');

Route::get('/sales', function () {
    return view('crud_sales');
});
Route::get('/products', 'ProdutoController@create')->name('produto.create');
