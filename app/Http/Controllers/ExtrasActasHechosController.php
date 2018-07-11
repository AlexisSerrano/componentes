<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtrasActasHechosController extends Controller
{
    public function addExtrasActasHechos(Request $request){
        try{
            DB::beginTransaction();
            if($request->idExtrasAutoridad!=""){
                $extraActas = ExtraAutoridad::find($request->idExtrasAutoridad);
                $oper="UPDATE";
                $antes= clone $extraActas;
            }else{
                $extraActas = new ExtraAutoridad();
                $oper="INSERT";
                $antes=null;
                $extraAutoridad->idVariablesPersona = $request->idPersona;
            }     
            $extraAutoridad->antiguedad = $request->antiguedad;
            $extraAutoridad->rango = $request->rango;
            $extraAutoridad->horarioLaboral = $request->horarioLaboral;      
            $extraAutoridad->save();

            $apariciones = saveInApariciones($request->sistema,$request->idCarpeta,$request->idPersona,$request->tipo,'xxxxx',$request->empresa);

            saveInLog($request->sistema,$request->usuario,'apariciones','INSERT',$apariciones->id,null,$apariciones);
            saveInLog($request->sistema,$request->usuario,"extra_autoridad",$oper,$extraAutoridad->id,$antes,$extraAutoridad);
            DB::commit();
            return $extraAutoridad->id;
        }
        catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
