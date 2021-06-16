<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
        // regras de preenchimento
        return [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ];
    }

            public function messages()
    {
        return [
            'name.required' => 'É necessário preencher seu NOME.',
            'email.required' => 'É necessário preencher seu EMAIL.',
            'email.email' => 'O camno EMAIL precisa ter um endereço de EMAIL válido.',
            'message.required' => 'É necessário preencher a MENSAGEM para ser enviada.',
        ];
        // pela simplificade nao usei minemonicos para depois aplicar em no lang. ja coloquei direto aqui a mensagem customizada
    }
}
