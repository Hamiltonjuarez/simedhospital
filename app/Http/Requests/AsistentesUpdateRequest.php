<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsistentesUpdateRequest extends FormRequest
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
            'name'      => 'required',
            'username'  => 'required|unique:users,username,'. $this->asistente,
            'password' => 'required|confirmed|max:20|min:8',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'El nombre de usuario es requerido',
            'name.required'  => 'El nombre es requerido',
            'username.unique' => 'El nombre  de usuario ya existe',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.required' => 'La contrraseña es requerida',
            'password.max' => 'El maximo de caracteres para la contraseña es de 20',
            'password.min' => 'El minimo de caracteres para la contraseña es de 8'
        ];
    }
}
