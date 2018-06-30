<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Models\ExtraAutoridad;
use App\Http\Controllers\Controller;
use BitracoraController;
use DB;

class ExtrasAutoridadController extends Controller
{
    protected $log;

    function __construct() {
        $this->log=new BitacoraController();
    }

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
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,"extra_autoridad",$oper,$extraAutoridad->id,$antes,$extraAutoridad);
            DB::commit();
            return $extraAutoridad->id;
        }
        catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
