<?php

use Illuminate\Support\Facades\Route;



/*
Telas para ver o funcionamento sem dados
*/
Route::get('/', ['uses'=>'DashboardController@carregarInformacoes']);

Route::get('/sales', function () {
    return view('crud_sales');
});

Route::group(['prefix' => 'products'], function () {
    Route::get('cadastrar', function () {
        return view('cadastrar_produto');
    });
    Route::get('detalhar/{idProduto}',    ['uses' => 'ProdutoController@detalharProduto']);
    Route::post('cadastrar',                        'ProdutoController@cadastrarProduto');
    Route::post('alterar',                          'ProdutoController@alterarProduto');
});
