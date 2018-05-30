<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaMoralRequest extends FormRequest
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
            'nombre' => 'required',
            // 'fechaCreacion' => 'required',
            'rfc' => 'required|size:12',
            'telefono' => 'required|numeric',
            'representanteLegal' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Introduzca el campo nombre',
            // 'fechaCreacion.required' => 'Introduzca el campo fecha de constitución',
            // 'fechaCreacion.date' => 'El campo fecha de constitución debe tener un formato de fecha',
            'rfc.required' => 'Introduzca el campo rfc',
            'rfc.size' => 'El campo rfc debe tener un tamaño de 12 caracteres',
            'telefono.required' => 'Introduzca el campo telefono',
            'telefono.numeric' => 'El campo teléfono debe ser de tipo numerico',
            'representanteLegal.required' => 'Introduzca el campo representante legal'
        ];
    }
}
