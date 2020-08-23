<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateFormRequest
 *
 * @package App\Http\Requests\Products
 */
class UpdateFormRequest extends FormRequest
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
            'name' => 'required|min:3|max:255|unique:products,id,' . $this->route()->parameter('product'),
            'description' => 'required|string',
            'price' => 'required|numeric|min:0'
        ];
    }
}
