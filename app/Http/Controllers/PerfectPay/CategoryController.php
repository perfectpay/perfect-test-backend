<?php

namespace App\Http\Controllers\PerfectPay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Session;
use App\Http\Requests\CreateCategoryRequest;
use File;
use Store;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.category.index',[
            'categories' => Category::paginate(3),

        ]);
    }

    public function show(Category $category)
    {

        $category2 = Category::all();
        $products = Product::where(['category_id'=>$category->id])->paginate(3);
        
        return view('site.category.show',['category'=>  $category,'products'=>  $products]); 

          }
      
    public function form(Category $category)
    {
         return view('site.category.form');
    }

    public function create(CreateCategoryRequest $request)
    {
                 //metodo responsavel pelo formulario post da pagina contato
        
        // como coloquei todos os parametros necessarios no fillable da classe, coloco os names do formulario de acordo com as colunas dai nao preciso declarar um a um
        $category = Category::create($request->all());

        Session::flash('message','Message info');


       if($request->hasFile('image')==TRUE) {
        $path = '/img/';
        $extension =  $request->file('image')->extension();
        $name = $request->file('image')->getClientOriginalName();
        $fullname = 'category_'.$category->id . '.' . $extension;
        $request->file('image')->storeAs($path,$fullname);
        $fullpath = $path . $fullname;

        
        $category->update(['image'=> $fullpath]);
        }
        else{
        $category->update(['image'=> Null]);    
        }
        
        return redirect()->back()->with('message', 'Categoria cadastrado com sucesso!');
    }

         public function edit(Category $category)
    {
                 

        return view('site.category.form',[
            'category' => $category,

        ]);
          
    }

         public function update(CreateCategoryRequest $request)
    {
        $category = Category::Find($request->id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->update();
        
      Session::flash('message','Message info');
        
        return redirect()->route('site.products')->with('message', 'Categoria Modificada com sucesso!');
    }


            public function delete(Category $category)
    {
    
        Session::flash('messagewarn2','Message info');

        if(Product::where('category_id',$category->id)->count() > 0){
            return redirect()->route('site.products')->with('messagewarn2', 'Primeiro delete TODOS os projetos dentro desta categoria.');
        }
        else{
            $category = Category::Find($category->id);
            $category->delete();
            return redirect()->route('site.products')->with('messagewarn', 'Categoria Deletada com sucesso!');
        }
        
      
        //return redirect()->route('site.costumers')->with('messagewarn', 'Categoria Deletada com sucesso!');
    }

}
