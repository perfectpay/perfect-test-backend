<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;



Route::get('/','DashboardController@dashboard')->name('dashboard');
Route::get('/sales','SalesController@sales')->name('vendas');
Route::get('/products','ProductsController@products')->name('produto');
Route::get('/sales/editar/{id}/{produtoId}/{usuarioId}','SalesController@show')->name('editar_venda');
Route::get('/products/editar/{id}','ProductsController@show')->name('editar_produto');

Route::post('/sales','SalesController@store')->name('registrar_venda');
Route::post('/products','ProductsController@store')->name('registrar_produto');
Route::post('/sales/atualizado/{id}/{produtoId}/{usuarioId}','SalesController@update')->name('update_venda');
Route::post('/products/atualizado/{id}','ProductsController@update')->name('update_produto');
