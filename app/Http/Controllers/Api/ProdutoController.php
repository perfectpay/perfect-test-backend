<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\ProdutoService;

class ProdutoController extends Controller
{
    protected $service;

    public function __construct(ProdutoService $service){
        $this->service = $service;
    }

    public function listarProdutos(Request $request){
        $dados = $request->all();
        return $this->service->listarProdutos($dados);
    }

    public function detalharProduto(Request $request){
        $dados = $request->all();
        return $this->service->detalharProduto($dados);
    }

    public function cadastrarProduto(Request $request){
        $dados = $request->all();
        return $this->service->cadastrarProduto($dados);
    }

    public function alterarProduto(Request $request){
        $dados = $request->all();
        return $this->service->alterarProduto($dados);
    }

    public function apagarProduto(Request $request){
        $dados = $request->all();
        return $this->service->apagarProduto($dados);
    }
}
