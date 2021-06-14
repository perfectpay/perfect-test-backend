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
    // por costume separo as routes de cada "app"
Route::get('/','HomeController');
    // rota get enviando requisicao para o controller como usei invoke, nao é utilizado o @

Route::get('/products','CategoryController@index');
Route::get('/products/{slug}','CategoryController@show');

Route::get('/blog','BlogController');
//pagina para review dos produtos/ unboxing

Route::get('/about', function(){ return view ('site.about.index');
});
// pagina about estatica, entao vai retornar apenas uma view
Route::get('/contato','ContactController@index');
Route::post('/contato','ContactController@form')
//rota post para o formulario em si

}

);