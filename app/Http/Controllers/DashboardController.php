<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Client;
use App\Sale;
use DateTime;

class DashboardController extends Controller
{
    public function home(){
        $products = Product::all();
        $clients = Client::all();
        $lastTenSales = Sale::where('status', 'Aprovado')->orderBy('id','desc')->take(10)->get();

        $sold = Sale::where('status', 'Aprovado')->count();
        $canceled = Sale::where('status', 'Cancelado')->count();
        $returns = Sale::where('status', 'Devolvido')->count();

        $amountSold = Sale::where('status', 'Aprovado')->sum('total_purchase_amount');
        $amountCanceled = Sale::where('status', 'Cancelado')->sum('total_purchase_amount');
        $amountReturns = Sale::where('status', 'Devolvido')->sum('total_purchase_amount');


        $period = null;
        $client_name = null;

        return view('dashboard', compact('products', 'clients', 'lastTenSales', 'sold', 
                    'canceled', 'returns', 'amountSold', 'amountCanceled', 
                    'amountReturns', 'period', 'client_name'));
    }

    public function search(Request $request){

        $fromDate = DateTime::createFromFormat('d/m/Y', substr($request->period, 0, 10));
        $toDate = DateTime::createFromFormat('d/m/Y', substr($request->period, 13, 10))->modify('+1 day');
        $from =  $fromDate->format('Y-m-d');
        $to = $toDate->format('Y-m-d');
        
        $lastTenSales = Sale::where('client_id',$request->client_id)->where('status', 'Aprovado')->whereBetween('created_at', [$from, $to])->orderBy('id','desc')->take(10)->get();

        $products = Product::all();
        $clients = Client::all();

        $sold = Sale::where('status', 'Aprovado')->count();
        $canceled = Sale::where('status', 'Cancelado')->count();
        $returns = Sale::where('status', 'Devolvido')->count();

        $amountSold = Sale::where('status', 'Aprovado')->sum('total_purchase_amount');
        $amountCanceled = Sale::where('status', 'Cancelado')->sum('total_purchase_amount');
        $amountReturns = Sale::where('status', 'Devolvido')->sum('total_purchase_amount');

        $period = $request->period;
        $client_id = Client::where('id', $request->client_id)->first();
        $client_name = $client_id->name;

        return view('dashboard', compact('products', 'clients', 'lastTenSales', 'sold', 
                                        'canceled', 'returns', 'amountSold', 'amountCanceled', 
                                        'amountReturns', 'period', 'client_name'));

    }
}
