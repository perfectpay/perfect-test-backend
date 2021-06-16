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
}
