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
        $produtos = Produto::all();
        $vendas = Venda::all();

        return view('hello.telaInicial', compact('produtos', 'vendas'));
            
    }

    public function cadastroVenda()
    {
        $produtos = Produto::all();
        return view('cadastro.cadastrarVenda', compact('produtos'));
            
    }

    public function storeVenda(Request $request)
    {

        $verificaEmail   = '@';
        $pos = strpos($request->email, $verificaEmail);
       
         if( empty($request->nome) || empty($request->email) || !$pos || empty($request->cpf) || empty($request->status) || $request->status == 'Escolha...' || empty($request->idProduto) || $request->idProduto == 'Escolha...' || empty($request->quantidade) || empty($request->desconto) || empty($request->updated_at) ) 
        {
            //
            back()->withInput();
            $produtos = Produto::all();
            $erro = "Favor, preencher todos os campos da venda.";

            if(!$pos)
            {
               $erro = "Favor, informe um email valido.";
            }

            return view('cadastro.cadastrarVenda', compact('erro', 'produtos'));       
             
        }
        else
        {
            $vendas = Venda::all();
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
            $vowels = array(".", "-");
            $real = array(",");
            
            $venda = new Venda();
            $venda->Nome = $request->nome;
            $venda->Email = $request->email;
            $venda->Cpf = str_replace($vowels, "", $request->cpf);
            $venda->Status = $request->status;
            $venda->IdProduto = $id;
            $venda->Quantidade = $request->quantidade;
            $venda->Desconto = str_replace($real,".", $request->desconto);
            $venda->updated_at = $request->updated_at;
            
            //
            $venda->save();
    
            return view('hello.telaInicial', compact('produtos', 'vendas'));
        }  
    }
}
