<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venda;
use App\Produto;

class VendaController extends Controller
{

   
    public function index()
    {
        
        //$hello = 'Hello World!';
        return view('hello.telaInicial');
            
    }

    public function cadastroVenda()
    {
        $produtos = Produto::all();
        return view('cadastro.cadastrarVenda', compact('produtos'));
            
    }

    public function storeVenda(Request $request)
    {

       
         if( empty($request->nome) || empty($request->email) || empty($request->cpf) || empty($request->status) || empty($request->idProduto) /* || $request->idProduto == 'Escolha...' */ || empty($request->quantidade) || empty($request->desconto) || empty($request->updated_at) ) 
        {
            //
            back()->withInput();
            $produtos = Produto::all();
            $erro = "Favor, preencher todos os campos da venda.";
            return view('cadastro.cadastrarVenda', compact('erro', 'produtos'));
            
               
             
        }
        else
        {
            $produtos = Produto::all();
            $tamanhoProduto = count($produtos);
                
            for($i = 0; $i < $tamanhoProduto; $i++)
            {
                $resultado = strstr($request->idProduto, $produtos[$i]->Descricao);
               
                 if($produtos[$i]->Descricao == $resultado)
                {
                    $id = $produtos[$i]->Id;
                } 
            }
            

            $venda = new Venda();
            $venda->Nome = $request->nome;
            $venda->Email = $request->email;
            $venda->Cpf = $request->cpf;
            $venda->Status = $request->status;
            $venda->IdProduto = $id;
            $venda->Quantidade = $request->quantidade;
            $venda->Desconto = $request->desconto;
            $venda->updated_at = $request->updated_at;
            
            //
            $venda->save();

            
            return view('cadastro.cadastrarVenda', compact('produtos'));
        }  
    }
}
