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
            $produtos = new Produto();
            $produtos->Nome = $request->Nome;
            $produtos->Descricao = $request->Descricao;
            $produtos->Preco = $request->Preco;
            /* dd($request->all()); */
            $imagem = $request->file('image');
            /* dd($imagem); */
            /* dd($request->all()); */
            if(!empty($imagem)){
                $verificacao = $request->validate([
                    'image' => 'required|mimes:png,jpg,jpeg|max:2048'
                    ]);

                $imagem = $request->file('image')->getClientOriginalName();

                $extension = $request->file('image')->getClientOriginalExtension();
                
                // Filename to store
                $fileNameToStore= $request->Nome.'.'.$extension;
              
                // Upload Image
                $path = $request->file('image')->move('/img/', $fileNameToStore);           
             
            } else {
                $fileNameToStore = 'noimage.png';
            }
           /*  dd($request->all()); */
            $produtos->Imagem = $fileNameToStore;

            $produtos->save();
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