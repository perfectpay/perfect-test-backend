<?php

use Illuminate\Support\Facades\Route;



/*
Telas para ver o funcionamento sem dados
*/
Route::get('/', 'Controller@index')->name('dashboard');

Route::get('/sales/create', 'VendaController@create')->name('venda.create');
Route::get('/sales/edit', 'VendaController@create')->name('venda.create');
Route::get('/sales/', 'VendaController@create')->name('venda.create');
Route::get('/products', 'ProdutoController@create')->name('produto.create');
Route::get('/products', 'ProdutoController@create')->name('produto.create');
Route::get('/products', 'ProdutoController@create')->name('produto.create');
Route::get('/products', 'ProdutoController@create')->name('produto.create');
