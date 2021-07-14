<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Client extends FormRequest
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
            'email' => (!empty($this->request->all()['id']) ? 'required|email|unique:clients,email,' . $this->request->all()['id'] : 'required|email|unique:clients,email'),
            'document' => 'required|integer|min:11'
        ];
    }
}
