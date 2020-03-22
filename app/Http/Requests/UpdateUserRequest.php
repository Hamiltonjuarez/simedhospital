<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'username' => [
                'required','max:64',
                Rule::unique('users', 'username')->ignore($this->user)
            ],
            'email' => [
                'required','max:120',
                Rule::unique('users', 'email')->ignore($this->user)
            ],
            'name' => 'required',
        ];
    }

    public function messages(){
        return [
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.unique' => $this->username. ' ya esta en uso',
            'username.max' => 'El username no puede tener mas de 64 caracteres',
            'email.required' => 'El email es obligatorio',
            'email.unique' => $this->email. ' ya esta en uso',
            'name.required' => 'El Nombre es obligatorio',
        ];
    }
}
