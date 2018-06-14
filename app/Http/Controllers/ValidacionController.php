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
use App\Http\Models\aparicionesModel;
use DB;

use Illuminate\Http\Request;

class ValidacionController extends Controller
{
    public function valAbogadoUAT(AbogadoRequest $request){
        $idVariable = ValidacionController::saveInputsAbogadoFisica($request);
        return response()->json($idVariable);
    }

    public function valAutoridadUAT(AutoridadRequest $request){
        $idVariable = ValidacionController::saveInputsFisica($request);
        return response()->json($idVariable);
    }

    public function valConocidoUAT(ConocidoRequest $request){
        $idVariable = ValidacionController::saveInputsConocidoFisica($request);
        return response()->json($idVariable);
    }

    public function valDenunciadoFUAT(DenunciadoFisicaRequest $request){
        $idVariable = ValidacionController::saveInputsFisica($request);
        return response()->json($idVariable);
    }

    public function valDenunciadoMUAT(DenunciadoMoralRequest $request){
        $idVariable = ValidacionController::saveInputsMoral($request);
        return response()->json($idVariable);
    }

    public function valDenuncianteFUAT(DenuncianteFisicaRequest $request){
        $idVariable = ValidacionController::saveInputsFisica($request);
        return response()->json($idVariable);
    }

    public function valDenuncianteMUAT(DenuncianteMoralRequest $request){
        $idVariable = ValidacionController::saveInputsMoral($request);
        return response()->json($idVariable);
    }

    public function saveInputsFisica($request){
        // $apariciones = new aparicionesModel();
        // $apariciones->idVarPersona = 6;
        // $apariciones->idCarpeta = 1;
        // $apariciones->sistema = $request->sistema;
        // $apariciones->tipoInvolucrado = 1;
        // $apariciones->nuc = 'xxxxx';
        // $apariciones->esEmpresa = 0;
        // $apariciones->save(); 
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
            $persona->idNacionalidad = $request->idNacionalidad;
            $persona->idEtnia = $request->idEtnia;
            $persona->idLengua = $request->idLengua;
            $persona->idMunicipioOrigen = $request->idMunicipioOrigen;
            $persona->save();
            $variables =  new VariablesPersona();
            $variables->idPersona = $persona->id;
            $variables->edad = $request->edad;
            $variables->motivoEstancia = $request->motivoEstancia;
            $variables->idOcupacion = $request->idOcupacion;
            $variables->idEstadoCivil = $request->idEstadoCivil;
            $variables->idEscolaridad = $request->idEscolaridad;
            $variables->idReligion = $request->idReligion;
            $variables->idDomicilio = 1; /*CAMBIAR CUANDO IMPLEMENTEMOS COMPONENTE DOMICILIO */
            $variables->docIdentificacion = $request->docIdentificacion;
            $variables->idInterprete = $request->idInterprete;
            $variables->numDocIdentificacion = $request->numDocIdentificacion;
            $variables->idDomicilioTrabajo = 1; /*CAMBIAR CUANDO IMPLEMENTEMOS COMPONENTE DOMICILIO */
            $variables->save();
            $apariciones = new aparicionesModel();
            $apariciones->idVarPersona = $variables->id;
            $apariciones->idCarpeta = $request->idCarpeta;
            $apariciones->sistema = $request->sistema;
            $apariciones->tipoInvolucrado = $request->tipo;
            $apariciones->nuc = 'xxxxx';
            $apariciones->esEmpresa = 0;
            $apariciones->save(); 
            DB::commit();
			return $variables->id;
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
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
            $persona->idMunicipioOrigen = $request->idMunicipioOrigen;
            $persona->save();
            $variables =  new VariablesPersona();
            $variables->idPersona = $persona->id;
            $variables->idEstadoCivil = $request->idEstadoCivil;
            $variables->idDomicilio = 1; /*CAMBIAR CUANDO IMPLEMENTEMOS COMPONENTE DOMICILIO */
            $variables->idDomicilioTrabajo = 1; /*CAMBIAR CUANDO IMPLEMENTEMOS COMPONENTE DOMICILIO */
            $variables->save();
            DB::commit();
			return $variables->id;
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
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
			return $variables->id;
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
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
            return $variables->id;
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }
}
