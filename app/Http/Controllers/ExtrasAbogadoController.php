<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\ExtraAbogado;
use DB;

class ExtrasAbogadoController extends Controller
{

    public function index(){
        return view("extrasAbogado");
    }

    public function addExtrasAbogado(Request $request){
        try{
            DB::beginTransaction();
            if($request->idExtrasAbogado!=""){
                $extraAbogado = ExtraAbogado::find($request->idExtrasAbogado);
                $oper="UPDATE";
                $antes= clone $extraAbogado;
            }else{
                $extraAbogado = new ExtraAbogado();
                $oper="INSERT";
                $antes=null;
                $extraAbogado->idVariablesPersona = $request->idPersona;
            }     
            $extraAbogado->cedulaProf = $request->cedula;        
            $extraAbogado->sector = $request->sector;
            $extraAbogado->correo = $request->correo;
            $extraAbogado->tipo = $request->tipoAbogado;      
            $extraAbogado->save();

            $apariciones = saveInApariciones($request->sistema,$request->idCarpeta,$request->carpeta,$request->idPersona,$request->tipo,'xxxxx',$request->empresa);

            saveInLog($request->sistema,$request->usuario,'apariciones','INSERT',$apariciones->id,null,$apariciones);
            saveInLog($request->sistema,$request->usuario,"extra_abogado",$oper,$extraAbogado->id,$antes,$extraAbogado);
            DB::commit();
            return $extraAbogado->id;
        }
        catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
