<?php

namespace App\Http\Controllers\PerfectPay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Http\Requests\CreateOrderRequest;
use App\Costumer;
use App\Product;
Use Session;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
          return view('site.order.index',[
            'orders_paginated' => Order::paginate(6),
            'orders' => Order::All(),
            'costumers' => Costumer::all(),
            'products' => Product::all(),
            'calculation' => ['sold_qtt'=>Order::where('status','Vendido')->count(),'cancel_qtt'=>Order::where('status','Cancelado')->count(),'return_qtt'=>Order::where('status','Devolvido')->count(),'sold_total'=>Order::where('status','Vendido')->sum('id'),'cancel_total'=>5,'return_total'=>5],
            ]);
    }

public function form(Order $order)
    {
         return view('site.order.form',['costumers'=>  Costumer::All(),'products'=>  Product::All()]);
    }

        public function create(CreateOrderRequest $request)
    {

                 //metodo responsavel pelo formulario post da pagina contato
      $tocreate = $request->all();
      $data = $tocreate['order_date'];
      $tocreate['order_date']= Carbon::createFromFormat('d/m/Y', $data);
      
        $order = Order::create($tocreate);
        // como coloquei todos os parametros necessarios no fillable da classe, coloco os names do formulario de acordo com as colunas dai nao preciso declarar um a um
        
        Session::flash('message','Message info');

        return redirect()->back()->with('message', 'Cliente cadastrado com sucesso!');
    }

            public function edit(Order $order)
    {
                 //metodo responsavel pelo formulario post da pagina contato
        //$costumer = Costumer::create($request->all());
        // como coloquei todos os parametros necessarios no fillable da classe, coloco os names do formulario de acordo com as colunas dai nao preciso declarar um a um
        
        
         

        return view('site.order.form',[
            'order' => $order,
            'costumers' => Costumer::all(),
            'products' => Product::all(),
        ]);
          
    }
        public function update(CreateOrderRequest $request)
    {
        $order = Order::Find($request->id);
        $order->costumer_id = $request->costumer_id;
        $order->product_id = $request->product_id;
        $order->quantity = $request->quantity;
        $order->discount = $request->discount;
        $order->status = $request->status;
        $order->update();

      Session::flash('message','Message info');

        return redirect()->route('site.orders')->with('message', 'Pedido Modificado com sucesso!');
    }


        public function delete(Order $order)
    {
        $order = Order::Find($order->id);
        $order->delete();

      Session::flash('messagewarn','Message info');

        return redirect()->route('site.orders')->with('messagewarn', 'Pedido Deletado com sucesso!');
    }

        public function search(Request $request)
    {
            $costumer_id = $request->costumer;
            $datePeriod = $request->datePeriod;

            $orders_paginated = Order::All();

            if($costumer_id==0){
            $orders_paginated = Order::All();
            }
            else {
            $orders_paginated = Order::where(['costumer_id' => $costumer_id])->paginate(6);

            }

            if(isset($datePeriod)){
            (int)$dateSeparator = strpos($datePeriod,' - ');
            $dateMinor = Carbon::createFromFormat('d/m/Y',substr($datePeriod,0,$dateSeparator));
            $dateMajor = Carbon::createFromFormat('d/m/Y',substr($datePeriod,$dateSeparator+3,strlen($datePeriod)));
            // carbon para colocar no modelo de data padrao

            $orders_paginated = $orders_paginated->where('order_date', '>=' , $dateMinor->addDays(-1))->where('order_date', '<=' , $dateMajor->addDays(1));
            // adicionado data a cima do limite superior e abaixo do limite inferior para invalidar o resto do timestamp(horas,minutos e segundos) nas datas.
 }
            if($orders_paginated->count()<1){
            Session::flash('messagewarn','Não foram encontrados pedidos com os dados selecionados.');

            }


            
            
            return view('site.order.index',[
            'orders_paginated' => $orders_paginated,
            'orders' => Order::All(),
            'costumers' => Costumer::all(),
            'products' => Product::all(),
            'calculation' => ['sold_qtt'=>Order::where('status','Vendido')->count(),'cancel_qtt'=>Order::where('status','Cancelado')->count(),'return_qtt'=>Order::where('status','Devolvido')->count(),'sold_total'=>Order::where('status','Vendido')->sum('id'),'cancel_total'=>5,'return_total'=>5],
            
            ]);
             


    }



}