<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
});

Route::get('/sales', function () {
    return view('crud_sales');
});
Route::get('/products', function () {
    return view('crud_products');
});

//clients
Route::get('/client', 'ClientController@index');
Route::get('/client/{cpf}','ClientController@show');

//sales
Route::get('/sale','SaleController@list');
Route::get('/sale/{id}','SaleController@show');
Route::post('/sale','SaleController@store');
Route::put('/sale/update/{id}', 'SaleController@update');
Route::get('/saleresult', 'SaleController@salesresult');

//products
Route::get('/product', 'ProductController@index');
Route::post('/product/update/{id}', 'ProductController@update');
Route::post('/product', 'ProductController@store');