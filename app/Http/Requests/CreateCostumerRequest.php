<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCostumerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // retorna sempre true ja que não é necessario validar um usuario ou grupo de usuario para enviar uma mensagem de contato
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'id' => '',
            'name' => 'required',
            'email' => 'required|email',
            'cpf' => 'required|min:14|max:14',
        ];
    }

        public function messages()
    {
        return [
            'name.required' => 'É necessário preencher o campo de Nome.',
            'email.required' => 'É necessário preencher o campo Email.',
            'cpf.required' => 'É necessário preencher o campo CPF de acordo com 000.000.000-00.',
            'cpf.min' => 'É necessário preencher o campo CPF de acordo com 000.000.000-00.',
            'cpf.max' => 'É necessário preencher o campo CPF de acordo com 000.000.000-00.',
        ];
        // pela simplificade nao usei minemonicos para depois aplicar em no lang. ja coloquei direto aqui a mensagem customizada
    }
}
