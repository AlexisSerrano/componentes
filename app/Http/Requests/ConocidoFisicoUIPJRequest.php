<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConocidoFisicoUIPJRequest extends FormRequest
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
            'nombres' => 'nullable|string|min:3|max:200',
            'primerAp' => 'nullable|string|min:3|max:50',
            'segundoAp' => 'nullable|string|min:3|max:50',
           'alias' => 'nullable|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'nombres.min'=> 'El Nombre debe contener como mínimo 3 letras',
            'nombres.max'=> 'El Nombre debe contener como máximo 200 letras',
            'primerAp.min'=> 'El Primer apellido debe contener como mínimo 3 letras',
            'primerAp.max'=> 'El Primer apellido debe contener como máximo 50 letras',
            'segundoAp.min'=> 'El Segundo apellido debe contener como mínimo 3 letras',
            'segundoAp.max'=> 'El Segundo apellido debe contener como máximo 50 letras',
			'alias.max' => 'El Alias debe contener como máximo 50 letra',
        ];
    }
}
