<?php

namespace App\Http\Controllers;
use App\Http\Requests\AbogadoRequest;
use App\Http\Requests\AutoridadRequest;
use App\Http\Requests\ConocidoRequest;
use App\Http\Requests\DenunciadoFisicaRequest;
use App\Http\Requests\DenunciadoMoralRequest;
use App\Http\Requests\DenuncianteFisicaRequest;
use App\Http\Requests\DenuncianteMoralRequest;
use App\Http\Models\PersonaModel;
use App\Http\Models\PersonaMoralModel;
use App\Http\Models\VariablesPersona;
use App\Http\Models\VariablesPersonaMoral;
use App\Http\Models\Validaciones;

use Illuminate\Http\Request;

class ValidacionController extends Controller
{
    public function valAbogadoUAT(AbogadoRequest $request){
        ValidacionController::saveInputsAbogadoFisica($request);
    }

    public function valAutoridadUAT(AutoridadRequest $request){
        ValidacionController::saveInputsFisica($request);
    }

    public function valConocidoUAT(ConocidoRequest $request){
        ValidacionController::saveInputsConocidoFisica($request);
    }

    public function valDenunciadoFUAT(DenunciadoFisicaRequest $request){
        ValidacionController::saveInputsFisica($request);
    }

    public function valDenunciadoMUAT(DenunciadoMoralRequest $request){
        ValidacionController::saveInputsMoral($request);
    }

    public function valDenuncianteFUAT(DenuncianteFisicaRequest $request){
        ValidacionController::saveInputsFisica($request);
    }

    public function valDenuncianteMUAT(DenuncianteMoralRequest $request){
        ValidacionController::saveInputsMoral($request);
    }

    public function saveInputsFisica($request){
        DB::beginTransaction();
        try{
            $persona =  new PersonaModel();
            $persona->nombres = $request->nombres;
            $persona->primerAp = $request->primerAp;
            $persona->segundoAp = $request->segundoAp;
            $persona->fechaNacimiento = $request->fechaNacimiento;
            $persona->rfc = $request->rfc.$request->homo;
            $persona->curp = $request->curp;
            $persona->sexo = $request->sexo;
            $persona->idNacionalidad = $request->nacionalidad;
            $persona->idEtnia = $request->etnia;
            $persona->idLengua = $request->lengua;
            $persona->idMunicipioOrigen = $request->municipio;
            $persona->save();
            $variables =  new VariablesPersona();
            $variables->idPersona = $persona->id;
            $variables->edad = $request->edad;
            $variables->motivoEstancia = $request->motivoEstancia;
            $variables->idOcupacion = $request->ocupacion;
            $variables->idEstadoCivil = $request->estadoCivil;
            $variables->idEscolaridad = $request->escolaridad;
            $variables->idReligion = $request->religion;
            $variables->idDomicilio = 1; /*CAMBIAR CUANDO IMPLEMENTEMOS COMPONENTE DOMICILIO */
            $variables->docIdentificacion = $request->identificacion;
            $variables->idInterprete = $request->interprete;
            $variables->numDocIdentificacion = $request->numIdentificacion;
            $variables->idDomicilioTrabajo = 1; /*CAMBIAR CUANDO IMPLEMENTEMOS COMPONENTE DOMICILIO */
            $variables->save();
            DB::commit();
			return response()->json($variables->id);
        }catch (\PDOException $e){
            DB::rollBack();
            return response()->json(false);
        }
    }

    public function saveInputsAbogadoFisica($request){
        DB::beginTransaction();
        try{
            $persona =  new PersonaModel();
            $persona->nombres = $request->nombres;
            $persona->primerAp = $request->primerAp;
            $persona->segundoAp = $request->segundoAp;
            $persona->fechaNacimiento = $request->fechaNacimiento;
            $persona->rfc = $request->rfc.$request->homo;
            $persona->curp = $request->curp;
            $persona->sexo = $request->sexo;
            $persona->idMunicipioOrigen = $request->municipio;
            $persona->save();
            $variables =  new VariablesPersona();
            $variables->idPersona = $persona->id;
            $variables->idEstadoCivil = $request->estadoCivil;
            $variables->idDomicilio = 1; /*CAMBIAR CUANDO IMPLEMENTEMOS COMPONENTE DOMICILIO */
            $variables->idDomicilioTrabajo = 1; /*CAMBIAR CUANDO IMPLEMENTEMOS COMPONENTE DOMICILIO */
            $variables->save();
            DB::commit();
			return response()->json($variables->id);
        }catch (\PDOException $e){
            DB::rollBack();
            return response()->json(false);
        }
    }

    public function saveInputsConocidoFisica($request){
        DB::beginTransaction();
        try{
            $persona =  new PersonaModel();
            $persona->nombres = $request->nombres;
            $persona->primerAp = $request->primerAp;
            $persona->segundoAp = $request->segundoAp;
            $persona->save();
            $variables =  new VariablesPersona();
            $variables->idPersona = $persona->id;
            $variables->idDomicilio = 1; /*CAMBIAR CUANDO IMPLEMENTEMOS COMPONENTE DOMICILIO */
            $variables->idDomicilioTrabajo = 1; /*CAMBIAR CUANDO IMPLEMENTEMOS COMPONENTE DOMICILIO */
            $variables->alias = $request->alias;
            $variables->save();
            DB::commit();
			return response()->json($variables->id);
        }catch (\PDOException $e){
            DB::rollBack();
            return response()->json(false);
        }
    }

    public function saveInputsMoral(){
        DB::beginTransaction();
        try{
            $persona =  new PersonaMoralModel();
            $persona->nombre = $request->nombre;
            $persona->fechaCreacion = $request->fechaConstitucion;
            $persona->rfc = $request->rfc.$request->homo;
            $persona->save();
            $variables =  new VariablesPersonaMoral();
            $variables->idPersona = $persona->id;
            $variables->idDomicilio = 1; /*CAMBIAR CUANDO IMPLEMENTEMOS COMPONENTE DOMICILIO */
            $variables->telefono = $request->telefono;
            $variables->representanteLegal = $request->representanteLegal;
            $variables->save();
            DB::commit();
            return response()->json($variables->id);
        }catch (\PDOException $e){
            DB::rollBack();
            return response()->json(false);
        }
    }
}
