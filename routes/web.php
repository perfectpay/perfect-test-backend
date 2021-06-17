<?php

use Illuminate\Support\Facades\Route;



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
Route::get('/clients', function () {
    return view('crud_products');
}); */

// modificar o método do route para direcionar para um controller
// utilizar o namespace para agrupar varios controllers na mesma pasta

Route::group(['namespace' => 'PerfectPay'], function()
{
    // por costume separo os controller em route groups e "app/pasta"
Route::get('/','HomeController')->name('site.home');;
    // rota get enviando requisicao para o controller como usei invoke, nao é utilizado o @


Route::get('/category/{category}','CategoryController@show')->name('site.products.category');
Route::get('/categories/create','CategoryController@form')->name('site.category.form');
Route::post('/categories/create','CategoryController@create')->name('site.category.create');
Route::get('/category/{category}/edit','CategoryController@edit')->name('site.category.edit');
Route::put('/category/{category}/edit','CategoryController@update')->name('site.category.update');
Route::get('/category/{category}/delete','CategoryController@delete')->name('site.category.delete');

Route::get('/products','CategoryController@index')->name('site.products');

Route::get('/product/{category}','ProductController@show')->name('site.product.show');

Route::get('/products/{category}/create','ProductController@form')->name('site.product.form');
Route::post('/products/{category}/create','ProductController@create')->name('site.product.create');
Route::get('/product/{product}/edit','ProductController@edit')->name('site.product.edit');
Route::put('/product/{product}/edit','ProductController@update')->name('site.product.update');
Route::get('/product/{product}/delete','ProductController@delete')->name('site.product.delete');


Route::get('/costumers','CostumerController@index')->name('site.costumers');
Route::get('/costumers/create','CostumerController@form')->name('site.costumer.form');
Route::post('/costumers/create','CostumerController@create')->name('site.costumer.create');
Route::get('/costumer/{costumer}/edit','CostumerController@edit')->name('site.costumer.edit');
Route::put('/costumer/{costumer}/edit','CostumerController@update')->name('site.costumer.update');
Route::get('/costumer/{costumer}/delete','CostumerController@delete')->name('site.costumer.delete');


Route::get('/orders','OrderController@index')->name('site.orders');
Route::get('/orders/search','OrderController@search')->name('site.orders.search');
Route::get('/orders/create','OrderController@form')->name('site.order.form');
Route::post('/orders/create','OrderController@create')->name('site.order.create');
Route::get('/orders/{order}/edit','OrderController@edit')->name('site.order.edit');
Route::put('/orders/{order}/edit','OrderController@update')->name('site.order.update');
Route::get('/orders/{order}/delete','OrderController@delete')->name('site.order.delete');



//pagina para review dos produtos/ unboxing

Route::get('/about', function(){ return view ('site.about.index');
});
// pagina about estatica, entao vai retornar apenas uma view
Route::get('/contact','ContactController@index')->name('site.contact');
Route::post('/contact','ContactController@form')->name('site.contact.form');
//rota post para o formulario em si

}

);