<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'cliente'], function () {
    Route::post('listar',       'Api\ClienteController@listarClientes');
    Route::post('detalhar',     'Api\ClienteController@detalharCliente');
    Route::post('cadastrar',    'Api\ClienteController@cadastrarCliente');
    Route::post('alterar',      'Api\ClienteController@alterarCliente');
    Route::post('apagar',       'Api\ClienteController@apagarCliente');
});

Route::group(['prefix' => 'produto'], function () {
    Route::post('listar',       'Api\ProdutoController@listarProdutos');
    Route::post('detalhar',     'Api\ProdutoController@detalharProduto');
    Route::post('cadastrar',    'Api\ProdutoController@cadastrarProduto');
    Route::post('alterar',      'Api\ProdutoController@alterarProduto');
    Route::post('apagar',       'Api\ProdutoController@apagarProduto');
});

Route::group(['prefix' => 'venda'], function () {
    Route::post('listar',       'Api\VendaController@listarVendas');
    Route::post('detalhar',     'Api\VendaController@detalharVenda');
    Route::post('cadastrar',    'Api\VendaController@cadastrarVenda');
    Route::post('alterar',      'Api\VendaController@alterarVenda');
    Route::post('cancelar',     'Api\VendaController@cancelarVenda');
});
