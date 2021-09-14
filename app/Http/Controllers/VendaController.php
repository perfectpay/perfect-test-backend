<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        return view('hello.index', compact('produtos', 'vendas'));
            
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
        return view('hello.index', compact('produtos', 'vendas','todasVendas'));
            
    }

    public function cadastroVenda()
    {
        $vendas = Venda::all();
        $produtos = Produto::all();

        back()->withInput();
        return view('cadastro.cadastrarVenda', compact('produtos'));
            
    }
    
    public function detalheVenda($id)
    {
        $resultado = Venda::find($id);
        $produtos = Produto::all();
   
        return view('cadastro.editarVenda', compact('produtos','resultado', 'id'));
        
    }
    public function atualizar(Request $request, $id)
    {

/* 
        dd($request->all());

 */
       
        $dados = $request->all();
   
        $produtoid = $dados['IdProduto'];
        $nomes = explode(" Descrição: ", $produtoid);

        $nomeProduto = $nomes[0];
        $nomeProduto = explode(": ", $nomeProduto);
        $nomeDescricao = $nomes[1];
       
        $idProduto = DB::table('produtos')->where('Nome', $nomeProduto[1])->where('Descricao', $nomeDescricao)->pluck('Id');
    
        $data = $request->updated_at;
        $vtdt = explode("/", $data);
        $data = $vtdt[2].'-'.$vtdt[1].'-'.$vtdt[0];
        $dados['updated_at'] = $data . " 00:00:00";
        $dados['idProduto'] = "$idProduto[0]"; 
       /*  dd($dados); */
       
        DB::update('update vendas set Nome = ?, Email = ?, Cpf = ?, IdProduto = ?, updated_at = ?, Quantidade = ?, Desconto = ?, Status = ? where Id = ?', [$dados['Nome'], $dados['Email'], $dados['Cpf'], $dados['idProduto'],$dados['idProduto'], $dados['updated_at'],$dados['Quantidade'],$dados['Desconto'], $dados['Status'], $id]);
       
        return redirect()->route('hello.index');

    }
    public function storeVenda(Request $request)
    {
        
        $verificaEmail   = '@';
        $pos = strpos($request->email, $verificaEmail);
       
         if( empty($request->nome) || empty($request->email) || !$pos || empty($request->cpf) || empty($request->status) || $request->status == 'Escolha...' || empty($request->idProduto) || $request->idProduto == 'Escolha...' || empty($request->quantidade) || empty($request->updated_at) ) 
        {
        
        
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
            $data = $request->updated_at;
            $vtdt = explode("/", $data);
            $data = $vtdt[2].'-'.$vtdt[1].'-'.$vtdt[0];
            $dados['updated_at'] = $data . " 00:00:00";
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

            $venda->updated_at = $dados['updated_at'];
            back()->withInput();
            
            $venda->save();
            
            return redirect() ->route('hello.index', compact('produtos', 'vendas'));
        }  
    }
}
