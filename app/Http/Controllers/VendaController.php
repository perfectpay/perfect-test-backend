<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Venda;
use App\Produto;

class VendaController extends Controller
{

   
    public function index()
    {
        
        //$hello = 'Hello World!';
        $produtos = Produto::all();
        $vendas = Venda::all();
        back()->withInput();
        //view('hello.telaInicial', $produtos, $vendas);
        return view('hello.telaInicial', compact('produtos', 'vendas'));
            
    }
    public function indexPesquisa(Request $request)
    {
        
        $datas = $request->datas;
        $cliente = $request->inlineFormInputName;
        $datas = explode("-", $datas);
        $data1 = preg_replace("/[^0-9]/"," ",$datas[0]);
        $data2 = preg_replace("/[^0-9]/"," ",$datas[1]);
                
        
        $vtdt1 = explode(' ', $data1);
        $data1 = $vtdt1[2].'-'.$vtdt1[1].'-'.$vtdt1[0];
        $data2 = substr($data2,1);
        $vtdt2 = explode(' ', $data2);
        
        $data2 = $vtdt2[2].'-'.$vtdt2[1].'-'.$vtdt2[0];
        $id = DB::table('vendas')->where('Nome', $cliente)->pluck('Id');
        $venda = array();
        
        foreach ($id as $ids ) {
            $vendas = Venda::find($id);
        }
        $todasVendas = Venda::all();

         $produtos = Produto::all(); 

        back()->withInput();
        //view('hello.telaInicial', $produtos, $vendas);
        return view('hello.telaInicial', compact('produtos', 'vendas','todasVendas'));
            
    }

    public function cadastroVenda()
    {
        $vendas = Venda::all();
        $produtos = Produto::all();
        $id = 1;
        back()->withInput();
        return view('cadastro.cadastrarVenda', compact('produtos', 'id'));
            
    }
    
    public function detalheVenda($id)
    {
        $resultado = Venda::find($id);
        $produtos = Produto::all();
   
        return view('cadastro.cadastrarVenda', compact('produtos','resultado'));
        
    }
    public function atualizarVenda(Request $request, $id)
    {
       
        /* dd($_SERVER); */
        $idVenda = preg_replace("/[^0-9]/","", $_SERVER['PATH_INFO']);
        $venda = Venda::find($idVenda);
        
        /* dd($dados); */
      /*   $produto->update($dados);
        $produto->categorias()->sync($dados['categoria_id']); */
        $produtos = Produto::all();
        $resultado = Venda::find($idVenda);
        
        return view('hello.telaInicial', compact('produtos', 'idVenda','resultado'));
        
    }
    public function storeVenda(Request $request)
    {
        
        $verificaEmail   = '@';
        $pos = strpos($request->email, $verificaEmail);
       
         if( empty($request->nome) || empty($request->email) || !$pos || empty($request->cpf) || empty($request->status) || $request->status == 'Escolha...' || empty($request->idProduto) || $request->idProduto == 'Escolha...' || empty($request->quantidade) || empty($request->updated_at) ) 
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
            $vowels = array(".", "-",",");
            
            $venda = new Venda();
            $venda->Nome = $request->nome;
            $venda->Email = $request->email;
            $venda->Cpf = str_replace($vowels, "", $request->cpf);
            $venda->Status = $request->status;
            $venda->IdProduto = $id;
            $venda->Quantidade = $request->quantidade;
            $venda->Desconto = str_replace($vowels,".", $request->desconto);
            $venda->updated_at = $request->updated_at;
            back()->withInput();
            //
            $venda->save();
            
            return view('hello.telaInicial', compact('produtos', 'vendas'));
        }  
    }
}
