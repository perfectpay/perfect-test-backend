<?php

namespace App\Repositories;

use App\Http\Models\VendaModel;
use Illuminate\Support\Facades\DB;

class VendaRepository
{
	private $model;

	public function __construct(VendaModel $model)
	{
		$this->model = $model;
	}

    public function listarVendas(){
        $model = $this->model
        ->join('produto', 'venda.id_produto', '=', 'produto.id')
        ->groupBy('venda.id')
        ->selectRaw('(preco * SUM(quantidade)) - SUM(desconto) as somaValores, venda.id, venda.id_produto, venda.id_cliente, venda.data_venda, venda.quantidade, venda.desconto, venda.status')
        ->get();

        return $model;
    }

    public function detalharVenda($idVenda){
        $model = $this->model
        ->where('venda.id', '=', $idVenda)
        ->join('produto', 'venda.id_produto', '=', 'produto.id')
        ->groupBy('venda.id')
        ->selectRaw('(preco * SUM(quantidade)) - SUM(desconto) as somaValores, venda.id, venda.id_produto, venda.id_cliente, venda.data_venda, venda.quantidade, venda.desconto, venda.status')
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

    public function gerarRelatorioResultadoVendas(){
        // SELECT COUNT(*), v.status, SUM(v.quantidade) as quant, (p.preco * SUM(v.quantidade)) - SUM(v.desconto) as valorTotal FROM `venda` v, produto p WHERE v.id_produto = p.id GROUP BY status
        $model = DB::table('venda')
        ->join('produto', 'venda.id_produto', '=', 'produto.id')
        ->groupByRaw('status')
        ->selectRaw('COUNT(*) as quantidadeVendas, status, SUM(quantidade) as somaItens, (preco * SUM(quantidade)) - SUM(desconto) as somaValores')
        ->get();

        return $model;
    }
}
