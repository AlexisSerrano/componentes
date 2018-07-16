<?php

namespace App\Http\Controllers;
use App\Http\Requests\AbogadoRequest;
use App\Http\Requests\AutoridadRequest;
use App\Http\Requests\ConocidoFisicoRequest;
use App\Http\Requests\ConocidoMoralRequest;
use App\Http\Requests\DenunciadoFisicaRequest;
use App\Http\Requests\DenunciadoMoralRequest;
use App\Http\Requests\DenuncianteFisicaRequest;
use App\Http\Requests\DenuncianteMoralRequest;
use App\Http\Models\PersonaModel;
use App\Http\Models\PersonaMoralModel;
use App\Http\Models\VariablesPersona;
use App\Http\Models\VariablesPersonaMoral;
use App\Http\Models\aparicionesModel;
use App\Http\Models\ExtraDenunciadoFisico;
use App\Http\Models\ExtraDenunciadoMoral;
use App\Http\Requests\ActasHechosRequest;
use App\Http\Requests\ActasHechosMoralRequest;
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

    public function valConocidoFUAT(ConocidoFisicoRequest $request){
        $idVariable = ValidacionController::saveInputsConocidoFisico($request);
        return response()->json($idVariable);
    }

    public function valConocidoMUAT(ConocidoMoralRequest $request){
        $idVariable = ValidacionController::saveInputsConocidoMoral($request);
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

    public function valQrrUAT(Request $request){
        $idVariable = ValidacionController::saveQrr($request);
        return response()->json($idVariable);
    }

    public function valActasHechosFUAT(ActasHechosRequest $request){
        $idVariable = ValidacionController::saveActasHechos($request);
        return response()->json($idVariable);
    }

    public function valActasHechosMUAT(ActasHechosMoralRequest $request){
        $idVariable = ValidacionController::saveInputsMoral($request);
        return response()->json($idVariable);
    }


    public function saveInputsFisica($request){
        DB::beginTransaction();
        try{
            if($request->personaFisica==''&&$request->idPersona==''){
                $persona = new PersonaModel();
                $oper="INSERT";
                $antes= null;
            }
            else{
                $persona = PersonaModel::find($request->personaFisica);
                $oper = "UPDATE";
                $antes = clone $persona;
            }
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
            if(isset($request->idPersona)){
                $variables=VariablesPersona::find($request->idPersona);
                $oper="UPDATE";
                $antes= clone $variables;
            }else{
                $variables=new VariablesPersona();
                $variables->idPersona = ($request->personaFisica=='')?$persona->id:$request->personaFisica;
                $variables->idDomicilio = ($request->personaFisica=='')?1:$request->idDomicilio; 
                $variables->idTrabajo = ($request->personaFisica=='')?1:$request->idTrabajo; 
                $variables->idNotificacion = ($request->personaFisica=='')?1:$request->idNotificacion;
                $oper="INSERT";
                $antes=null;
            }
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
            saveInLog($request->sistema,$request->usuario,'persona_fisica',$oper,$persona->id,$antes,$persona);
            saveInLog($request->sistema,$request->usuario,'variables_persona_fisica',$oper,$variables->id,$antes,$variables);
            DB::commit();
            $data = array(
				'idPersona'=>$persona->id,
                'idVarPersona'=>$variables->id
            );
			return response()->json($data);
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }

    public function saveInputsAbogadoFisica($request){
        DB::beginTransaction();
        try{
            if($request->personaFisica==''&&$request->idPersona==''){
                $persona = new PersonaModel();
                $oper="INSERT";
                $antes= null;
            }
            else{
                $persona = PersonaModel::find($request->personaFisica);
                $oper = "UPDATE";
                $antes = clone $persona;
            }
            $persona->nombres = $request->nombres;
            $persona->primerAp = $request->primerAp;
            $persona->segundoAp = $request->segundoAp;
            $persona->fechaNacimiento = $request->fechaNacimiento;
            $persona->rfc = $request->rfc.$request->homo;
            $persona->curp = $request->curp;
            $persona->sexo = $request->sexo;
            $persona->idMunicipioOrigen = $request->idMunicipioOrigen;
            $persona->save();

            if(isset($request->idPersona)){
                $variables=VariablesPersona::find($request->idPersona);
                $oper="UPDATE";
                $antes= clone $variables;
            }else{
                $variables=new VariablesPersona();
                $variables->idPersona = ($request->personaFisica=='')?$persona->id:$request->personaFisica;
                $variables->idDomicilio = ($request->personaFisica=='')?1:$request->idDomicilio; 
                $variables->idTrabajo = ($request->personaFisica=='')?1:$request->idTrabajo; 
                $variables->idNotificacion = ($request->personaFisica=='')?1:$request->idNotificacion;
                $oper="INSERT";
                $antes=null;
            }
            $variables->idEstadoCivil = $request->idEstadoCivil;
            $variables->telefono = $request->telefono;
            $variables->edad = $request->edad;
            $variables->save();
            saveInLog($request->sistema,$request->usuario,'persona_fisica',$oper,$persona->id,$antes,$persona);
            saveInLog($request->sistema,$request->usuario,'variables_persona_fisica',$oper,$variables->id,$antes,$variables);
            DB::commit();
            $data = array(
				'idPersona'=>$persona->id,
                'idVarPersona'=>$variables->id
            );
			return response()->json($data);
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }

    public function saveInputsConocidoFisico($request){
        DB::beginTransaction();
        try{
            $persona = new PersonaModel();
            $persona->nombres = $request->nombres;
            $persona->primerAp = $request->primerAp;
            $persona->segundoAp = $request->segundoAp;
            $persona->save();

            $variables = new VariablesPersona();
            $variables->idPersona = ($request->personaFisica=='')?$persona->id:$request->personaFisica;
            $variables->idDomicilio = ($request->personaFisica=='')?1:$request->idDomicilio; 
            $variables->idTrabajo = ($request->personaFisica=='')?1:$request->idTrabajo; 
            $variables->idNotificacion = ($request->personaFisica=='')?1:$request->idNotificacion;
            $variables->save();

            $extras = new ExtraDenunciadoFisico();
            $extras->idVariablesPersona = $variables->id;
            $extras->alias = $request->alias;
            $extras->save();

            saveInLog($request->sistema,$request->usuario,'persona_fisica','INSERT',$persona->id,null,$persona);
            saveInLog($request->sistema,$request->usuario,'variables_persona_fisica','INSERT',$variables->id,null,$variables);
            saveInLog($request->sistema,$request->usuario,'persona_fisica','INSERT',$extras->id,null,$extras);
            DB::commit();

            $data = array('idPersona'=>$persona->id,'idVarPersona'=>$variables->id,'idExtra'=>$extras->id);
            return response()->json($data);
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }

    public function saveInputsConocidoMoral($request){
        DB::beginTransaction();
        try{
            $persona = new PersonaMoralModel();
            $persona->nombre = $request->nombre;
            $persona->fechaCreacion = "1990-01-01";
            $persona->rfc = "";
            $persona->save();

            $variables = new VariablesPersonaMoral();
            $variables->idPersona = ($request->personaMoral=='')?$persona->id:$request->personaMoral;
            $variables->idDomicilio = ($request->personaMoral=='')?1:$request->idDomicilio; 
            $variables->idTrabajo = ($request->personaMoral=='')?1:$request->idTrabajo; 
            $variables->idNotificacion = ($request->personaMoral=='')?1:$request->idNotificacion;
            $variables->save();

            $extras = new ExtraDenunciadoMoral();
            $extras->idVariablesPersona = $variables->id;
            $extras->alias = $request->alias;
            $extras->save();

            saveInLog($request->sistema,$request->usuario,'persona_moral','INSERT',$persona->id,null,$persona);
            saveInLog($request->sistema,$request->usuario,'variables_persona_moral','INSERT',$variables->id,null,$variables);
            saveInLog($request->sistema,$request->usuario,'persona_moral','INSERT',$extras->id,null,$extras);
            DB::commit();

            $data = array('idPersona'=>$persona->id,'idVarPersona'=>$variables->id,'idExtra'=>$extras->id);
            return response()->json($data);
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }

    // public function updateInputsConocidoFisica($request){
    //     //DB::beginTransaction();
    //     //try{
    //         $persona = PersonaModel::find($request->personaFisica);
    //         $persona->nombres = $request->nombres;
    //         $persona->primerAp = $request->primerAp;
    //         $persona->segundoAp = $request->segundoAp;
    //         $persona->save();

    //         $extras = ExtraDenunciadoFisico::find($request->idExtra);
    //         $extras->alias = $request->alias;
    //         $extras->save();

    //         saveInLog($request->sistema,$request->usuario,'variables_persona_fisica','UPDATE',$variables->id,null,$variables);
    //         saveInLog($request->sistema,$request->usuario,'persona_fisica','UPDATE',$persona->id,null,$persona);            
           
    //         //DB::commit();
    //         $data = array('idPersona'=>$request->idPersona,'idExtra'=>$request->idExtra);
    //         return response()->json($data);
    //     // }catch (\PDOException $e){
    //     //     //DB::rollBack();
    //     //     return false;
    //     // }
    // }

    public function saveInputsMoral($request){
        DB::beginTransaction();
        try{
            if($request->personaMoral==''&&$request->idPersona==''){
                $persona = new PersonaMoralModel();
                $oper="INSERT";
                $antes= null;
            }
            else{
                $persona = PersonaMoralModel::find($request->personaMoral);
                $oper = "UPDATE";
                $antes = clone $persona;
            }
            $persona->nombre = $request->nombre;
            $persona->fechaCreacion = $request->fechaCreacion;
            $persona->rfc = $request->rfc.$request->homo;
            $persona->save();

            if(isset($request->idPersona)){
                $variables = VariablesPersonaMoral::find($request->idPersona);
                $oper = "UPDATE";
                $antes = clone $variables; 
            }
            else{
                $variables = new VariablesPersonaMoral();
                $oper="INSERT";
                $antes= null;
                $variables->idDomicilio = ($request->personaMoral=='')?1:$request->idDomicilio; 
                $variables->idNotificacion = ($request->personaMoral=='')?1:$request->idNotificacion;
            }
            $variables->idPersona = ($request->personaMoral=='')?$persona->id:$request->personaMoral;
            $variables->telefono = $request->telefono;
            $variables->nombreRep = $request->nombreRep;
            $variables->primerApRep = $request->primerApRep;
            $variables->segundoApRep = $request->segundoApRep;
            $variables->docIdentificacion = $request->docIdentificacion;
            $variables->numDocIdentificacion = $request->numDocIdentificacion;
            $variables->save();

            saveInLog($request->sistema,$request->usuario,'persona_moral',$oper,$persona->id,$antes,$persona);
            saveInLog($request->sistema,$request->usuario,'variables_persona_moral',$oper,$variables->id,$antes,$variables);

            DB::commit();
            $data = array(
				'idPersona'=>$persona->id,
                'idVarPersona'=>$variables->id
            );
			return response()->json($data);
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }

    public function saveQrr($request){
        $aparicion = aparicionesModel::where('idCarpeta',$request->idCarpeta)->first();
        if($aparicion){
            $data = array(
                'idPersona'=>false,
                'idVarPersona'=>false
            );
            return response()->json($data);
        }
        else{
            DB::beginTransaction();
            try{
                $apariciones = saveInApariciones($request->sistema,$request->idCarpeta,1,'denunciado','xxxxx',0);
                saveInLog($request->sistema,$request->usuario,'apariciones','INSERT',$apariciones->id,null,$apariciones);
                DB::commit();
                $data = array(
                    'idPersona'=>1,
                    'idVarPersona'=>1
                );
                return response()->json($data);
            }
            catch (\PDOException $e){
                DB::rollBack();
                return false;
            }
        } 
    }

    public function saveActasHechos($request){
        DB::beginTransaction();
        try{
            if($request->personaFisica==''&&$request->idPersona==''){
                $persona = new PersonaModel();
                $oper="INSERT";
                $antes= null;
            }
            else{
                $persona = PersonaModel::find($request->personaFisica);
                $oper = "UPDATE";
                $antes = clone $persona;
            }
            $persona->nombres = $request->nombres;
            $persona->primerAp = $request->primerAp;
            $persona->segundoAp = $request->segundoAp;
            $persona->fechaNacimiento = $request->fechaNacimiento;
            $persona->rfc = $request->rfc.$request->homo;
            $persona->curp = $request->curp;
            $persona->sexo = $request->sexo;
            $persona->idNacionalidad = $request->idNacionalidad;
            $persona->idMunicipioOrigen = $request->idMunicipioOrigen;
            $persona->save();
            if(isset($request->idPersona)){
                $variables=VariablesPersona::find($request->idPersona);
                $oper="UPDATE";
                $antes= clone $variables;
            }else{
                $variables=new VariablesPersona();
                $variables->idPersona = ($request->personaFisica=='')?$persona->id:$request->personaFisica;
                $variables->idDomicilio = ($request->personaFisica=='')?1:$request->idDomicilio; 
                $variables->idTrabajo = ($request->personaFisica=='')?1:$request->idTrabajo; 
                $variables->idNotificacion = ($request->personaFisica=='')?1:$request->idNotificacion;
                $oper="INSERT";
                $antes=null;
            }
            $variables->edad = $request->edad;
            $variables->motivoEstancia = $request->motivoEstancia;
            $variables->idOcupacion = $request->idOcupacion;
            $variables->idEstadoCivil = $request->idEstadoCivil;
            $variables->idEscolaridad = $request->idEscolaridad;
            $variables->docIdentificacion = $request->docIdentificacion;
            $variables->idInterprete = 1;
            $variables->numDocIdentificacion = $request->numDocIdentificacion;
            $variables->telefono = $request->telefono;
            $variables->save();
            saveInLog($request->sistema,$request->usuario,'persona_fisica',$oper,$persona->id,$antes,$persona);
            saveInLog($request->sistema,$request->usuario,'variables_persona_fisica',$oper,$variables->id,$antes,$variables);
            DB::commit();
            $data = array(
				'idPersona'=>$persona->id,
                'idVarPersona'=>$variables->id
            );
			return response()->json($data);
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }
}
