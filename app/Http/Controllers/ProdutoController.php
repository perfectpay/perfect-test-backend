<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produto;

class ProdutoController extends Controller
{

    public function comboboxShow()
    {
        
        return Produto::all();
            
    }

    public function cadastroProduto()
    {
        
        return view('cadastro.cadastrarProduto');
            
    }

    public function store(Request $request)
    {
        if(empty($request->nomeProduto) || empty($request->descricao) || empty($request->preco) )
        {
            
            back()->withInput();
            
            $erro = "Favor, preencher todos os campos do produto!";
            return view('cadastro.cadastrarProduto', compact('erro'));
        }
        else
        {
            $vendas = Venda::all();
            $produtos = Produto::all();
            $post = new Produto();
            $post->Nome = $request->nomeProduto;
            $post->Descricao = $request->descricao;
            $post->Preco = $request->preco;
            //
            $post->save();

            return view('hello.telaInicial', compact('produtos', 'vendas'));
        }
    }
}

?>