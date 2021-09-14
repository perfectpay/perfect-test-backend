<?php

use Illuminate\Support\Facades\Route;
/* 
Route::get('/', function () {
    return view('hello.telaInicial');
});
 */
Route::get('/', ['as' => 'hello.index', 'uses' => 'VendaController@index']);

Route::get('pesquisa', 'VendaController@indexPesquisa')->name('pesquisa');

Route::get('telaDeVenda/', 'VendaController@cadastroVenda');
Route::get('detalheVenda/{id}' , ['as' => 'venda.detalheVenda', 'uses' => 'VendaController@detalheVenda']);
Route::put('atualizarVenda/{id}' , ['as' => 'venda.atualizar', 'uses' => 'VendaController@atualizar']);
Route::post('cadastrarVenda/', 'VendaController@storeVenda')->name('storeVenda');

Route::get('telaDoProduto', 'ProdutoController@cadastroProduto');
Route::get('detalheProduto/{id}', ['as' => 'produto.detalheProduto', 'uses' => 'ProdutoController@detalheProduto']);
Route::put('atualizarProduto/{id}', ['as' => 'produto.atualizar', 'uses' =>'ProdutoController@atualizarProduto']);
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


