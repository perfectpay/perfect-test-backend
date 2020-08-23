<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\ClienteService;

class ClienteController extends Controller
{
    protected $service;

    public function __construct(ClienteService $service){
        $this->service = $service;
    }

    public function listarClientes(Request $request){
        $dados = $request->all();
        return $this->service->listarClientes($dados);
    }

    public function detalharCliente(Request $request){
        $dados = $request->all();
        return $this->service->detalharCliente($dados);
    }

    public function cadastrarCliente(Request $request){
        $dados = $request->all();
        return $this->service->cadastrarCliente($dados);
    }

    public function alterarCliente(Request $request){
        $dados = $request->all();
        return $this->service->alterarCliente($dados);
    }

    public function apagarCliente(Request $request){
        $dados = $request->all();
        return $this->service->apagarCliente($dados);
    }
}
