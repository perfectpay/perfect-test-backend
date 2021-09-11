<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function cadastroProduto()
    {
        
        return view('cadastro.cadastrarProduto');
            
    }

    public function store(Request $request)
    {
        if(empty($request->nomeProduto) || empty($request->descricao) || empty($request->preco) )
        {
            return back()->withInput();
        }
        else
        {
            dd($request);
        }
    }
}

?>