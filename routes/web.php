<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('hello.telaInicial');
});

Route::get('telaInicial', 'VendaController@index');

Route::get('telaDoProduto', 'ProdutoController@cadastroProduto');
Route::post('Cadastrarprodutos', 'ProdutoController@store')->name('store');

Route::get('telaDeVenda', 'VendaController@cadastroVenda');




















//http://test-backend.devppay.com.br


/*
Telas para ver o funcionamento sem dados
*/
/* Route::get('/', function () {
    return view('dashboard');
});
Route::get('/sales', function () {
    return view('crud_sales');
});
Route::get('/products', function () {
    return view('crud_products');
});
*/


