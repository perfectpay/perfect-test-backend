<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientFormRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @var ClientService
     */
    private $service;

    /**
     * ClientController constructor.
     * @param ClientService $service
     */
    public function __construct(ClientService $service)
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
        return ClientResource::collection($this->service->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClientFormRequest $request
     * @return object
     */
    public function store(ClientFormRequest $request)
    {
        return $this->service->register($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return ClientResource
     */
    public function show($id)
    {
        return new ClientResource($this->service->findById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClientFormRequest $request
     * @param $id
     * @return mixed
     */
    public function update(ClientFormRequest $request, $id)
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
