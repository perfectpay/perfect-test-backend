<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendaController extends Controller
{
    /**
     * Retorna um formulário para criar uma venda.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud_sales');
    }

    /**
     * Retorna as informações da venda.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('crud_sales');
    }

    /**
     * Retorna um formulário para editar uma venda.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('crud_sales');
    }

    /**
     * Atualiza uma venda.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return view('crud_sales');
    }

    /**
     * Deleta uma venda.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
