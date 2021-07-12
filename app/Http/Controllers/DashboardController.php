<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Client;

class DashboardController extends Controller
{
    public function home(){
        $products = Product::all();
        $clients = Client::all();

        return view('dashboard', compact('products', 'clients'));
    }
}
