<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class ActasHechosMoralRequest extends FormRequest
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
            'representanteLegal' => 'required'
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
            'representanteLegal.required' => 'El representante legal es requerido'
        ];  
    }
}