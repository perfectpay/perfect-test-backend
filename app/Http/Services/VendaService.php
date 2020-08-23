<?php

namespace App\Http\Services;

use App\Http\Helper;
use App\Http\Resources\VendaResource;
use App\Repositories\VendaRepository;
use Exception;

class VendaService
{
    protected $repository;
    protected $helper;
    protected $produtoService;
    protected $clienteService;

    public function __construct(VendaRepository $repository, ProdutoService $produtoService, ClienteService $clienteService){
        $this->repository       = $repository;
        $this->produtoService   = $produtoService;
        $this->clienteService   = $clienteService;
        $this->helper           = new Helper();
    }

    public function listarVendas($dados){
        try{
            $vendas = $this->repository->listarVendas();

            if(empty($vendas)){
                return [
                    'success'   => true,
                    'message'   => 'Nenhuma venda encontrada.',
                    'data'      => []
                ];
            }

            foreach($vendas as $venda){
                $venda->nomeProduto = $this->buscarNomeProduto($venda->id_produto);
                $venda->nomeCliente = $this->buscarNomeCliente($venda->id_cliente);
            }

            return [
                'success'   => true,
                'message'   => 'Vendas listadas com sucesso',
                'data'      => VendaResource::collection($vendas)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao listar as vendas. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function detalharVenda($dados){
        try{
            $idVenda = $dados['idVenda'] ?? null;

            $venda = $this->repository->detalharVenda($idVenda);

            if(empty($venda)){
                return [
                    'success'   => true,
                    'message'   => 'Nenhuma venda encontrada.',
                    'data'      => []
                ];
            }

            $venda->nomeProduto = $this->buscarNomeProduto($venda->id_produto);
            $venda->nomeCliente = $this->buscarNomeCliente($venda->id_cliente);

            return [
                'success'   => true,
                'message'   => 'Venda detalhado com sucesso',
                'data'      => VendaResource::make($venda)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao detalhar a venda. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function cadastrarVenda($dados){
        try{
            // Obs.: Não está sendo feita nenhuma verificação mais profunda, como por exemplo se o desconto é válido, se todos os campos estão sendo preenchidos, etc.
            $dados = $this->formatarDadosVenda($dados);

            $venda = $this->repository->cadastrarVenda($dados);

            $vendaCadastrada = $this->repository->detalharVenda($venda->id);

            $vendaCadastrada->nomeProduto = $this->buscarNomeProduto($vendaCadastrada->id_produto);
            $vendaCadastrada->nomeCliente = $this->buscarNomeCliente($vendaCadastrada->id_cliente);

            return [
                'success'   => true,
                'message'   => 'Venda cadastrada com sucesso',
                'data'      => VendaResource::make($vendaCadastrada)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao cadastrar a venda. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function alterarVenda($dados){
        try{
            // Obs.: Não está sendo feita nenhuma verificação mais profunda, como por exemplo se o desconto é válido, se todos os campos estão sendo preenchidos, etc.
            $dados = $this->formatarDadosVenda($dados);

            $this->repository->alterarVenda($dados);

            $vendaAlterada = $this->repository->detalharVenda($dados['idVenda']);

            $vendaAlterada->nomeProduto = $this->buscarNomeProduto($vendaAlterada->id_produto);
            $vendaAlterada->nomeCliente = $this->buscarNomeCliente($vendaAlterada->id_cliente);

            return [
                'success'   => true,
                'message'   => 'Venda alterada com sucesso',
                'data'      => VendaResource::make($vendaAlterada)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao alterar a venda. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function cancelarVenda($dados){
        try{
            // Obs.: Não está sendo feita nenhuma verificação mais profunda, como por exemplo se o desconto é válido, se todos os campos estão sendo preenchidos, etc.

            $dados['statusVenda'] = "Cancelado";

            $this->repository->alterarStatusVenda($dados);

            $vendaCancelada = $this->repository->detalharVenda($dados['idVenda']);

            $vendaCancelada->nomeProduto = $this->buscarNomeProduto($vendaCancelada->id_produto);
            $vendaCancelada->nomeCliente = $this->buscarNomeCliente($vendaCancelada->id_cliente);

            return [
                'success'   => true,
                'message'   => 'Venda cancelada com sucesso',
                'data'      => VendaResource::make($vendaCancelada)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao cancelar a venda. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function gerarRelatorioResultadoVendas($dados){
        try{
            $vendas = $this->repository->gerarRelatorioResultadoVendas();

            if(empty($vendas)){
                return [
                    'success'   => true,
                    'message'   => 'Nenhuma venda encontrada.',
                    'data'      => []
                ];
            }

            $vendasAux = [];

            foreach($vendas as &$venda){
                $venda->somaValores = $this->helper->formatarValorMoedaBr($venda->somaValores);

                $venda = collect($venda);
                $venda = $venda->toArray($venda);

                array_push($vendasAux, $venda);
            }

            return [
                'success'   => true,
                'message'   => 'Relatório de vendas gerado com sucesso.',
                'data'      => $vendasAux
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao gerar relatório de vendas. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function buscarNomeProduto($idProduto){
        $dadosProduto = [
            'idProduto' => $idProduto
        ];

        $produto            = $this->produtoService->detalharProduto($dadosProduto);
        $produto['data']    = collect ($produto['data']);

        return $produto['data']['nomeProduto'] ?? null;
    }

    public function buscarNomeCliente($idCliente){
        $dadosCliente = [
            'idCliente' => $idCliente
        ];

        $cliente            = $this->clienteService->detalharCliente($dadosCliente);
        $cliente['data']    = collect ($cliente['data']);

        return $cliente['data']['nomeCliente'] ?? null;
    }

    public function formatarDadosVenda($venda){
        return [
            'idVenda'           => $venda['idVenda'] ?? null,
            'idCliente'         => $venda['idCliente'] ?? null,
            'idProduto'         => $venda['idProduto'] ?? null,
            'dataVenda'         => isset($venda['dataVenda']) && $venda['dataVenda'] != null ? $this->helper->formatarDataBanco($venda['dataVenda']) : null,
            'quantidadeVenda'   => $venda['quantidadeVenda'] ?? null,
            'descontoVenda'     => $this->helper->numeroFormatoBrParaSql($venda['descontoVenda']) ?? null,
            'statusVenda'       => $venda['statusVenda'] ?? null,
        ];
    }
}
