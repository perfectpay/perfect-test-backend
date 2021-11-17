<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Retorna um formulário para cadastrar um cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud_clientes');
    }

    /**
     * Retorna as informações do cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('crud_clientes');
    }

    /**
     * Retorna um formulário para editar um cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('crud_clientes');
    }

    /**
     * Atualiza um cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return view('crud_sales');
    }

    /**
     * Deleta um cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
