<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//usando a Classe necessaria para fazer o Query Build
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

// Usando os Modelos
use App\Produto;
use App\Usuario;
use App\Venda;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        /**
         * Aqui utilizamos metodos estaticos da Classe Model
         */
        $clientes = Usuario::all();
        $produtos = Produto::all();
        $venda_aprovada = Venda::where('statusVenda', 'Aprovado')->get();
        $venda_cancelada = Venda::where('statusVenda', 'Cancelado')->get();
        $venda_devolvida = Venda::where('statusVenda', 'Devolvido')->get();

        /**
         * Aqui recebo as request via Get e adiciono em variaveis
         */
        $cliente = $request->get('idCliente');
        $date= $request->get('dateEntre');

        /**
         * Aqui verifico se as requests Get $date e $cliente existem,
         * se são diferentes de null e do value= 'Clientes'
         */
        if(($date == true && $date != null) || ($cliente == true && $cliente != 'Clientes')){
            /**
             * Se a condição for aceita entramos nesse if,
             * Tratamos o Ajuste de data do padrão brasileiro para o padrão Americano
             * Pois precisaremos gravar no banco essa data e o banco de dados só aceita nesse formato Y-m-d
             */
            $dateAmericana = implode('',explode('-', $date));
            $dateAmericana = implode('-',(explode('/', $dateAmericana)));
            $dateAmericana=explode(' ',$dateAmericana);
            $date1= implode('-',array_reverse(explode('-', $dateAmericana[0])));
            $date2= implode('-',array_reverse(explode('-', $dateAmericana[2])));
            /**
             * Apos tratada a data 1 e 2 para o padrão correto , podemos iniciar uma Query Builder
             * Estamos fazendo logo abaixo um INNER JOIN de 3 tables.
             * E estamos filtrando de comun as Foreing key
             */
            $vendas = DB::table('vendas')
            ->join('usuarios', 'vendas.usuarioId', '=', 'usuarios.id')
            ->join('produtos', 'vendas.produtoId', '=', 'produtos.id')
            ->get();
            /**
             * Após construi nossa collection utilizaremos alguns metodos para filtrarmos
             * e receber tudo isso na variavel $vendas_query que só será alterada se for
             * requisitado pelo usuario uma pesquisa Por Cliente e entre uma definida data.
             */
            $vendas_query= $vendas->whereBetween('dataVenda', ["$date1","$date2"])->where('usuarioId', "$cliente");
        }else{
        /**
         * caso o usuario não queira filtrar algo especifico mostraremos todos os resultados
         */
        $vendas_query = DB::table('vendas')
            ->join('usuarios', 'vendas.usuarioId', '=', 'usuarios.id')
            ->join('produtos', 'vendas.produtoId', '=', 'produtos.id')
            ->get();
        }
        /**
         * Aqui em return , retornamos nossa View e enviamos alguns resultados através de um Array Associativo
         */
        return view('dashboard',['clientes' => $clientes,'produtos' => $produtos, 'vendas_query' => $vendas_query, 'venda_aprovada' => $venda_aprovada,'venda_cancelada' => $venda_cancelada,'venda_devolvida' => $venda_devolvida]);
    }
}
