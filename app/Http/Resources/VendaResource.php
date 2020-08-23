<?php

namespace App\Http\Resources;

use App\Http\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class VendaResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $helper = new Helper;

        $this->data_venda   = $this->data_venda != null ? $helper->formatarDataBr($this->data_venda) : null;
        $this->desconto     = $this->desconto != null ? $helper->formatarValorMoedaBr($this->desconto) : null;
        $this->somaValores  = $this->somaValores != null ? $helper->formatarValorMoedaBr($this->somaValores) : null;

        return [
            'idVenda'           => $this->id ?? null,
            'idProduto'         => $this->id_produto ?? null,
            'idCliente'         => $this->id_cliente ?? null,
            'dataVenda'         => $this->data_venda ?? null,
            'quantidadeVenda'   => $this->quantidade ?? null,
            'descontoVenda'     => $this->desconto ?? null,
            'statusVenda'       => $this->status ?? null,
            'valorVenda'        => $this->somaValores ?? null,
            'nomeProduto'       => $this->nomeProduto ?? null,
            'nomeCliente'       => $this->nomeCliente ?? null
        ];
    }
}
