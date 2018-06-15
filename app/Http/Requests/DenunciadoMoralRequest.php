<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class DenunciadoMoralRequest extends FormRequest
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
            'nombres' => 'string|min:3|max:50|required',
            'fecha_alta' => 'required',
            'rfc' => 'alpha_num|min:8|max:20|required',
            'homo' => 'size:3|required',
            'representante_legal' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombres.min'=> 'El Nombre debe contener como mínimo 3 letras',
            'nombres.max'=> 'El Nombre debe contener como máximo 50 letras',
            'nombres.required' => 'El nombre es requerido',
            'fecha_alta.required' => 'La fecha de alta es requerida',
            'rfc.alpha_num'=> 'El RFC solo contienen números y letras',
            'rfc.min'=> 'El RFC debe de tener como mínimo 8',
            'rfc.max'=> 'El RFC debe de tener como máximo 20',
            'rfc.required' => 'El RFC es requerido',
            'homo.size'=> 'La homoclave debe de tener como mínimo 3 caracteres',
            'homo.required' => 'La homoclave es requerida',
            'representante_legal.required' => 'El representante legal es requerido'
        ];  
    }
}
