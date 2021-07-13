<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Client;
use App\Sale;

class DashboardController extends Controller
{
    public function home(){
        $products = Product::all();
        $clients = Client::all();
        $lastTenSales = Sale::where('status', 'Aprovado')->orderBy('id','desc')->take(10)->get();

        $sold = Sale::where('status', 'Aprovado')->count();
        $canceled = Sale::where('status', 'Cancelado')->count();
        $returns = Sale::where('status', 'Devolvido')->count();

        return view('dashboard', compact('products', 'clients', 'lastTenSales', 'sold', 'canceled', 'returns'));
    }
}
