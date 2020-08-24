<?php

namespace App\Traits;

use App\Http\Requests\Sales\StoreFormRequest;
use Illuminate\Support\Facades\DB;

/**
 * Trai SaleService
 *
 * @package App\Traits
 */
trait SaleTrait
{
    /**
     * Store a newly created sale in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormRequest $request)
    {
        try {
            DB::beginTransaction();

            $client  = $this->clientRepository->create(
                $request->only($this->clientRepository->getFillable())
            );

            $request->client_id = $client->id;

            $sale  = $this->saleRepository->create(
                array_merge(
                    $request->only($this->saleRepository->getFillable()),
                    ['client_id' => $client->id]
                )
            );

            if ($client && $sale) {
                DB::commit();

                return redirect()
                    ->route('dashboard.index')
                    ->with('success', 'Venda registrada com sucesso');
            }
            DB::rollBack();

            return back()
                ->with('danger', 'Error in database transaction')
                ->withInput();
        } catch (\Throwable $th) {
            return back()
                ->with('danger', 'Internal Error Server')
                ->withInput();
        }
    }

    public function update()
    {
    }
}
