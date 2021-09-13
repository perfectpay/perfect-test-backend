<?php

use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('hello.telaInicial');
});
 */
Route::get('/', 'VendaController@index');
Route::get('pesquisa', 'VendaController@indexPesquisa')->name('pesquisa');

Route::get('editarVenda/{idVenda}' , 'VendaController@editarVenda')->name('editarVenda');
Route::get('editarVenda/Edit/{idVenda}', 'VendaController@vendaEditada')->name('vendaEditada');
Route::get('telaDeVenda/', 'VendaController@cadastroVenda');
Route::post('cadastrarVenda/', 'VendaController@storeVenda')->name('storeVenda');

Route::get('telaDoProduto', 'ProdutoController@cadastroProduto');
Route::get('editarProduto/{idProduto}' , 'ProdutoController@editarProduto')->name('editarProduto');
Route::get('editarProduto/Edit/{idProduto}', 'ProdutoController@produtoEditado')->name('produtoEditado');
Route::post('cadastrarProdutos', 'ProdutoController@store')->name('store');




















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


