<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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

            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'É necessário preencher o campo de Nome.',
            'description.required' => 'É necessário preencher o campo Descrição.',
        ];
        // pela simplificade nao usei minemonicos para depois aplicar em no lang. ja coloquei direto aqui a mensagem customizada
    }
}
