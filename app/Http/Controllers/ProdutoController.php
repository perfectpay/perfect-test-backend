<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produto;

class ProdutoController extends Controller
{

    public function comboboxShow()
    {
        
        //
            
    }

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
            $post = new Produto();
            $post->Nome = $request->nomeProduto;
            $post->Descricao = $request->descricao;
            $post->Preco = $request->preco;
            

            $post->save();

            return view('cadastro.cadastrarProduto');
        }
    }
}

?>