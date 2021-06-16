<?php

namespace App\Http\Controllers\PerfectPay;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use App\Costumer;
use App\Http\Requests\CreateCostumerRequest;

class CostumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return view('site.costumer.index',[
            'costumers' => Costumer::all(),
            ]);
    }

    public function show(Costumer $costumer)
    {
         
    }

        public function form(Costumer $costumer)
    {
         return view('site.costumer.form');
    }

        public function create(CreateCostumerRequest $request)
    {
                 //metodo responsavel pelo formulario post da pagina contato
        $costumer = Costumer::create($request->all());
        // como coloquei todos os parametros necessarios no fillable da classe, coloco os names do formulario de acordo com as colunas dai nao preciso declarar um a um
        
        Session::flash('message','Message info');

        return redirect()->back()->with('message', 'Cliente cadastrado com sucesso!');
    }

            public function edit(Costumer $costumer)
    {
                

        return view('site.costumer.form',[
            'costumer' => $costumer,

        ]);
          
    }
        public function update(CreateCostumerRequest $request)
    {
        $costumer = Costumer::Find($request->id);
        $costumer->name = $request->name;
        $costumer->email = $request->email;
        $costumer->cpf = $request->cpf;
        $costumer->update();

      Session::flash('message','Message info');

        return redirect()->route('site.costumers')->with('message', 'Cliente Modificado com sucesso!');
    }


            public function delete(Costumer $costumer)
    {
        $costumer = Costumer::Find($costumer->id);
        $costumer->delete();

      Session::flash('messagewarn','Message info');

        return redirect()->route('site.costumers')->with('messagewarn', 'Cliente Deletado com sucesso!');
    }

}
