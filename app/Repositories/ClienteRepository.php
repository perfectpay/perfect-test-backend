<?php

namespace App\Repositories;

use App\Http\Models\ClienteModel;

class ClienteRepository
{
	private $model;

	public function __construct(ClienteModel $model)
	{
		$this->model = $model;
	}

    public function listarClientes(){
        $model = $this->model
        ->get();

        return $model;
    }

    public function detalharCliente($idCliente){
        $model = $this->model
        ->where('id', '=', $idCliente)
        ->first();

        return $model;
    }

	public function cadastrarCliente($cliente){
		return $this->model->create([
            'nome'      => $cliente['nomeCliente'],
            'email'     => $cliente['emailCliente'],
            'cpf'       => $cliente['cpfCliente'],
            'situacao'  => 'A'
        ]);
	}

	public function alterarCliente($cliente){
		$model = $this->model
        ->where('id', '=', $cliente['idCliente'])
        ->update([
            'nome'      => $cliente['nomeCliente'],
            'email'     => $cliente['emailCliente'],
            'cpf'       => $cliente['cpfCliente'],
            'situacao'  => $cliente['situacao']
        ]);

        return $model;
	}

	public function apagarCliente($cliente){
		$model = $this->model
        ->where('id', '=', $cliente['idCliente'])
        ->update([
            'situacao'  => $cliente['situacao']
        ]);

        return $model;
	}
}
