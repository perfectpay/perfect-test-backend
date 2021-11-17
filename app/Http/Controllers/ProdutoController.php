<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Retorna um formulário para criar um novo produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud_products');
    }

    /**
     * Persiste as informações do produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return view('crud_products');
    }

    /**
     * Retorna as informações do produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('crud_products');
    }

    /**
     * Retorna um formulário para editar um produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('crud_products');
    }

    /**
     * Atualiza um produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return view('crud_products');
    }

    /**
     * Deleta um produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
