<?php

namespace App\Repositories;

use App\Http\Models\VendaModel;

class VendaRepository
{
	private $model;

	public function __construct(VendaModel $model)
	{
		$this->model = $model;
	}

    public function listarVendas(){
        $model = $this->model
        ->get();

        return $model;
    }

    public function detalharVenda($idVenda){
        $model = $this->model
        ->where('id', '=', $idVenda)
        ->first();

        return $model;
    }

	public function cadastrarVenda($venda){
		return $this->model->create([
            'id_produto'    => $venda['idProduto'],
            'id_cliente'    => $venda['idCliente'],
            'data_venda'    => $venda['dataVenda'],
            'quantidade'    => $venda['quantidadeVenda'],
            'desconto'      => $venda['descontoVenda'],
            'status'        => $venda['statusVenda']
        ]);
	}

	public function alterarVenda($venda){
		$model = $this->model
        ->where('id', '=', $venda['idVenda'])
        ->update([
            'id_produto'    => $venda['idProduto'],
            'id_cliente'    => $venda['idCliente'],
            'data_venda'    => $venda['dataVenda'],
            'quantidade'    => $venda['quantidadeVenda'],
            'desconto'      => $venda['descontoVenda'],
            'status'        => $venda['statusVenda']
        ]);

        return $model;
	}

	public function alterarStatusVenda($venda){
		$model = $this->model
        ->where('id', '=', $venda['idVenda'])
        ->update([
            'status' => $venda['statusVenda']
        ]);

        return $model;
	}
}
