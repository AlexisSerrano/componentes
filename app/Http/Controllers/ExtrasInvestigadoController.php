<?php

namespace App\Http\Controllers;

use App\Http\Models\CatPuesto;
use Illuminate\Http\Request;
use App\Http\Models\ExtraDenunciadoFisico;
use App\Http\Models\ExtraDenunciadoMoral;
use DB;

class ExtrasInvestigadoController extends Controller{

    public function indexFisico(){
        return view("extrasInvestigadoFisico");
    }

    public function indexMoral(){
        return view("extrasInvestigadoMoral");
    }
    
    public function getPuestos(){
        $puestos=CatPuesto::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($puestos);
    }

    public function addExtrasDenunciado(Request $request){
        try{
            DB::beginTransaction();
            if($request->idExtrasDenunciado!=""){
                $extraDenunciado=($request->empresa)?ExtraDenunciadoMoral::find($request->idExtrasDenunciado):ExtraDenunciadoFisico::find($request->idExtrasDenunciado);
                $oper="UPDATE";
                $antes= clone $extraDenunciado;
                $tipo=($request->empresa)?"extra_denunciado_moral":"extra_denunciado_fisico";
            }else{
                $extraDenunciado=($request->empresa)?new ExtraDenunciadoMoral():new ExtraDenunciadoFisico();
                $oper="INSERT";
                $antes=null;
                $extraDenunciado->idVariablesPersona = $request->idPersona;
                $tipo=($request->empresa)?"extra_denunciado_moral":"extra_denunciado_fisico"; 
            }     
            $extraDenunciado->idPuesto = $request->idPuesto;
            $extraDenunciado->alias = ($request->alias=='')?'SIN INFORMACIÓN':$request->alias;
            $extraDenunciado->senasPartic = $request->particulares;
            $extraDenunciado->ingreso = $request->ingreso;
            $extraDenunciado->periodoIngreso = $request->periodoIngreso;
            $extraDenunciado->residenciaAnterior = $request->residenciaAnterior;
            $extraDenunciado->personasBajoSuGuarda = $request->dependientes;
            $extraDenunciado->perseguidoPenalmente = $request->perseguidoPenalmente;
            $extraDenunciado->vestimenta = $request->vestimenta;    
            $extraDenunciado->save();

            $apariciones = saveInApariciones($request->sistema,$request->idCarpeta,$request->idPersona,$request->tipo,'xxxxx',$request->empresa);

            saveInLog($request->sistema,$request->usuario,'apariciones','INSERT',$apariciones->id,null,$apariciones);
            saveInLog($request->sistema,$request->usuario,$tipo,$oper,$extraDenunciado->id,$antes,$extraDenunciado);
            DB::commit();
            return $extraDenunciado->id;
        }
        catch(Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function addExtrasConocido(Request $request){
        try{
            DB::beginTransaction();
            if($request->idExtrasConocido!=""){
                $extraDenunciado=($request->empresa)?ExtraDenunciadoMoral::find($request->idExtrasConocido):ExtraDenunciadoFisico::find($request->idExtrasConocido);
                $oper="UPDATE";
                $antes= clone $extraDenunciado;
                $tipo=($request->empresa)?"extra_denunciado_moral":"extra_denunciado_fisico";
            }else{
                $extraDenunciado=($request->empresa)?new ExtraDenunciadoMoral():new ExtraDenunciadoFisico();
                $oper="INSERT";
                $antes=null;
                $extraDenunciado->idVariablesPersona = $request->idPersona;
                $tipo=($request->empresa)?"extra_denunciado_moral":"extra_denunciado_fisico"; 
            }
            $extraDenunciado->senasPartic = $request->particulares;
            $extraDenunciado->save();

            $apariciones = saveInApariciones($request->sistema,$request->idCarpeta,$request->idPersona,$request->tipo,'xxxxx',$request->empresa);

            saveInLog($request->sistema,$request->usuario,'apariciones','INSERT',$apariciones->id,null,$apariciones);
            saveInLog($request->sistema,$request->usuario,$tipo,$oper,$extraDenunciado->id,$antes,$extraDenunciado);
            DB::commit();
            return $extraDenunciado->id;
        }
        catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
