<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class AutoridadRequest extends FormRequest
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
            'nombres' => 'string|min:3|max:200|required',
            'primerAp' => 'nullable|string|min:3|max:50',
            'segundoAp' => 'nullable|string|min:3|max:50',
            'fechaNacimiento' => 'required|date|before:'.$before_date,
            'idEstadoOrigen' => 'required',
            'idMunicipioOrigen' => 'required',
            'sexo' => 'required',
            'curp' => 'alpha_num|min:17|max:18',
            'rfc' => 'alpha_num|min:8|max:13',/*no requerido*/ 
            'homo' => 'nullable|size:3',/*no requerido*/ 
            'idNacionalidad' => '',/*no requerido*/ 
            'idEtnia' => '',/*no requerido default NO APLICA*/ 
            'idLengua' => '',/*no requerido default NO APLICA*/ 
            'telefono' => 'nullable|numeric|min:7', /*no requerido*/ 
            'idOcupacion' => '',/*no requerido*/ 
            'idEstadoCivil' => '',/*no requerido*/ 
            'idReligion' => '',/*no requerido*/ 
            'idEscolaridad' => '',/*no requerido*/
            'numDocIdentificacion' => 'string|min:2|max:50'
        ];
    }

    public function messages()
    {
        return [
            'nombres.min'=> 'El Nombre debe contener como mínimo 3 letras',
            'nombres.max'=> 'El Nombre debe contener como máximo 200 letras',
            'nombres.required' => 'El nombre es requerido',
            'primerAp.min'=> 'El Primer apellido debe contener como mínimo 3 letras',
            'primerAp.max'=> 'El Primer apellido debe contener como máximo 50 letras',
            'segundoAp.min'=> 'El Segundo apellido debe contener como mínimo 3 letras',
            'segundoAp.max'=> 'El Segundo apellido debe contener como máximo 50 letras',
            'fechaNacimiento.before' => 'La edad mínima para poner una denuncia es de 18 años',
            'idEstadoOrigen.required' => 'El Estado de origen es requerido',
            'idMunicipioOrigen.required' => 'El Municipio de origen es requerido',
            'sexo.required' => 'El Sexo es requerido',
            'curp.alpha_num'=> 'El CURP solo contienen números y letras',
            'curp.min'=> 'El CURP debe de tener como mínimo 17',
            'curp.max'=> 'El CURP debe de tener como máximo 18',
            'rfc.alpha_num'=> 'El RFC solo contienen números y letras',
            'rfc.min'=> 'El RFC debe de tener como mínimo 8',
            'rfc.max'=> 'El RFC debe de tener como máximo 13',
            'homo.size'=> 'La homoclave debe de tener como mínimo 3 caracteres',
            'telefono.numeric'=>'El Teléfono personal solo debe de contener números',
            'telefono.min'=>'El Teléfono personal debe de tener como mínimo 7 digitos',
            'numDocIdentificacion.min'=> 'El Núm. de documento de identificación debe de tener como mínimo 2',
            'numDocIdentificacion.max'=> 'El Núm. de documento de identificación debe de tener como máximo 50'
        ];
    }
}