<?php

namespace App\Http\Controllers;

use App\Http\Services\ClienteService;
use App\Http\Services\ProdutoService;
use App\Http\Services\VendaService;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    protected $vendaService;
    protected $clienteService;
    protected $produtoService;

    public function __construct(VendaService $vendaService, ClienteService $clienteService, ProdutoService $produtoService){
        $this->vendaService     = $vendaService;
        $this->clienteService   = $clienteService;
        $this->produtoService   = $produtoService;
    }

    public function carregarInformacoesVenda(Request $request){
        $produtos = $this->produtoService->listarProdutos($request);

        $produtos['data'] = collect($produtos['data']);

        return view('cadastrar_venda',[
            'produtos' => $produtos['data']
        ]);
    }

    public function cadastrarVenda(Request $request){
        $dados = $request->all();

        $dados['status'] = $dados['status'] == "Aprovado" ? "Vendido" : $dados['status'];

        $cliente = [
            'nomeCliente'   => $dados['name'],
            'emailCliente'  => $dados['email'],
            'cpfCliente'    => $dados['cpf'],
        ];

        $resultadoCliente           = $this->clienteService->cadastrarCliente($cliente);
        $resultadoCliente['data']   = collect($resultadoCliente['data']);

        if(!$resultadoCliente['success']){
            return redirect('/');
        }

        $venda = [
            'idCliente'         => $resultadoCliente['data']['idCliente'],
            'idProduto'         => $dados['product'],
            'dataVenda'         => $dados['date'] . ' ' . date('H:i:s'),
            'quantidadeVenda'   => $dados['quantity'],
            'descontoVenda'     => $dados['discount'],
            'statusVenda'       => $dados['status'],
        ];

        // Essa chamada poderia ser feita via requisição, pra de fato ser a comunicação com uma api, mas como o backend está no mesmo projeto, estou chamando o service mesmo.
        // Em um sistema mais completo também poderia ser feito um tratamento de erro adequado conforme a resposta do backend, e mostrar na tela o erro que deu de acordo com  a resposta da api
        $resultado = $this->vendaService->cadastrarVenda($venda);

        return redirect('/');
    }

    public function detalharVenda($idVenda){
        $dadosVenda = [
            'idVenda' => $idVenda
        ];

        $venda = $this->vendaService->detalharVenda($dadosVenda);
        $venda['data'] = collect($venda['data']);

        $produtos = $this->produtoService->listarProdutos($dadosVenda);
        $produtos['data'] = collect($produtos['data']);

        $dadosCliente = [
            'idCliente' => $venda['data']['idCliente']
        ];

        $cliente = $this->clienteService->detalharCliente($dadosCliente);
        $cliente['data'] = collect($cliente['data']);

        return view('detalhar_venda', [
            'venda'     => $venda['data'],
            'produtos'  => $produtos['data'],
            'cliente'   => $cliente['data']
        ]);
    }

    public function alterarVenda(Request $request){
        $dados = $request->all();

        $venda = [
            'idVenda'           => $dados['idVenda'],
            'idCliente'         => $dados['idCliente'],
            'idProduto'         => $dados['product'],
            'dataVenda'         => $dados['date'] . ' ' . date('H:i:s'),
            'quantidadeVenda'   => $dados['quantity'],
            'descontoVenda'     => $dados['discount'],
            'statusVenda'       => $dados['status'],
        ];

        // Essa chamada poderia ser feita via requisição, pra de fato ser a comunicação com uma api, mas como o backend está no mesmo projeto, estou chamando o service mesmo.
        // Em um sistema mais completo também poderia ser feito um tratamento de erro adequado conforme a resposta do backend, e mostrar na tela o erro que deu de acordo com  a resposta da api
        $resultado = $this->vendaService->alterarVenda($venda);

        return redirect('/sales/detalhar/' . $dados['idVenda']);
    }
}
