<?php

namespace App\Http\Requests\Sales;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Clients fields
            'name'  => 'required|min:3',
            'email' => 'required|email|unique:clients,email',
            'cpf'   => 'required|regex:/(\d{11})/',

            // Sales fields
            'qt_product'        => 'required|integer|min:1',
            'discount'          => 'required|integer|min:0|max:100',
            'sale_date'         => 'required',
            'product_id'        => 'required|exists:products,id',
            'sale_status_id'    => 'required|exists:sale_status,id',
        ];
    }
}
