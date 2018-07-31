<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Models\ExtraAutoridad;
use App\Http\Controllers\Controller;
use DB;

class ExtrasAutoridadController extends Controller
{

    public function index(){
        return view("extrasAutoridad");
    }

    public function addExtrasAutoridad(Request $request){
        try{
            DB::beginTransaction();
            if($request->idExtrasAutoridad!=""){
                $extraAutoridad = ExtraAutoridad::find($request->idExtrasAutoridad);
                $oper="UPDATE";
                $antes= clone $extraAutoridad;
            }else{
                $extraAutoridad = new ExtraAutoridad();
                $oper="INSERT";
                $antes=null;
                $extraAutoridad->idVariablesPersona = $request->idPersona;
            }     
            $extraAutoridad->antiguedad = $request->antiguedad;
            $extraAutoridad->rango = $request->rango;
            $extraAutoridad->horarioLaboral = $request->horarioLaboral;      
            $extraAutoridad->save();

            $apariciones = saveInApariciones($request->sistema,$request->idCarpeta,$request->carpeta,$request->idPersona,$request->tipo,'xxxxx',$request->empresa);

            saveInLog($request->sistema,$request->usuario,'apariciones','INSERT',$apariciones->id,null,$apariciones);
            saveInLog($request->sistema,$request->usuario,"extra_autoridad",$oper,$extraAutoridad->id,$antes,$extraAutoridad);

            $bdbitacora = BitacoraNavCaso::where('idCaso',$request->idCarpeta)->first();
            $bdbitacora->autoridad = $bdbitacora->autoridad+1;
            $bdbitacora->save();
            DB::commit();
            return $extraAutoridad->id;
        }
        catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
