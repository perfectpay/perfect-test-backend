<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Client;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Sale as SaleRequest;
use App\Http\Requests\SaleEdit as SaleEditRequest;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $products = Product::all();

        return view('sales.create', compact('clients', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        /** Para testar a persistencia */
        // $sale = new Sale();
        // $sale->fill($request->all());

        // var_dump($sale->getAttributes());

        $createSale = Sale::create($request->all());

        return redirect()->route('sales.edit', ['sale' => $createSale->id])->with(['color'=>'success', 'message'=>'Venda cadastrada com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::where('id', $id)->first();

        return view('sales.edit', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(SaleEditRequest $request, $id)
    {
        $sale = Sale::where('id', $id)->first();
        // $sale->update([
        //     'status' => $request('status'),
        // ]);
        $sale->fill($request->all());

        $sale->save();

        return redirect()->route('sales.edit', ['sale' => $sale->id])->with(['color'=>'success', 'message'=>'Venda editada com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
