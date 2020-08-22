<?php

namespace App\Http\Services;

use App\Http\Helper;
use App\Http\Resources\ClienteResource;
use App\Repositories\ClienteRepository;
use Exception;

class ClienteService
{
    protected $repository;
    protected $helper;

    public function __construct(ClienteRepository $repository){
        $this->repository   = $repository;
        $this->helper       = new Helper();
    }

    public function listarClientes($dados){
        try{
            $clientes = $this->repository->listarClientes();

            if(empty($clientes)){
                return [
                    'success'   => true,
                    'message'   => 'Nenhum cliente encontrado.',
                    'data'      => []
                ];
            }

            return [
                'success'   => true,
                'message'   => 'Clientes listados com sucesso',
                'data'      => ClienteResource::collection($clientes)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao listar os clientes. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function detalharCliente($dados){
        try{
            $idCliente = $dados['idCliente'] ?? null;

            $cliente = $this->repository->detalharCliente($idCliente);

            if(empty($cliente)){
                return [
                    'success'   => true,
                    'message'   => 'Nenhum cliente encontrado.',
                    'data'      => []
                ];
            }

            return [
                'success'   => true,
                'message'   => 'Cliente detalhado com sucesso',
                'data'      => ClienteResource::make($cliente)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao detalhar o cliente. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function cadastrarCliente($dados){
        try{
            // Obs.: Não está sendo feita nenhuma verificação mais profunda, como por exemplo tamanho do cpf, se o cpf é válido, se todos os campos estão sendo preenchidos, se o email digitado realmente está no formato de email, etc.
            $dados = $this->formatarDadosCliente($dados);

            $cliente = $this->repository->cadastrarCliente($dados);

            return [
                'success'   => true,
                'message'   => 'Cliente cadastrado com sucesso',
                'data'      => ClienteResource::make($cliente)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao cadastrar o Cliente. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function alterarCliente($dados){
        try{
            // Obs.: Não está sendo feita nenhuma verificação mais profunda, como por exemplo tamanho do cpf, se o cpf é válido, se todos os campos estão sendo preenchidos, se o email digitado realmente está no formato de email, etc.
            $dados = $this->formatarDadosCliente($dados);

            $this->repository->alterarCliente($dados);

            $clienteAlterado = $this->repository->detalharCliente($dados['idCliente']);

            return [
                'success'   => true,
                'message'   => 'Cliente alterado com sucesso',
                'data'      => ClienteResource::make($clienteAlterado)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao alterar o cliente. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function apagarCliente($dados){
        try{
            // Obs.: Não está sendo feita nenhuma verificação mais profunda, como por exemplo tamanho do cpf, se o cpf é válido, se todos os campos estão sendo preenchidos, se o email digitado realmente está no formato de email, etc.

            if(!isset($dados['idCliente']) || $dados['idCliente'] == null){
                return [
                    'success'   => false,
                    'message'   => "Informe um ID de Cliente",
                    'data'      => []
                ];
            }

            $dados['situacao'] = "I";

            $this->repository->apagarCliente($dados);

            $clienteAlterado = $this->repository->detalharCliente($dados['idCliente']);

            return [
                'success'   => true,
                'message'   => 'Cliente inativado com sucesso',
                'data'      => ClienteResource::make($clienteAlterado)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao inativar o cliente. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function formatarDadosCliente($cliente){
        return [
            'idCliente'     => $cliente['idCliente'] ?? null,
            'nomeCliente'   => $cliente['nomeCliente'] ?? null,
            'emailCliente'  => $cliente['emailCliente'] ?? null,
            'cpfCliente'    => $this->helper->filtrarSomenteNumeros($cliente['cpfCliente']) ?? null,
            'situacao'      => $cliente['situacao'] ?? null,
        ];
    }
}
