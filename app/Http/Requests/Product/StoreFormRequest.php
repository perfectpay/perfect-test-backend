<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreFormRequest
 *
 * @package App\Http\Requests\Product
 */
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
            'name' => 'required|unique:products|min:3|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0'
        ];
    }
}
