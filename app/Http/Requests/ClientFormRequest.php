<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientFormRequest extends FormRequest
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
                    'name' => 'required|min:3|max:100|unique:clients,name',
                    'cpf' => [
                        'numeric',
                        'digits:11',
                        new \App\Rules\CpfValidationRule,
                        'unique:clients,cpf'
                    ],
                    'email' => 'email|max:100|nullable|unique:clients,email',
                ];
                break;
            case 'PUT':
                return [
                    'name' => 'required|min:3|max:100|unique:clients,name,'.$id,
                    'cpf' => [
                        'numeric',
                        'digits:11',
                        new \App\Rules\CpfValidationRule,
                        'unique:clients,cpf,'.$id
                    ],
                    'email' => 'email|max:100|nullable|unique:clients,email,'.$id,
                ];
                break;
            default:
                return [];
                break;
        }
    }
}
