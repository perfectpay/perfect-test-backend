<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
                    'name' => 'required|min:3|max:100|unique:products,name',
                    'description' => 'required|min:6',
                    'price' => 'required',
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'required|min:3|max:100|unique:products,name,'.$id,
                    'description' => 'required|min:6',
                    'price' => 'required',
                ];
                break;
            default:
                return [];
                break;
        }
    }
}
