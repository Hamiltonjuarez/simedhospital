<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends FormRequest
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
            'nombreDoctor' => 'required|max:120',
            'apellidosDoctor' => 'required|max:120',
           /*  'codigoDoctor' => [
                'required','max:120',
                Rule::unique('doctors', 'codigoDoctor')->ignore($this->doctor)
            ], */
        ];
    }
}
