<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreFormRequest;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class ProductController
 *
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  StoreFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormRequest $request)
    {
        try {
            $product = $this->productRepository->create($request->all());

            return redirect()
                ->route('products.create')
                ->with('success', 'Registro adicionado com sucesso');
        } catch (\Throwable $th) {
            return back()
                ->withInputs()
                ->withErrors();
        }
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
