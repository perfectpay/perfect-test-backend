<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $service;

    /**
     * ProductController constructor.
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ProductResource::collection($this->service->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductFormRequest $request
     * @return object
     */
    public function store(ProductFormRequest $request)
    {
        return $this->service->register($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return ProductResource
     */
    public function show($id)
    {
        return new ProductResource($this->service->findById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductFormRequest $request
     * @param $id
     * @return mixed
     */
    public function update(ProductFormRequest $request, $id)
    {
        return $this->service->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->service->delete($id);
    }
}
