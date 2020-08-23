<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class DashBoardController
 */
class DashBoardController extends Controller
{
    /**
     * The product repository instance
     */
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Return dashboard view
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = $this->productRepository->getAll();

            return view('dashboard.index', compact('products'));
        } catch (\Throwable $th) {
            abort(500, 'Internal Error');
        }
    }
}
