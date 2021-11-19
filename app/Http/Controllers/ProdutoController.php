<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Produto;
use App\ProdutoImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        if (!empty($request->allFiles()['arquivos'])) {
            foreach ($request->allFiles()['arquivos'] as $file) {
                $images = new ProdutoImages();
                $images->produto_id = $produto->id;
                $images->path = $file->storeAs('images', $file->getClientOriginalName());
                $images->save();
                unset($images);
            }
        }
        return redirect()->route('produto.index')->with(['color'=>'green', 'message'=>'cadastrado com sucesso']);;
    }

    /**
     * Retorna as informações do produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::where('id', $id)->with('imagesProduto')->first();
        return view('produtos.show', ['produto'=>$produto]);
    }

    /**
     * Retorna um formulário para editar um produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::where('id', $id)->with('imagesProduto')->first();
        return view('produtos.edit', ['produto'=>$produto]);
    }

    /**
     * Atualiza um produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, $id)
    {
        $produto = Produto::where('id', $id)->first();
        $produto->fill($request->all());
        $produto->setValorAttribute($request->preco);
        $produto->save();
        if (!empty($request->allFiles()['arquivos'])) {
            foreach ($request->allFiles()['arquivos'] as $file) {
                $images = new ProdutoImages();
                $images->produto_id = $produto->id;
                $images->path = $file->storeAs('images', $file->getClientOriginalName());
                $images->save();
                unset($images);
            }
        }
        return redirect()->route('produto.index')->with(['color'=>'green', 'message'=>'atualizado com sucesso']);;
    }

    /**
     * Deleta um produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::where('id', $id)->with('imagesProduto')->first();
        if (!empty($produto)){
            foreach ($produto->imagesProduto as $image){
                $this->imageDelete($image->id);
            }
            $produto->delete();
            return redirect()->route('produto.index')->with(['color'=>'green', 'message'=>'produto deletado']);
        }
        return back()->with(['color' => 'orange', 'message' => 'Não encontrado!']);
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

    /**
     * Deleta um produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageDelete($id)
    {
        $image = ProdutoImages::find($id);
        Storage::delete($image->path);
        $image->delete();
        return back()->with(['color' => 'green', 'message' => 'Arquivo deletado!']);
    }
}
