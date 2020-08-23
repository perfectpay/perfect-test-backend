<?php

namespace App\Http\Services;

use App\Http\Helper;
use App\Http\Resources\ProdutoResource;
use App\Repositories\ProdutoRepository;
use Exception;

class ProdutoService
{
    protected $repository;
    protected $helper;

    public function __construct(ProdutoRepository $repository){
        $this->repository   = $repository;
        $this->helper       = new Helper();
    }

    public function listarProdutos($dados){
        try{
            $produtos = $this->repository->listarProdutos();

            if(empty($produtos)){
                return [
                    'success'   => true,
                    'message'   => 'Nenhum produto encontrado.',
                    'data'      => []
                ];
            }

            return [
                'success'   => true,
                'message'   => 'Produtos listados com sucesso',
                'data'      => ProdutoResource::collection($produtos)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao listar os produtos. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function detalharProduto($dados){
        try{
            $idProduto = $dados['idProduto'] ?? null;

            $produto = $this->repository->detalharProduto($idProduto);

            if(empty($produto)){
                return [
                    'success'   => true,
                    'message'   => 'Nenhum produto encontrado.',
                    'data'      => []
                ];
            }

            return [
                'success'   => true,
                'message'   => 'Produto detalhado com sucesso',
                'data'      => ProdutoResource::make($produto)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao detalhar o produto. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function cadastrarProduto($dados){
        try{
            // Obs.: Não está sendo feita nenhuma verificação mais profunda, como por exemplo tipo de arquivo (se é imagem ou não), se o preço é válido, se todos os campos estão sendo preenchidos, etc.
            $dados = $this->formatarDadosProduto($dados);

            $produto = $this->repository->cadastrarProduto($dados);

            return [
                'success'   => true,
                'message'   => 'Produto cadastrado com sucesso',
                'data'      => ProdutoResource::make($produto)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao cadastrar o produto. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function alterarProduto($dados){
        try{
            // Obs.: Não está sendo feita nenhuma verificação mais profunda, como por exemplo tipo de arquivo (se é imagem ou não), se o preço é válido, se todos os campos estão sendo preenchidos, etc.
            $dados = $this->formatarDadosProduto($dados);

            $this->repository->alterarProduto($dados);

            $produtoAlterado = $this->repository->detalharProduto($dados['idProduto']);

            return [
                'success'   => true,
                'message'   => 'Produto alterado com sucesso',
                'data'      => ProdutoResource::make($produtoAlterado)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao alterar o produto. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function apagarProduto($dados){
        try{
            // Obs.: Não está sendo feita nenhuma verificação mais profunda, como por exemplo tamanho do cpf, se o cpf é válido, se todos os campos estão sendo preenchidos, se o email digitado realmente está no formato de email, etc.

            $dados['situacao'] = "I";

            $this->repository->apagarProduto($dados);

            $produtoAlterado = $this->repository->detalharProduto($dados['idProduto']);

            return [
                'success'   => true,
                'message'   => 'Produto inativado com sucesso',
                'data'      => ProdutoResource::make($produtoAlterado)
            ];

        } catch(Exception $e){
            return [
                'success'   => false,
                'message'   => 'Falha ao inativar o produto. Erro: ' . $e->getMessage(),
                'data'      => []
            ];
        }
    }

    public function formatarDadosProduto($produto){
        return [
            'idProduto'         => $produto['idProduto'] ?? null,
            'nomeProduto'       => $produto['nomeProduto'] ?? null,
            'descricaoProduto'  => $produto['descricaoProduto'] ?? null,
            'precoProduto'      => $this->helper->numeroFormatoBrParaSql($produto['precoProduto']) ?? null,
            'blobImagemProduto' => $produto['blobImagemProduto'] ?? null,
            'situacao'          => $produto['situacao'] ?? null,
        ];
    }
}
