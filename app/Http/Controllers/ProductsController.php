<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Usando os Modelos
use App\Produto;

use function GuzzleHttp\Promise\all;

class ProductsController extends Controller
{
    public function products()
    {
        /**
         * Aqui retornamos a view que contem um formulario
         * para cadastrar um novo produto
         */
        return  view('crud_products');
    }
    public function store(Request $request)
    {
        /**
         * Aqui Cadastramos um novo Produto, com os dados vindos do formulário
         */
        Produto::create
        ([
            'produto_nome' => $request->name_product,
            'descricao' => $request->description,
            'preco' => $request->price,
        ]);

        return view('crud_products');
    }
    public function show($id)
    {
        /**
         * Aqui recebemos o Id do produto que iremos editar 
         * e encaminhamos o mesmo para view 
         * para preencher os values do formulario
         */
        $produto= Produto::find($id);
        return view('crud_products',['produto' => $produto]);
    }
    public function update(Request $request, $id)
    {
        /**
         * Aqui atualiza o produto que já está Criado no Banco de Dados
         */
        $produto= Produto::find($id);
        $produto->update
        ([
            'produto_nome' => $request->input('name_product'),
            'descricao' => $request->input('description'),
            'preco' => $request->input('price'),
        ]);

        return view('crud_products');
    }
}
