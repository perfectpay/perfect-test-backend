<?php

namespace App\Http\Resources;

use App\Http\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
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

        $this->preco = $this->preco != null ? $helper->formatarValorMoedaBr($this->preco) : null;

        return [
            'idProduto'         => $this->id ?? null,
            'nomeProduto'       => $this->nome ?? null,
            'descricaoProduto'  => $this->descricao ?? null,
            'precoProduto'      => $this->preco ?? null,
            'blobImagemProduto' => $this->blob_imagem ?? null,
            'situacao'          => $this->situacao ?? null
        ];
    }
}
