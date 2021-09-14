<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Produto;
use App\Venda;

class ProdutoController extends Controller
{

    public function cadastroProduto()
    {
        
        return view('cadastro.cadastrarProduto');
            
    }
    public function detalheProduto($id)
    {
        /* dd($id); */
         $produtos = Produto::all();
         
         $resultado = Produto::find($id);
         /* dd($resultado); */
        back()->withInput();
        return view('cadastro.editarProduto', compact('produtos','resultado', 'id'));
        
    }
    public function atualizarProduto(Request $request, $id)
    {

        $resultado = Produto::find($id);

        DB::update('update produtos set Nome = ?, Descricao = ?, Preco = ? where Id = ?', [$request->Nome, $request->Descricao, $request->Preco, $id]);

        return redirect() ->route('hello.index');
        
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

            return redirect() ->route('hello.index', compact('produtos', 'vendas'));
        }
    }
}

?>