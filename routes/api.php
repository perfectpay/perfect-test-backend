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
    Route::post('listar',       'ClienteController@listarClientes');
    Route::post('detalhar',     'ClienteController@detalharCliente');
    Route::post('cadastrar',    'ClienteController@cadastrarCliente');
    Route::post('alterar',      'ClienteController@alterarCliente');
    Route::post('apagar',       'ClienteController@apagarCliente');
});

Route::group(['prefix' => 'produto'], function () {
    Route::post('listar',       'ProdutoController@listarProdutos');
    Route::post('detalhar',     'ProdutoController@detalharProduto');
    Route::post('cadastrar',    'ProdutoController@cadastrarProduto');
    Route::post('alterar',      'ProdutoController@alterarProduto');
    Route::post('apagar',       'ProdutoController@apagarProduto');
});
