<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class DenuncianteMoralUIPJRequest extends FormRequest
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
        $before_date = Carbon::now()->subYears(18)->toDateString();
        return [
            'nombre' => 'string|min:3|max:50|required',
            'fechaCreacion' => 'required',
            'rfc' => 'alpha_num|min:8|max:20|required',
            'homo' => 'size:3|required',
            'docIdentificacion' => 'required',
            'numDocIdentificacion' => 'required',
            'nombreRep' => 'required',
            'primerApRep' => 'required',
            'segundoApRep' => '',
            'telefono' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre.min'=> 'El Nombre debe contener como mínimo 3 letras',
            'nombre.max'=> 'El Nombre debe contener como máximo 50 letras',
            'nombre.required' => 'El nombre es requerido',
            'fechaCreacion.required' => 'La fecha de alta es requerida',
            'rfc.alpha_num'=> 'El RFC solo contienen números y letras',
            'rfc.min'=> 'El RFC debe de tener como mínimo 8',
            'rfc.max'=> 'El RFC debe de tener como máximo 20',
            'rfc.required' => 'El RFC es requerido',
            'homo.size'=> 'La homoclave debe de tener como mínimo 3 caracteres',
            'homo.required' => 'La homoclave es requerida',
            'nombreRep.required' => 'El nombre del representante legal es requerido',
            'primerApRep.required' => 'El primer apellido del representante legal es requerido',
            'segundoApRep.required' => 'El segundo apellido del representante legal es requerido',
            'docIdentificacion.required' => 'El Documento de identificación es requerido',
            'numDocIdentificacion.required' => 'El número de identificación es requerido',
            'telefono.required' => 'El número de identificación es requerido'
        ];  
    }
}
