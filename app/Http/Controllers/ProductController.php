<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreFormRequest;
use App\Http\Requests\Product\UpdateFormRequest;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * Class ProductController
 *
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * The product repository instance
     */
    private $productRepository;

    /**
     * Create a new controller instance.
     *
     * @param ProductRepositoryInterface $productRepository
     * @return void
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
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
                ->route('dashboard.index')
                ->with('success', 'Produto adicionado com sucesso');
        } catch (\Throwable $th) {
            return back()
                ->with('danger', 'Internal Error Server')
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $product = $this->productRepository->findById($id);

            if (is_null($product)) {
                return redirect()
                    ->route('dashboard.index')
                    ->with('info', 'Produto não encontrado');
            }
            return view('products.edit', compact('product'));
        } catch (ModelNotFoundException $me) {
            return redirect()
                ->route('dashboard.index')
                ->with('info', 'Esse registro não consta na nossa base de dados')
                ->withInput();
        } catch (\Throwable $th) {
            return redirect()
                ->route('dashboard.index')
                ->with('danger', 'Internal Error Server');
        }
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return UpdateFormRequest
     */
    public function update(UpdateFormRequest $request, $id)
    {
        try {
            $product = $this->productRepository->update($request->all(), $id);

            return redirect()
                ->route('dashboard.index')
                ->with('success', 'Produto alterado com sucesso');
        } catch (ModelNotFoundException $me) {
            return back()
                ->with('info', 'Esse registro não consta na nossa base de dados')
                ->withInput();
        } catch (\Throwable $th) {
            return back()
                ->with('danger', 'Internal Error Server: ' . $th->getMessage())
                ->withInput();
        }
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
