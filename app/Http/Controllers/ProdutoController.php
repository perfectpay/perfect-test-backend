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
         $produtos = Produto::all(); 
         $resultado = Produto::find($id);
        back()->withInput();
        return view('cadastro.editarProduto', compact('produtos','resultado', 'id'));
        
    }
    public function atualizarProduto(Request $request, $id)
    {
        
        if(empty($request->Nome) || empty($request->Descricao) || empty($request->Preco) )
        {  
            $resultado = Produto::find($id);
            $erro = "Favor, preencher todos os campos do produto!";
            return view('cadastro.editarProduto', compact('erro','resultado','id'));
        }
        else
        {
            $resultado = Produto::find($id);
            DB::update('update produtos set Nome = ?, Descricao = ?, Preco = ? where Id = ?', [$request->Nome, $request->Descricao, $request->Preco, $id]);
            return redirect() ->route('hello.index');
        }
    }

    public function store(Request $request)
    {

        if(empty($request->Nome) || empty($request->Descricao) || empty($request->Preco) )
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
            $post->Nome = $request->Nome;
            $post->Descricao = $request->Descricao;
            $post->Preco = $request->Preco;
            //
            $post->save();

            return redirect() ->route('hello.index', compact('produtos', 'vendas'));
        }
    }
    public function deletarProduto($id)
    { 
        $Id = $id;
        $produtos = Produto::all();
        $vendas = Venda::all();
        DB::delete('delete from produtos where id = ?',[$id]);
        return redirect() ->route('hello.index', compact('produtos', 'vendas'));
    }
}

?>