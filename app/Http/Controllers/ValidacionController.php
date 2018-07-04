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
use App\Http\Models\ExtraDenunciado;
use DB;

use Illuminate\Http\Request;

class ValidacionController extends Controller
{
    
    public function valAbogadoUAT(AbogadoRequest $request){
        if(isset($request->idPersona))
            $idVariable = ValidacionController::updateInputsAbogadoFisica($request);
        else
            $idVariable = ValidacionController::saveInputsAbogadoFisica($request);
        return response()->json($idVariable);
    }

    public function valAutoridadUAT(AutoridadRequest $request){
        if(isset($request->idPersona))
            $idVariable = ValidacionController::updateInputsFisica($request);
        else
            $idVariable = ValidacionController::saveInputsFisica($request);
        return response()->json($idVariable);
    }

    public function valConocidoUAT(ConocidoRequest $request){
        if(isset($request->idPersona))
            $idVariable = ValidacionController::updateInputsConocidoFisica($request);
        else
            $idVariable = ValidacionController::saveInputsConocidoFisica($request);
        return response()->json($idVariable);
    }

    public function valDenunciadoFUAT(DenunciadoFisicaRequest $request){
        if(isset($request->idPersona))
            $idVariable = ValidacionController::updateInputsFisica($request);
        else
            $idVariable = ValidacionController::saveInputsFisica($request);
        return response()->json($idVariable);
    }

    public function valDenunciadoMUAT(DenunciadoMoralRequest $request){
        if(isset($request->idPersona))
            $idVariable = ValidacionController::updateInputsMoral($request);
        else
            $idVariable = ValidacionController::saveInputsMoral($request);
        return response()->json($idVariable);
    }

    public function valDenuncianteFUAT(DenuncianteFisicaRequest $request){
        if(isset($request->idPersona))
            $idVariable = ValidacionController::updateInputsFisica($request);
        else
            $idVariable = ValidacionController::saveInputsFisica($request);
        return response()->json($idVariable);
    }

    public function valDenuncianteMUAT(DenuncianteMoralRequest $request){
        if(isset($request->idPersona))
            $idVariable = ValidacionController::updateInputsMoral($request);
        else
            $idVariable = ValidacionController::saveInputsMoral($request);
        return response()->json($idVariable);
    }


    public function saveInputsFisica($request){
        DB::beginTransaction();
        try{
            if($request->personaFisica==''){
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
            }
            $variables =  new VariablesPersona();
            $variables->idPersona = ($request->personaFisica=='')?$persona->id:$request->personaFisica;
            $variables->edad = $request->edad;
            $variables->motivoEstancia = $request->motivoEstancia;
            $variables->idOcupacion = $request->idOcupacion;
            $variables->idEstadoCivil = $request->idEstadoCivil;
            $variables->idEscolaridad = $request->idEscolaridad;
            $variables->idReligion = $request->idReligion;
            
            $variables->docIdentificacion = $request->docIdentificacion;
            $variables->idInterprete = $request->idInterprete;
            $variables->numDocIdentificacion = $request->numDocIdentificacion;
            $variables->telefono = $request->telefono;
            $variables->idDomicilio = ($request->personaFisica=='')?1:$request->idDomicilio; 
            $variables->idTrabajo = ($request->personaFisica=='')?1:$request->idTrabajo; 
            $variables->idNotificacion = ($request->personaFisica=='')?1:$request->idNotificacion;
            $variables->save();

            if($request->personaFisica==''){
                saveInLog($request->sistema,$request->usuario,'persona_fisica','INSERT',$persona->id,null,$persona);
            }
            saveInLog($request->sistema,$request->usuario,'variables_persona_fisica','INSERT',$variables->id,null,$variables);
            DB::commit();
			return $variables->id;
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }

    public function updateInputsFisica($request){
        DB::beginTransaction();
        try{
            
            $variables =  VariablesPersona::find($request->idPersona);
            $variables->edad = $request->edad;
            $variables->motivoEstancia = $request->motivoEstancia;
            $variables->idOcupacion = $request->idOcupacion;
            $variables->idEstadoCivil = $request->idEstadoCivil;
            $variables->idEscolaridad = $request->idEscolaridad;
            $variables->idReligion = $request->idReligion;
            $variables->docIdentificacion = $request->docIdentificacion;
            $variables->idInterprete = $request->idInterprete;
            $variables->numDocIdentificacion = $request->numDocIdentificacion;
            $variables->telefono = $request->telefono;
            $variables->save();
            
            $persona = PersonaModel::find($variables->idPersona);
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
            
            saveInLog($request->sistema,$request->usuario,'variables_persona_fisica','UPDATE',$variables->id,null,$variables);
            saveInLog($request->sistema,$request->usuario,'persona_fisica','UPDATE',$persona->id,null,$persona);            
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
            if($request->personaFisica==''){
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
            }

            $variables =  new VariablesPersona();
            $variables->idPersona = ($request->personaFisica=='')?$persona->id:$request->personaFisica;
            $variables->idEstadoCivil = $request->idEstadoCivil;
            $variables->idDomicilio = ($request->personaFisica=='')?1:$request->idDomicilio; 
            $variables->idTrabajo = ($request->personaFisica=='')?1:$request->idTrabajo; 
            $variables->idNotificacion = ($request->personaFisica=='')?1:$request->idNotificacion;
            $variables->telefono = $request->telefono;
            $variables->edad = $request->edad;
            $variables->save();
            if($request->personaFisica==''){
                saveInLog($request->sistema,$request->usuario,'persona_fisica','INSERT',$persona->id,null,$persona);
            }
            saveInLog($request->sistema,$request->usuario,'variables_persona_fisica','INSERT',$variables->id,null,$variables);
            DB::commit();
			return $variables->id;
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }

    public function updateInputsAbogadoFisica($request){
        DB::beginTransaction();
        try{
            $variables =  VariablesPersona::find($request->idPersona);
            $variables->idEstadoCivil = $request->idEstadoCivil;
            $variables->telefono = $request->telefono;
            $variables->edad = $request->edad;
            $variables->save();

            $persona = PersonaModel::find($variables->idPersona);
            $persona->nombres = $request->nombres;
            $persona->primerAp = $request->primerAp;
            $persona->segundoAp = $request->segundoAp;
            $persona->fechaNacimiento = $request->fechaNacimiento;
            $persona->rfc = $request->rfc.$request->homo;
            $persona->curp = $request->curp;
            $persona->sexo = $request->sexo;
            $persona->idMunicipioOrigen = $request->idMunicipioOrigen;
            $persona->save();

            saveInLog($request->sistema,$request->usuario,'variables_persona_fisica','UPDATE',$variables->id,null,$variables);
            saveInLog($request->sistema,$request->usuario,'persona_fisica','UPDATE',$persona->id,null,$persona);            

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
            if($request->personaFisica==''){
                $persona =  new PersonaModel();
                $persona->nombres = $request->nombres;
                $persona->primerAp = $request->primerAp;
                $persona->segundoAp = $request->segundoAp;
                $persona->save();
            }
            $variables =  new VariablesPersona();
            $variables->idPersona = ($request->personaFisica=='')?$persona->id:$request->personaFisica;
            $variables->idDomicilio = ($request->personaFisica=='')?1:$request->idDomicilio; 
            $variables->idTrabajo = ($request->personaFisica=='')?1:$request->idTrabajo; 
            $variables->idNotificacion = ($request->personaFisica=='')?1:$request->idNotificacion;
            $variables->save();
            $extras = new ExtraDenunciado();
            $extras->idVariablesPersona = $variables->id;
            $extras->alias = $request->alias;
            $extras->save();

            if($request->personaFisica==''){
                saveInLog($request->sistema,$request->usuario,'persona_fisica','INSERT',$persona->id,null,$persona);
            }
            saveInLog($request->sistema,$request->usuario,'variables_persona_fisica','INSERT',$variables->id,null,$variables);
            saveInLog($request->sistema,$request->usuario,'persona_fisica','INSERT',$extras->id,null,$extras);
            DB::commit();
			return $variables->id;
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }

    public function updateInputsConocidoFisica($request){
        DB::beginTransaction();
        try{
            $variables =  VariablesPersona::find($request->idPersona);
            $variables->alias = $request->alias;//ya no esta en variables persona, ahora esta solo en extras
            $variables->save();

            $persona = PersonaModel::find($variables->idPersona);
            $persona->nombres = $request->nombres;
            $persona->primerAp = $request->primerAp;
            $persona->segundoAp = $request->segundoAp;
            $persona->save();

            saveInLog($request->sistema,$request->usuario,'variables_persona_fisica','UPDATE',$variables->id,null,$variables);
            saveInLog($request->sistema,$request->usuario,'persona_fisica','UPDATE',$persona->id,null,$persona);            
           
            DB::commit();
			return $variables->id;
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }

    public function saveInputsMoral($request){
        DB::beginTransaction();
        try{
            if($request->personaMoral==''){
                $persona =  new PersonaMoralModel();
                $persona->nombre = $request->nombre;
                $persona->fechaCreacion = $request->fechaCreacion;
                $persona->rfc = $request->rfc.$request->homo;
                $persona->save();
            }
            $variables =  new VariablesPersonaMoral();
            $variables->idPersona = ($request->personaMoral=='')?$persona->id:$request->personaMoral;
            $variables->idDomicilio = ($request->personaMoral=='')?1:$request->idDomicilio; 
            $variables->idNotificacion = ($request->personaMoral=='')?1:$request->idNotificacion;
            $variables->telefono = $request->telefono;
            $variables->representanteLegal = $request->representanteLegal;
            $variables->save();

            if($request->personaMoral==''){
                saveInLog($request->sistema,$request->usuario,'persona_moral','INSERT',$persona->id,null,$persona);
            }
            saveInLog($request->sistema,$request->usuario,'variables_persona_moral','INSERT',$variables->id,null,$variables);

            DB::commit();
            return $variables->id;
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }

    public function updateInputsMoral($request){
        DB::beginTransaction();
        try{

            $variables = VariablesPersonaMoral::find($request->idPersona);
            $variables->telefono = $request->telefono;
            $variables->representanteLegal = $request->representanteLegal;
            $variables->save();

            $persona =  PersonaMoralModel::find($variables->idPersona);
            $persona->nombre = $request->nombre;
            $persona->fechaCreacion = $request->fechaCreacion;
            $persona->rfc = $request->rfc.$request->homo;
            $persona->save();

            saveInLog($request->sistema,$request->usuario,'variables_persona_moral','UPDATE',$variables->id,null,$variables);
            saveInLog($request->sistema,$request->usuario,'persona_moral','UPDATE',$persona->id,null,$persona); 
            
            DB::commit();
            return $variables->id;
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }

}
