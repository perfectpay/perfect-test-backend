<?php

use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('hello.telaInicial');
});
 */
Route::get('/', 'VendaController@index');

Route::get('retornoProdutos', 'ProdutoController@comboboxShow');

Route::get('telaDoProduto', 'ProdutoController@cadastroProduto');
Route::post('cadastrarProdutos', 'ProdutoController@store')->name('store');

Route::get('telaDeVenda', 'VendaController@cadastroVenda');
Route::post('cadastrarVenda', 'VendaController@storeVenda')->name('storeVenda');


















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


