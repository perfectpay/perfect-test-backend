<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sales\StoreFormRequest;
use App\Repositories\Contracts\{
    ClientRepositoryInterface,
    ProductRepositoryInterface,
    SaleRepositoryInterface,
    SaleStatusRepositoryInterface
};
use App\Traits\SaleTrait;
use Illuminate\Http\Request;

/**
 * Class SalesController
 *
 * @package App\Http\Controllers
 */
class SalesController extends Controller
{
    use SaleTrait;

    /**
     * The product repository instance
     */
    private $clientRepository;

    /**
     * The product repository instance
     */
    private $productRepository;

    /**
     * The sale status instance
     */
    private $saleRepository;

    /**
     * The sale status repository instance
     */
    private $saleStatusRepository;

    /**
     * Create a new controller instance.
     *
     * @param ClientRepositoryInterface $clientRepository
     * @param ProductRepositoryInterface $productRepository
     * @param SaleRepositoryInterface $saleRepository
     * @param SaleStatusRepositoryInterface $saleStatusRepository
     * @return void
     */
    public function __construct(
        ClientRepositoryInterface $clientRepository,
        ProductRepositoryInterface $productRespository,
        SaleRepositoryInterface $saleRepository,
        SaleStatusRepositoryInterface $saleStatusRepository
    ) {
        $this->clientRepository = $clientRepository;
        $this->productRepository = $productRespository;
        $this->saleRepository = $saleRepository;
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
        try {
            $sale = $this->saleRepository
                ->with(['client'])
                ->find($id);

            if (is_null($sale)) {
                return redirect()
                    ->route('dashboard.index')
                    ->with('info', 'Produto não encontrado');
            }

            $saleStatus = $this->saleStatusRepository->getAll();
            $products = $this->productRepository->getAll();

            return view('sales.edit', compact('products', 'sale', 'saleStatus'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('dashboard.index')
                // ->with('danger', 'Internal Error Server');
                ->with('danger', $th->getMessage());
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
        try {
            $qtRegistersDeleted = $this->saleRepository->destroy($id);

            if ($qtRegistersDeleted === 0) {
                return response()->json('', 404);
            }

            return response()->json('', 204);
        } catch (\Throwable $th) {
            return response()->json('Internal Error Server', 500);
        }
    }
}
