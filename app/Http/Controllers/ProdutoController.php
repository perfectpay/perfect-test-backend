<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produto;
use App\Venda;

class ProdutoController extends Controller
{

    public function cadastroProduto()
    {
        
        return view('cadastro.cadastrarProduto');
            
    }
    public function editarProduto(Request $request)
    {
         $produtos = Produto::all();
         
         $IdProduto = preg_replace("/[^0-9]/","", $_SERVER['PATH_INFO']); 
         $resultado = Produto::find($IdProduto);
         /* dd($resultado); */
        back()->withInput();
        return view('cadastro.cadastrarProduto', compact('produtos', 'IdProduto','resultado'));
        
    }
    public function produtoEditado(Request $request)
    {
        
        $produtos = Produto::all();
        dd($request);
        $idProduto = preg_replace("/[^0-9]/","", $_SERVER['PATH_INFO']);
        $resultado = Venda::find($idProduto);
       
        /* dd($resultado); */

        
        return view('cadastro.cadastrarProduto', compact('produtos', 'idProduto','resultado'));
        
    }

    public function store(Request $request)
    {

       /*  dd($_SESSION); */
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