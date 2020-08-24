<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\SearchFormRequest;
use App\Repositories\Contracts\{
    ClientRepositoryInterface,
    ProductRepositoryInterface,
    SaleRepositoryInterface,
    SaleStatusRepositoryInterface
};
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class DashBoardController
 */
class DashBoardController extends Controller
{
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
     * Return dashboard view
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $clients    = $this->clientRepository->getAll();
            $products   = $this->productRepository->getAll();
            $sales      = $this->saleRepository->getAll();
            $saleStatus = $this->formartSaleStatusResourceForPresent();

            return view('dashboard.index', compact('clients', 'products', 'sales', 'saleStatus'));
        } catch (\Throwable $th) {
            abort(500, 'Internal Error');
        }
    }

    /**
     * Return results of search
     *
     * @param SearchFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function search(SearchFormRequest $request)
    {
        try {
            $dateRange = preg_split('/ - /', $request['date_range']);
            $clientId = $request['client_id'];

            $fnExplodeReverseDate = function ($item) {
                $arrExplodeReverseDate = array_reverse(explode('/', $item));
                return date(
                    'Y-m-d H:i:s',
                    strtotime(
                        "{$arrExplodeReverseDate[0]}-{$arrExplodeReverseDate[1]}-{$arrExplodeReverseDate[2]}"
                    )
                );
            };

            $arrDateRange = array_map($fnExplodeReverseDate, $dateRange);

            $sales = $this->saleRepository
                ->with(['product', 'client', 'saleStatus'])
                ->where('client_id', '=',  $clientId)
                ->whereBetween('sale_date', $arrDateRange)
                ->get();

            $clients    = $this->clientRepository->getAll();
            $products   = $this->productRepository->getAll();
            $saleStatus = $this->formartSaleStatusResourceForPresent();

            return view('dashboard.index', compact('clients', 'products', 'sales', 'saleStatus', 'dateRange', 'clientId'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('dashboard.index')
                ->with('danger', $th->getMessage());
        }
    }

    /**
     * Formart sale status resource for present
     *
     * @return array
     */
    private function formartSaleStatusResourceForPresent()
    {
        $arraySaleStatus = $this->saleStatusRepository
            ->with(['sales.product'])
            ->get()
            ->all();

        $fnTotalValue = function ($carry, $item) {
            $totalValue = $item->product->price * $item->qt_product;

            if ($item->discount != 0) {
                $totalValue -= $totalValue * ($item->discount / 100);
            }

            $carry += $totalValue;

            return $carry;
        };

        return array_map(function ($item) use ($fnTotalValue) {
            $sales = $item->sales->all();

            return [
                'name' => $item->name,
                'quantity' => $item->sales->count(),
                'totalValue' => array_reduce($sales, $fnTotalValue, 0)
            ];
        }, $arraySaleStatus);
    }
}
