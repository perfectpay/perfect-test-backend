<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'costumer_id' => 'required|not_in:0',
            'product_id' => 'required|not_in:0',
            'quantity' => 'required|numeric|gt:0|lt:11',
            'discount' => 'nullable|numeric|gt:0|lte:100',
            'status' => 'required|not_in:0',
        ];
    }

        public function messages()
    {
        return [
            'status.not_in' => 'É necessário selecionar o status do pedido.',
            'costumer_id.required' => 'É necessário selecionar o cliente.',
            'product_id.required' => 'É necessário selecionar um produto.',
            'costumer_id.not_in' => 'É necessário selecionar o cliente.',
            'product_id.not_in' => 'É necessário selecionar um produto.',
            'quantity.numeric' => 'O campo QUANTIDADE precisar possuir um valor numérico.',
            'discount.numeric' => 'O campo DESCONTO precisar possuir um valor numérico.',
            'quantity.required' => 'É necessário preencher com uma quantidade maior que 0.',
            'discount.required' => 'É necessário preencher com um dessconto maior que 0.',
            'discount.gt' => 'É necessário preencher com um dessconto maior ou igual a 0.',
            'discount.lt' => 'É necessário preencher com um dessconto de 100 ou menor.',
            'quantity.gt' => 'É necessário preencher com uma quantidade maior que 0.',
            'quantity.lt' => 'É necessário preencher com uma quantidade menor que 10.',
        ];
        // pela simplificade nao usei minemonicos para depois aplicar em no lang. ja coloquei direto aqui a mensagem customizada
    }

}

