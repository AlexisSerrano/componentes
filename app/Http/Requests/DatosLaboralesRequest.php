<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatosLaboralesRequest extends FormRequest
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
            'municipio' => 'required',
            'localidad' => 'required',
            'colonia' => 'required',
            'calle' => 'required',
            'numExterno' => 'required',
            'telefono' => 'required',
            'telefonoTrabajo' => 'required',
            'lugarTrabajo' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'municipio.required' => 'Introduzca el campo municipio',
            'localidad.required' => 'Introduzca el campo localidad',
            'colonia.required' => 'Introduzca el campo colonia',
            'calle.required' => 'Introduzca el campo calle',
            'numExterno.required' => 'Introduzca el campo número externo',
            'telefono.required' => 'Introduzca el campo teléfono',
            'telefonoTrabajo.required' => 'Introduzca el campo teléfono trabajo',
            'lugarTrabajo.required' => 'Introduzca el campo lugar de trabajo',

        ];
    }
}
