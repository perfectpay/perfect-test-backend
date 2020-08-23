<?php

use Illuminate\Support\Facades\Route;



/*
Telas para ver o funcionamento sem dados
*/
Route::get('/', ['uses'=>'DashboardController@carregarInformacoes']);

Route::group(['prefix' => 'sales'], function () {
    Route::get('cadastrar',             'VendaController@carregarInformacoesVenda');
    Route::get('detalhar/{idVenda}',    'VendaController@detalharVenda');
    Route::post('cadastrar',            'VendaController@cadastrarVenda');
    Route::post('alterar',              'VendaController@alterarVenda');
});

Route::group(['prefix' => 'products'], function () {
    Route::get('cadastrar', function () {
        return view('cadastrar_produto');
    });
    Route::get('detalhar/{idProduto}',  'ProdutoController@detalharProduto');
    Route::post('cadastrar',            'ProdutoController@cadastrarProduto');
    Route::post('alterar',              'ProdutoController@alterarProduto');
});
