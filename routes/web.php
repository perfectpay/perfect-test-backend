<?php

use Illuminate\Support\Facades\Route;



/*
Telas para ver o funcionamento sem dados
*/
Route::get('/', 'Controller@index')->name('dashboard');


/*
Rotas de Vendas
*/
Route::get('/sales/create', 'VendaController@create')->name('venda.create');
Route::post('/sales', 'VendaController@store')->name('venda.store');
Route::get('/sales/{id}', 'VendaController@show')->name('venda.show');
Route::get('/sales/edit', 'VendaController@edit')->name('venda.edit');
Route::put('/sales/{id}', 'VendaController@update')->name('venda.update');
Route::delete('/sales/{id}', 'VendaController@destroy')->name('venda.destroy');

/*
Rotas de Produtos
*/
Route::get('/products/create', 'ProdutoController@create')->name('produto.create');
Route::post('/products', 'ProdutoController@store')->name('produto.store');
Route::get('/products/{id}', 'ProdutoController@show')->name('produto.show');
Route::get('/products/edit', 'ProdutoController@edit')->name('produto.edit');
Route::put('/products/{id}', 'ProdutoController@update')->name('produto.update');
Route::delete('/products/{id}', 'ProdutoController@destroy')->name('produto.destroy');


/*
Rotas de Clientes
*/
Route::get('/clients/create', 'ClienteController@create')->name('cliente.create');
Route::post('/clients', 'ClienteController@store')->name('cliente.store');
Route::get('/clients/{id}', 'ClienteController@show')->name('cliente.show');
Route::get('/clients/edit', 'ClienteController@edit')->name('cliente.edit');
Route::put('/clients/{id}', 'ClienteController@update')->name('cliente.update');
Route::delete('/clients/{id}', 'ClienteController@destroy')->name('cliente.destroy');

