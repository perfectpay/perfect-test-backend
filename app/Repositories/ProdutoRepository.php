<?php

namespace App\Repositories;

use App\Http\Models\ProdutoModel;

class ProdutoRepository
{
	private $model;

	public function __construct(ProdutoModel $model)
	{
		$this->model = $model;
	}

    public function listarProdutos(){
        $model = $this->model
        ->get();

        return $model;
    }

    public function detalharProduto($idProduto){
        $model = $this->model
        ->where('id', '=', $idProduto)
        ->first();

        return $model;
    }

	public function cadastrarProduto($produto){
		return $this->model->create([
            'nome'          => $produto['nomeProduto'],
            'descricao'     => $produto['descricaoProduto'],
            'preco'         => $produto['precoProduto'],
            'blob_imagem'   => $produto['blobImagemProduto'],
            'situacao'      => 'A'
        ]);
	}

	public function alterarProduto($produto){
		$model = $this->model
        ->where('id', '=', $produto['idProduto'])
        ->update([
            'nome'          => $produto['nomeProduto'],
            'descricao'     => $produto['descricaoProduto'],
            'preco'         => $produto['precoProduto'],
            'blob_imagem'   => $produto['blobImagemProduto'],
            'situacao'      => $produto['situacao']
        ]);

        return $model;
	}

	public function apagarProduto($produto){
		$model = $this->model
        ->where('id', '=', $produto['idProduto'])
        ->update([
            'situacao'  => $produto['situacao']
        ]);

        return $model;
	}
}
