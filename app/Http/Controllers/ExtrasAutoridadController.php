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
            if($request->idExtraAutoridad!=""){
                $extraAutoridad = ExtraAutoridad::find($request->idExtraAutoridad);
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

    // public function store(Request $request)
    // {        
    //     $id=[];       
    //     try{
    //         DB::beginTransaction();
    //         $ExtraAutoridad = new ExtraAutoridad();
    //         $ExtraAutoridad->idVariablesPersona = $request->idVariablesPersona;
    //         $ExtraAutoridad->antiguedad = $request->antiguedad;
    //         $ExtraAutoridad->rango = $request->rango;
    //         $ExtraAutoridad->horarioLaboral = $request->horarioLaboral;
    //         //$ExtraAutoridad->narracion = $request->narracion;                
    //         $ExtraAutoridad->save();  
    //         $id = $ExtraAutoridad->id;
    //         $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_autoridad','INSERT',$id,null,$ExtraAutoridad);
    //         DB::commit();
    //     }catch (Exception $e){
    //         DB::rollback();
    //         return response()->json(["ERROR"->$e->getMessage()]);
    //     }    
    //     return response()->json($id);
    // }

    // public function update(Request $request)
    // {
    //     $id=[];     
    //     try{
    //         DB::beginTransaction(); 
    //         $ExtraAutoridad = ExtraAutoridad::find($request->idVariablesPersona);        
    //         $antes=clone $ExtraAutoridad;
    //         $ExtraAutoridad->antiguedad = $request->antiguedad;
    //         $ExtraAutoridad->rango = $request->rango;
    //         $ExtraAutoridad->horarioLaboral = $request->horarioLaboral;                 
    //         $ExtraAutoridad->save();     
    //         $id = $ExtraAutoridad->id; 
    //         $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_autoridad','UPDATE',$id,$antes,$ExtraAutoridad);
    //         DB::commit();
    //     }catch (Exception $e){
    //         DB::rollback();
    //         return response()->json(["ERROR"->$e->getMessage()]);
    //     }               
    //         return response()->json($id);
    // }
}
