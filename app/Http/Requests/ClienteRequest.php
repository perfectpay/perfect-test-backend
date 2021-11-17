<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    public function all($keys = null)
    {
        return $this->validateFields(parent::all());
    }

    public function validateFields(array $inputs)
    {
        $inputs['cpf'] = str_replace(['.', '-'], '', $this->request->all()['cpf']);
        return $inputs;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'=>'required|min:3|max:100',
            'email'=> (!empty($this->request->all()['id']) ? 'required|max:100|unique:cliente,email,' . $this->request->all()['id'] : 'required|max:100|unique:cliente,email'),
            'cpf'=> (!empty($this->request->all()['id']) ? 'required|unique:cliente,email,' . $this->request->all()['id'] : 'required|unique:cliente,email'),
        ];
    }
}
