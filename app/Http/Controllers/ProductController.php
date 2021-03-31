<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class ProductController extends Controller
{
   
  public function index()
  {
    $products = Product::all();
    return json_encode($products);
  }

  public function validRequest(Request $request)
  {
    $request['price'] =  Helper::clearCurrency($request->price);

    $request->validate(
                        [ 'name'         => 'required|unique:products,name,'.$request->id,
                          'price'        => 'required|numeric|gte:100',
                        ],
                        [ 'name.unique' => 'Já existe um produto com este nome!',
                          'price.gte'   => 'O preço deve ser no mínimo 100,00'],
                        
                        [ 'name'        => 'Nome',
                          'price'       => 'preço'
                        ]
                      );   
  }

  public function store( Request $request)
  {
    $this->validRequest($request);

    //upload photo
    if ($request->hasFile('photo') && $request->file('photo')->isValid() )
    {  
       $url_foto = Helper::savePhoto($request->file('photo'), 'products', 500);     
    }
       
    $product = new Product();
    $product->fill($request->all());
    $product->photo = isset($url_foto) ? $url_foto : null;
    $product->save();

  }
 
   
  public function update (Request $request, $id)
  { 
    $this->validRequest($request);

    $product = Product::find($id);
    $product->fill($request->all());
           
    if($request->photo_edit == '1')
    {
      if ($request->hasFile('photo') && $request->file('photo')->isValid())
      { 
        $product->photo    = Helper::savePhoto($request->file('photo'), 'products', 500);   
      }
      else
        $product->photo  = null;
    }
    
     $product->save();
     return $product;
   }
}