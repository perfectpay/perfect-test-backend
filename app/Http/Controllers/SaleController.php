<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleFormRequest;
use App\Http\Resources\SaleResource;
use App\Services\SaleService;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * @var SaleService
     */
    private $service;

    /**
     * SaleController constructor.
     * @param SaleService $service
     */
    public function __construct(SaleService $service)
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
        return SaleResource::collection($this->service->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaleFormRequest $request
     * @return object
     */
    public function store(SaleFormRequest $request)
    {
        return $this->service->register($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return SaleResource
     */
    public function show($id)
    {
        return new SaleResource($this->service->findById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SaleFormRequest $request
     * @param $id
     * @return mixed
     */
    public function update(SaleFormRequest $request, $id)
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
