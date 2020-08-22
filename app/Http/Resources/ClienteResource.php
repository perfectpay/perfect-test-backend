<?php

namespace App\Http\Resources;

use App\Http\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
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

        $this->cpf = $this->cpf != null ? $helper->formatarCpfCnpj($this->cpf) : null;

        return [
            'idCliente'     => $this->id ?? null,
            'nomeCliente'   => $this->nome ?? null,
            'emailCliente'  => $this->email ?? null,
            'cpfCliente'    => $this->cpf ?? null,
            'situacao'      => $this->situacao ?? null
        ];
    }
}
