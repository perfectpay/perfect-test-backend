<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venda;
class VendaController extends Controller
{
    public function index()
    {
        
        //$hello = 'Hello World!';
        return view('hello.telaInicial');
            
    }

    public function cadastroVenda()
    {
        
        return view('cadastro.cadastrarVenda');
            
    }

    public function storeVenda(Request $request)
    {

       
         if( empty($request->nome) || empty($request->email) || empty($request->cpf) || empty($request->status) || empty($request->idProduto) || empty($request->quantidade) || empty($request->desconto) || empty($request->updated_at) ) 
        {
            return back()->withInput();
        }
        else
        {

            $venda = new Venda();
            $venda->Nome = $request->nome;
            $venda->Email = $request->email;
            $venda->Cpf = $request->cpf;
            $venda->Status = $request->status;
            $venda->IdProduto = $request->idProduto;
            $venda->Quantidade = $request->quantidade;
            $venda->Desconto = $request->desconto;
            $venda->updated_at = $request->updated_at;
            
            //
            $venda->save();

            return view('cadastro.cadastrarVenda');
        }  
    }
}
