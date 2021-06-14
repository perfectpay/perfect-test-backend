<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Usando os Modelos
use App\Produto;
use App\Usuario;
use App\Venda;

class SalesController extends Controller
{
    public function sales()
    {
        $produtos = Produto::all();

        return  view('crud_sales', ['produtos' => $produtos]);
    }
    public function store(Request $request)
    {
        /**
         * Aqui cadastramos os dados vindos do formulário no Banco de Dados
         */
        $usuario = new Usuario();
        $usuario->usuario_nome = $request->input('name');
        $usuario->email = $request->input('email');
        $usuario->cpf = $request->input('cpf');
        $usuario->save();

        $venda = new Venda();
        $venda->quantidadeProduto = $request->input('quantity');
        $venda->desconto = $request->input('discount');
        $venda->statusVenda = $request->input('status');
        $venda->produtoId = $request->input('product');

        //ajustando a data
        $dateAmericana = implode('-', array_reverse(explode('/', $request->input('date'))));

        $venda->dataVenda = $dateAmericana;
        $venda->usuarioId = $usuario->id;
        //calculando o valor da venda
        $precoProduto = Produto::find($request->input('product'));
        $precoProduto->preco;

        $valordaVenda = ($request->input('quantity') * $precoProduto->preco) - $request->input('discount');

        $venda->vendaValorTotal = $valordaVenda;
        $venda->save();

        return  view('crud_sales');
    }
    public function show($id, $produtoId, $usuarioId)
    {
        /**
         * Aqui recebemos o Id da venda,id do produto e id do usuario que iremos editar 
         * e encaminhamos o mesmo para view 
         * para preencher os values do formulario
         */
        $venda = Venda::find($id);
        $usuario = Usuario::find($usuarioId);
        $produto = Produto::find($produtoId);
        $produtos= Produto::all();
        return view('crud_sales',['venda' => $venda, 'usuario' => $usuario, 'produto' => $produto, 'produtos'=> $produtos]);
    }
    public function update(Request $request, $id, $produtoId, $usuarioId)
    {
        /**
         * Aqui atualiza o produto que já está Criado no Banco de Dados
         */
        $venda= Venda::find($id);
        $usuario= Usuario::find($usuarioId);
        $produto= Produto::find($produtoId);

        $usuario->update([
            'usuario_nome' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf
        ]);

        $venda->quantidadeProduto = $request->input('quantity');
        $venda->desconto = $request->input('discount');
        $venda->statusVenda = $request->input('status');
        $venda->produtoId = $request->input('product');
        //ajustando a data novamente
        $dateAmericana = implode('-', array_reverse(explode('/', $request->input('date'))));
        $venda->dataVenda = $dateAmericana;
        $venda->usuarioId = $usuario->id;
        //calculando o valor da venda novamente
        $precoProduto = Produto::find($request->input('product'));
        $precoProduto->preco;
        $valordaVenda = ($request->input('quantity') * $precoProduto->preco) - $request->input('discount');
        $venda->vendaValorTotal = $valordaVenda;
        $venda->save();
    
        return view('crud_sales');
    }
}
