<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Produto;
use App\Venda;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $vendas = Venda::with(['produtosVenda'])->latest('data')->get();
        $resultados = Venda::groupBy('status')
            ->selectRaw('count(*) as total, status')
            ->get();

        $produtos = Produto::all();
        return view('dashboard', ['vendas'=>$vendas, 'resultados'=>$resultados, 'produtos'=>$produtos]);
    }

    /**
     * Retorna busca das vendas de um cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function vendas(Request $request)
    {
        $arr = explode(" - ", $request->periodo);
        $date_start = $this->convertStringToDate($arr[0]);
        $date_end = $this->convertStringToDate($arr[1]);
        $vendas = Venda::whereBetween('data', [$date_start, $date_end])->with(['produtosVenda','clientesVenda'])->get();
        $resultados = Venda::groupBy('status')
            ->selectRaw('count(*) as total, status')
            ->get();
        $produtos = Produto::all();
        return view('dashboard', ['vendas'=>$vendas, 'resultados'=>$resultados, 'produtos'=>$produtos]);
    }


    private function convertStringToDate($param)
    {
        if(empty($param)){
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d H:i:s');
    }

}
