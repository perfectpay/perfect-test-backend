<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    /**
     * Retorna uma lista de clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::select('id','name','email','cpf')->get();
        return view('cliente.index', ['clientes'=>$clientes]);
    }

    /**
     * Retorna um formulário para cadastrar um cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Persiste as informações do cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        $cliente = Cliente::create($request->all());
        return redirect()->route('cliente.index')->with(['color'=>'green', 'message'=>'cadastrado com sucesso']);
    }

    /**
     * Retorna as informações do cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::where('id',$id)->with(['vendasCliente','produtosCliente'])->first();
        return view('cliente.show', ['cliente'=>$cliente]);
    }

    /**
     * Retorna um formulário para editar um cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view('cliente.edit', ['cliente'=>$cliente]);
    }

    /**
     * Atualiza um cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->fill($request->all());
        $cliente->save();
        return redirect()->route('cliente.index')->with(['color'=>'green', 'message'=>'atualizado com sucesso']);
    }

    /**
     * Deleta um cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect()->route('cliente.index')->with(['color' => 'green', 'message' => 'cliente deletado']);
    }

    /**
     * Retorna busca de um cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function busca(Request $request)
    {
        $cliente = Cliente::where('name', $request->value)->first();
        return $cliente;
    }

}
