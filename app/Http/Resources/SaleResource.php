<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'sale_date' => $this->sale_date,
            'amount' => $this->amount,
            'status' => $this->status,
            'discount' => $this->discount,
        ];
    }
}
