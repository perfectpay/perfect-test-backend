<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('/client', ClientController::class)
    ->only(['index', 'show', 'store', 'update', 'destroy']);

Route::resource('/product', ProductController::class)
    ->only(['index', 'show', 'store', 'update', 'destroy']);

Route::resource('/sale', SaleController::class)
    ->only(['index', 'show', 'store', 'update', 'destroy']);


