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
     * Retorna as informações do produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('crud_products');
    }

    /**
     * Retorna um formulário para editar um produto.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('crud_products');
    }
}
