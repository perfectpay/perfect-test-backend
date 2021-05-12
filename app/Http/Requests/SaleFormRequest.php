<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleFormRequest extends FormRequest
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
        $id = $this->segment(3);

        switch ($this->method()) {
            case 'POST':
                return [
                    'product_id' => 'required|numeric',
                    'sale_date' => 'required|date',
                    'amount' => 'required|numeric',
                    'status' => 'required|digits:1',
                    'discount' => 'required|numeric',
                ];
                break;
            case 'PUT':
                return [
                    'product_id' => 'required|numeric',
                    'sale_date' => 'required|date',
                    'amount' => 'required|numeric',
                    'status' => 'required|digits:1',
                    'discount' => 'required|numeric',
                ];
                break;
            default:
                return [];
                break;
        }
    }
}
