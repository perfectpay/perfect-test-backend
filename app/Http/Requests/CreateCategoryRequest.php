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
            'description' => 'nullable',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'É necessário preencher o campo de Nome.',
            'image.mimes' =>'O arquivo precisa ser uma imagem nas extensões: jpeg, jpg, png, gif',
            'image.max' =>'O arquivo precisa ser uma imagem de no máximo 2048KB',

        ];
        // pela simplificade nao usei minemonicos para depois aplicar em no lang. ja coloquei direto aqui a mensagem customizada
    }
}
