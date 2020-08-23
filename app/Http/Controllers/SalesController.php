<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sales\StoreFormRequest;
use App\Repositories\Contracts\{
    ProductRepositoryInterface,
    SaleStatusRepositoryInterface
};
use Illuminate\Http\Request;

/**
 * Class SalesController
 *
 * @package App\Http\Controllers
 */
class SalesController extends Controller
{
    /**
     * The product repository instance
     */
    private $productRepository;

    /**
     * The sale status repository instance
     */
    private $saleStatusRepository;

    /**
     * Create a new controller instance.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param SaleStatusRepositoryInterface $saleStatusRepository
     * @return void
     */
    public function __construct(
        ProductRepositoryInterface $productRespository,
        SaleStatusRepositoryInterface $saleStatusRepository
    ) {
        $this->productRepository = $productRespository;
        $this->saleStatusRepository = $saleStatusRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $products = $this->productRepository->getAll();
            $saleStatus = $this->saleStatusRepository->getAll();

            return view('sales.create', compact('products', 'saleStatus'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('dashboard.index')
                ->with('danger', 'Internal Error Server');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormRequest $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
