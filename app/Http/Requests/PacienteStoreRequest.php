<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteStoreRequest extends FormRequest
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
          /*   'nombre'     => 'required|max:64',
            'apellidos'  => 'required|max:64',
            'nacimiento' => 'required',
            'telefono'   => 'required|min:11',
            'sexo'       => 'required|max:1',
            'civil'      => 'required|max:32',
            'dui'        => 'required|unique:pacientes,dui|max:64', */
        ];
    }
}
