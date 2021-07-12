<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class DashboardController extends Controller
{
    public function home(){
        $products = Product::all();

        return view('dashboard', compact('products'));
    }
}
