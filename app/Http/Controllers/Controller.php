<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Produto;
use App\Venda;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $clientes = Cliente::select('name')->get();
        $vendas = Venda::with(['produtosVenda'])->latest('data')->get();
        $resultados = Venda::groupBy('status')
            ->selectRaw('count(*) as total, status')
            ->get();

        $produtos = Produto::all();
        return view('dashboard', ['clientes'=>$clientes, 'vendas'=>$vendas, 'resultados'=>$resultados, 'produtos'=>$produtos]);
    }
}
