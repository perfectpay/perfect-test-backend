<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Retorna uma lista de produtos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', ['produtos'=>$produtos]);
    }

    /**
     * Retorna um formulário para criar um novo produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Persiste as informações do produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        $produto = new Produto();
        $produto->fill($request->all());
        $produto->setValorAttribute($request->preco);
        $produto->save();
        return redirect()->route('produto.index')->with(['color'=>'green', 'message'=>'cadastrado com sucesso']);;
    }

    /**
     * Retorna as informações do produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::where('id', $id)->first();
        return view('produtos.show', ['produto'=>$produto]);
    }

    /**
     * Retorna um formulário para editar um produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::find($id);
        return view('produtos.edit', ['produto'=>$produto]);
    }

    /**
     * Atualiza um produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, $id)
    {
        $produto = Produto::find($id);
        $produto->fill($request->all());
        $produto->setValorAttribute($request->preco);
        $produto->save();
        return redirect()->route('produto.index')->with(['color'=>'green', 'message'=>'atualizado com sucesso']);;
    }

    /**
     * Deleta um produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        return redirect()->route('produto.index')->with(['color'=>'green', 'message'=>'produto deletado']);
    }


    /**
     * Retorna busca de um produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function busca(Request $request)
    {
        $produto = Produto::where('nome', $request->value)->first();
        return $produto;
    }
}
