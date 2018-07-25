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

use App\Http\Requests\AbogadoUIPJRequest;
use App\Http\Requests\AutoridadUIPJRequest;
use App\Http\Requests\ConocidoFisicoUIPJRequest;
use App\Http\Requests\ConocidoMoralUIPJRequest;
use App\Http\Requests\DenunciadoFisicaUIPJRequest;
use App\Http\Requests\DenunciadoMoralUIPJRequest;
use App\Http\Requests\DenuncianteFisicaUIPJRequest;
use App\Http\Requests\DenuncianteMoralUIPJRequest;

use App\Http\Models\PersonaModel;
use App\Http\Models\PersonaMoralModel;
use App\Http\Models\VariablesPersona;
use App\Http\Models\VariablesPersonaMoral;
use App\Http\Models\aparicionesModel;
use App\Http\Models\ExtraDenunciadoFisico;
use App\Http\Models\ExtraDenunciadoMoral;
use App\Http\Requests\ActasHechosRequest;
use App\Http\Requests\ActasHechosMoralRequest;
use App\Http\Requests\ActasCircunstanciadasRequest;
use App\Http\Requests\StoreAbogado;
use App\Http\Requests\StoreAutoridad;
use App\Http\Requests\StoreDenunciado;
use App\Http\Requests\StoreDenunciante;
use App\Http\Requests\StoreTestigo;
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
        $idVariable = ValidacionController::saveInputsFisica($request);
        return response()->json($idVariable);
    }

    public function valActasHechosMUAT(ActasHechosMoralRequest $request){
        $idVariable = ValidacionController::saveInputsMoral($request);
        return response()->json($idVariable);
    }

    public function valActasCircunstanciadasFUAT(ActasCircunstanciadasRequest $request){
        $idVariable = ValidacionController::saveInputsFisica($request);
        return response()->json($idVariable);
    }

    public function valAbogadoUIPJ(AbogadoUIPJRequest $request){
        $idVariable = ValidacionController::saveInputsAbogadoFisica($request);
        return response()->json($idVariable);
    }

    public function valAutoridadUIPJ(AutoridadUIPJRequest $request){
        $idVariable = ValidacionController::saveInputsFisica($request);
        return response()->json($idVariable);
    }

    // public function valTestigoUIPJ(StoreTestigo $request){
    //     $idVariable = ValidacionController::saveInputsFisica($request);
    //     return response()->json($idVariable);
    // }

    public function valDenuncianteFUIPJ(DenuncianteFisicaUIPJRequest $request){
        $idVariable = ValidacionController::saveInputsFisica($request);
        return response()->json($idVariable);
    }

    public function valDenuncianteMUIPJ(DenuncianteMoralUIPJRequest $request){
        $idVariable = ValidacionController::saveInputsMoral($request);
        return response()->json($idVariable);
    }
    public function valDenunciadoFUIPJ(DenunciadoFisicaUIPJRequest $request){
        $idVariable = ValidacionController::saveInputsFisica($request);
        return response()->json($idVariable);
    }

    public function valDenunciadoMUIPJ(DenunciadoMoralUIPJRequest $request){
        $idVariable = ValidacionController::saveInputsMoral($request);
        return response()->json($idVariable);
    }
    public function valConocidoFUIPJ(ConocidoFisicoUIPJRequest $request){
        $idVariable = ValidacionController::saveInputsConocidoFisico($request);
        return response()->json($idVariable);
    }

    public function valConocidoMUIPJ(ConocidoMoralUIPJRequest $request){
        $idVariable = ValidacionController::saveInputsConocidoMoral($request);
        return response()->json($idVariable);
    }

    public function valQrrUIPJ(Request $request){
        $idVariable = ValidacionController::saveQrr($request);
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
            $persona->idEtnia = ($request->idEtnia=='')?'13':$request->idEtnia;
            $persona->idLengua = ($request->idLengua=='')?'69':$request->idLengua;
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
            $variables->idOcupacion = ($request->idOcupacion=='')?'2941':$request->idOcupacion;
            $variables->idEstadoCivil = ($request->idEstadoCivil=='')?'7':$request->idEstadoCivil;
            $variables->idEscolaridad = ($request->idEscolaridad=='')?'14':$request->idEscolaridad; 
            $variables->idReligion = ($request->idReligion=='')?'29':$request->idReligion;
            $variables->docIdentificacion = ($request->docIdentificacion=='')?'14':$request->docIdentificacion;
            $variables->idInterprete = ($request->idInterprete=='')?'1':$request->idInterprete;
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
            $variables->idEstadoCivil = ($request->idEstadoCivil=='')?'7':$request->idEstadoCivil;
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
            if($request->personaFisica==''&&$request->idPersona==''){
                $persona = new PersonaModel();
                $oper="INSERT";
                $antes= null;
                $persona->nombres = $request->nombres;
                $persona->primerAp = $request->primerAp;
                $persona->segundoAp = $request->segundoAp;
                $persona->save();
            }
            else{
                $persona = PersonaModel::find($request->personaFisica);
                $oper = "UPDATE";
                $antes = clone $persona;
                $persona->nombres = $request->nombres;
                $persona->primerAp = $request->primerAp;
                $persona->segundoAp = $request->segundoAp;
                $persona->save();
            }
            if($request->idPersona==''){
                $variables = new VariablesPersona();
                $oper="INSERT";
                $antes= null;
            }
            else{
                $variables = VariablesPersona::find($request->idPersona);
                $oper = "UPDATE";
                $antes = clone $variables;
            }
            $variables->idPersona = ($request->personaFisica=='')?$persona->id:$request->personaFisica;
            $variables->idDomicilio = ($request->personaFisica=='')?1:$request->idDomicilio; 
            $variables->idTrabajo = ($request->personaFisica=='')?1:$request->idTrabajo; 
            $variables->idNotificacion = ($request->personaFisica=='')?1:$request->idNotificacion;
            $variables->save();
            saveInLog($request->sistema,$request->usuario,'variables_persona_fisica','INSERT',$variables->id,null,$variables);
            if($request->idExtrasConocido==''){
                $extras = new ExtraDenunciadoFisico();
                $oper="INSERT";
                $antes= null;
                $extras->idVariablesPersona = $variables->id;
            }
            else{
                $extras = ExtraDenunciadoFisico::find($request->idExtrasConocido);
                $oper = "UPDATE";
                $antes = clone $extras;
            }
            $extras->alias = ($request->alias=='')?'SIN INFORMACION':$request->alias;
            $extras->senasPartic = 'SIN INFORMACION';
            $extras->save();

            saveInLog($request->sistema,$request->usuario,'persona_fisica',$oper,$persona->id,$antes,$persona);
            saveInLog($request->sistema,$request->usuario,'extra_denunciado_fisico',$oper,$extras->id,$antes,$extras);
            DB::commit();
            
            if($request->personaFisica==''&&$request->idPersona==''){
                $data = array('idPersona'=>$persona->id,'idVarPersona'=>$variables->id,'idExtra'=>$extras->id);
            }
            else{
                $data = array('idPersona'=>$persona->id,'idVarPersona'=>$request->idPersona,'idExtra'=>$extras->id);
            }
            return response()->json($data);
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }

    public function saveInputsConocidoMoral($request){
        DB::beginTransaction();
        try{
            if($request->personaMoral==''&&$request->idPersonaMoral==''){
                $persona = new PersonaMoralModel();
                $oper="INSERT";
                $antes= null;
                $persona->nombre = $request->nombre;
                $persona->fechaCreacion = "1990-01-01";
                $persona->rfc = "";
                $persona->save();
            }
            else{
                $persona = PersonaMoralModel::find($request->personaMoral);
                $oper = "UPDATE";
                $antes = clone $persona;
                $persona->nombre = $request->nombre;
                $persona->save();
            }

            $variables = new VariablesPersonaMoral();
            $variables->idPersona = ($request->personaMoral=='')?$persona->id:$request->personaMoral;
            $variables->idDomicilio = ($request->personaMoral=='')?1:$request->idDomicilio; 
            $variables->idNotificacion = ($request->personaMoral=='')?1:$request->idNotificacion;
            $variables->save();

            saveInLog($request->sistema,$request->usuario,'persona_moral',$oper,$persona->id,$antes,$persona);
            saveInLog($request->sistema,$request->usuario,'variables_persona_moral',$oper,$variables->id,$antes,$variables);
            DB::commit();

            $data = array('idPersona'=>$persona->id,'idVarPersona'=>$variables->id,'idExtra'=>'');
            return response()->json($data);
        }catch (\PDOException $e){
            DB::rollBack();
            return false;
        }
    }

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
            $variables->docIdentificacion = ($request->docIdentificacion=='')?'14':$request->docIdentificacion;
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
        $aparicion = aparicionesModel::where('carpeta',$request->carpeta)
        ->where('idVarPersona',1)->first();
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
                $apariciones = saveInApariciones($request->sistema,$request->idCarpeta,$request->carpeta,1,'denunciado','xxxxx',0);
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
}
