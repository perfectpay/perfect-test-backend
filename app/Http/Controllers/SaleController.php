<?php

namespace App\Http\Controllers;

use App\Client;
use App\Helpers\Helper;
use App\Product;
use App\Sale;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{

  public function list(Request $request)
  { 
    $client_id = $request->sale_client_id;
    
    $dates = explode(" ",$request->dateSales);

    $date_i = Helper::DataMysql($dates[0]);
    $date_f = Helper::DataMysql($dates[2]);

    $sales = Sale::where('client_id', $client_id)
                  ->whereBetween(DB::raw('DATE(date)'), array($date_i,$date_f))
                  ->with('product')->get();

    return json_encode($sales);

  }  

  public function show($id)
  {
    $sale = Sale::where('id',$id)
                  ->with('product')
                  ->with('client')->first();
    return json_encode($sale);
   } 

  public function store(Request $request)
  { 
    DB::beginTransaction();
    $client_id =  $this->resolveClient($request);
    //verifico se o produto de fato existe
    $product = Product::find($request->product_id);
    if(!$product)
    {
      $e = (["message"=> "mensagem", "errors"=>["01" =>'Erro! Produto não localizado...']]);
      return response($e,401);
    }

    $this->validRequest($request);

    $sale = new Sale();
    $sale->product_id    = $request->product_id;
    $sale->client_id     = $client_id;
    $sale->date          = $request->date;
    $sale->quantity      = $request->quantity;
    $sale->discount      = $request->discount;
    $sale->total         = ($product->price * $request->quantity) - $request->discount;
    $sale->status        = $request->status;
    $sale->save();
    DB::commit();
 }

  public function update(Request $request, $id)
  {
    DB::beginTransaction();

    $client_id =  $this->resolveClient($request);
    //verifico se o produto de fato existe
    $product = Product::find($request->product_id);
    if(!$product)
    {
      $e = (["message"=> "mensagem", "errors"=>["01" =>'Erro! Produto não localizado...']]);
      return response($e,401);
    }

    $this->validRequest($request);
    $sale = Sale::find($id);
    $sale->product_id    = $request->product_id;
    $sale->client_id     = $client_id;
    $sale->date          = $request->date;
    $sale->quantity      = $request->quantity;
    $sale->discount      = $request->discount;
    $sale->total         = ($product->price * $request->quantity) - $request->discount;
    $sale->status        = $request->status;
    $sale->save();
    DB::commit();
   }

   public function validRequest(Request $request)
   {
   
    $request['discount'] = Helper::clearCurrency($request->discount);

    $request->validate(
                        [
                          'product_id'  => 'gt:0',
                          'quantity'    => 'required|numeric|between:1,10',
                          'date'        => 'required',
                          'discount'    =>  'lt:100'
                        ],
                        [
                          'product_id.gt' => 'Selecione um produto...'
                        ],
                        [
                          'quantity'      => 'quantidade',
                          'date'          => 'data',
                          'discount'      => 'desconto'
                        ]
                      );   
   }

  private function resolveClient(Request $request)
  {
    $request->client_cpf = preg_replace('/[^0-9]/','',$request->client_cpf);

    $request->validate(
                        [
                          'client_cpf'  => 'required|cpf',
                          'client_name' => 'required',
                          'client_email'=> 'required|email'  
                        ],
                        [ 
                          'client_cpf.required' => 'CPF do cliente é obrigatório.',
                        ],
                        [ 
                          'client_name'       => 'nome',
                          'client_email'      => 'email'
                        ]
                      ); 
   
    $client = Client::where('cpf',$request->client_cpf)->first();

    if(!isset($client))
      $client = new Client();
         
      $client->cpf = $request->client_cpf;
      $client->name = $request->client_name;
      $client->email = $request->client_email;
      $client->save();
      return $client->id; 
}


public function salesresult()
{
   $sales = DB::select(DB::raw('select status, count(id) as qtd, sum(total) as total from sales group by status'));
   return json_encode($sales);
}


}
