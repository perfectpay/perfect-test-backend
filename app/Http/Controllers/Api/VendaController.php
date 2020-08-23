<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\VendaService;

class VendaController extends Controller
{
    protected $service;

    public function __construct(VendaService $service){
        $this->service = $service;
    }

    public function listarVendas(Request $request){
        $dados = $request->all();
        return $this->service->listarVendas($dados);
    }

    public function detalharVenda(Request $request){
        $dados = $request->all();
        return $this->service->detalharVenda($dados);
    }

    public function cadastrarVenda(Request $request){
        $dados = $request->all();
        return $this->service->cadastrarVenda($dados);
    }

    public function alterarVenda(Request $request){
        $dados = $request->all();
        return $this->service->alterarVenda($dados);
    }

    public function cancelarVenda(Request $request){
        $dados = $request->all();
        return $this->service->cancelarVenda($dados);
    }
}
