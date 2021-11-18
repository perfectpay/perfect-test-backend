<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Requests\VendaRequest;
use App\Produto;
use App\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    /**
     * Retorna uma lista de vendas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendas = Venda::with(['clientesVenda'])->get();
        return view('vendas.index', ['vendas'=>$vendas]);
    }

    /**
     * Retorna um formulário para criar uma venda.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::orderBy('name', 'asc')->get();
        $produtos = Produto::orderBy('nome', 'asc')->get();
        return view('vendas.create', ['clientes'=>$clientes, 'produtos'=>$produtos]);
    }

    /**
     * Persiste as informações da venda.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(VendaRequest $request)
    {
        $venda = Venda::create($request->all());
        $vendas = Venda::with(['produtosVenda', 'clientesVenda'])->get();
        return redirect()->route('venda.index',['vendas'=>$vendas])->with(['color'=>'green', 'message'=>'cadastrado com sucesso']);
    }

    /**
     * Retorna as informações da venda.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venda = Venda::where('id', $id)->with(['produtosVenda', 'clientesVenda'])->get();
        return view('vendas.show', ['venda'=>$venda]);
    }

    /**
     * Retorna um formulário para editar uma venda.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venda = Venda::where('id', $id)->with(['produtosVenda', 'clientesVenda'])->first();
        $produtos = Produto::all();
        return view('vendas.edit', ['venda'=>$venda, 'produtos'=>$produtos]);
    }

    /**
     * Atualiza uma venda.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(VendaRequest $request, $id)
    {
        $venda = Venda::find($id);
        $venda->fill($request->all());
        $venda->save();
        return redirect()->route('venda.index')->with(['color'=>'green', 'message'=>'atualizado com sucesso']);
    }

    /**
     * Deleta uma venda.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venda = Venda::find($id);
        $venda->delete();
        return redirect()->route('venda.index')->with(['color' => 'green', 'message' => 'venda deletada']);
    }

}
