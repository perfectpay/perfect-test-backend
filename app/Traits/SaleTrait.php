<?php

namespace App\Traits;

use App\Http\Requests\Sales\{
    StoreFormRequest,
    UpdateFormRequest
};
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return UpdateFormRequest
     */
    public function update(UpdateFormRequest $request, int $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $sale = $this->saleRepository->update(
                    $request->only($this->saleRepository->getFillable()),
                    $id
                );

                $client = $this->clientRepository->update(
                    $request->only($this->clientRepository->getFillable()),
                    $sale->client_id
                );
            });

            return redirect()
                ->route('dashboard.index')
                ->with('success', 'Venda alterada com sucesso');
        } catch (ModelNotFoundException $me) {
            return back()
                ->with('info', 'Registro não encontrado')
                ->withInput();
        } catch (\Throwable $th) {
            return back()
                ->with('danger', 'Internal Error Server')
                ->withInput();
        }
    }
}
