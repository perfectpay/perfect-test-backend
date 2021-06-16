<?php

namespace App\Http\Controllers\PerfectPay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Http\Requests\CreateProductRequest;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.category.index',[
            'categories' => Category::all(),

        ]);
    }

       public function show(Category $category)
    {
        $category= Category::findorFail($category->category_id);
        return view('site.product.show',['category' => $category, 'product'=>  $product]); 
        //load vai carregar o json com um objeto relation ja trazendo todos os produtos que possuem essa categoria

          }    

          public function form(Category $category)
    {

         return view('site.product.form',['category'=> $category]);
    }

    public function create(CreateProductRequest $request)
    {
                 //metodo responsavel pelo formulario post da pagina contato
        
        // como coloquei todos os parametros necessarios no fillable da classe, coloco os names do formulario de acordo com as colunas dai nao preciso declarar um a um
        $product = Product::create($request->all());

        Session::flash('message','Message info');

    if($request->hasFile('image')==TRUE) {
        $path = '/img/';
        $extension =  $request->file('image')->extension();
        $name = $request->file('image')->getClientOriginalName();
        $fullname = 'product_'.$product->id . '.' . $extension;
        $request->file('image')->storeAs($path,$fullname);
        $fullpath = $path . $fullname;

        
        $product->update(['image'=> $fullpath]);
        }
        else{
        $product->update(['image'=> Null]);    
        }
       
        return redirect()->back()->with('message', 'Categoria cadastrado com sucesso!');
    }


    public function edit(Product $product)
    {
                 

        return view('site.category.form',[
            'category' => $category,

        ]);
          
    }

         public function update(CreateProductRequest $request)
    {
        $category = Category::Find($request->id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->update();
        
      Session::flash('message','Message info');
        
        return redirect()->route('site.products')->with('message', 'Categoria Modificada com sucesso!');
    }


            public function delete(Product $product)
    {
    
        Session::flash('messagewarn','Message info');

        
            $product = Product::Find($product->id);
            $product->delete();
        
        return redirect()->route('site.products.category',['category'=>$product->category_id])->with('messagewarn', 'Produto Deletado com sucesso!');
        
        
      
        //return redirect()->route('site.costumers')->with('messagewarn', 'Categoria Deletada com sucesso!');
    }

}
