<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Requests\Client as ClientRequest;

class ClientController extends Controller
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
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $createClient = Client::create($request->all());

        return redirect()->route('clients.edit', ['client' => $createClient->id])->with(['color'=>'success', 'message'=>'Cliente cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::where('id', $id)->first();
        
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        $client = Client::where('id', $id)->first();
        $client->fill($request->all());

        $client->save();

        return redirect()->route('clients.edit', ['client' => $client->id])->with(['color'=>'success', 'message'=>'Cliente editado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $client)
    {
        //
    }
}
