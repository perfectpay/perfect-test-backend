<?php

namespace App\Http\Controllers;

use App\Http\Services\ClienteService;
use App\Http\Services\ProdutoService;
use App\Http\Services\VendaService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $clienteService;
    protected $produtoService;
    protected $vendaService;

    public function __construct(ClienteService $clienteService, ProdutoService $produtoService, VendaService $vendaService){
        $this->clienteService   = $clienteService;
        $this->produtoService   = $produtoService;
        $this->vendaService     = $vendaService;
    }

    public function carregarInformacoes(Request $request){
        $clientes           = $this->clienteService->listarClientes($request);
        $produtos           = $this->produtoService->listarProdutos($request);
        $vendas             = $this->vendaService->listarVendas($request);
        $relatorioVendas    = $this->vendaService->gerarRelatorioResultadoVendas($request);

        $clientes['data']           = collect($clientes['data']);
        $produtos['data']           = collect($produtos['data']);
        $vendas['data']             = collect($vendas['data']);
        $relatorioVendas['data']    = collect($relatorioVendas['data']);

        return view('dashboard', [
            'clientes'          => $clientes['data'],
            'produtos'          => $produtos['data'],
            'vendas'            => $vendas['data'],
            'relatorioVendas'   => $relatorioVendas['data'],
        ]);
    }
}
