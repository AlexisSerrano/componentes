<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\ExtraAbogado;
use BitracoraController;
use DB;

class ExtrasAbogadoController extends Controller
{
    protected $log;

    function __construct() {
        $this->log=new BitacoraController();
    }

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
            $extraAbogado->tipo = $request->tipo;      
            $extraAbogado->save();
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,"extra_abogado",$oper,$extraAbogado->id,$antes,$extraAbogado);
            DB::commit();
            return $ExtraAbogado->id;
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
    //         $extraAbogado = new ExtraAbogado();
    //         $extraAbogado->idVariablesPersona = $request->idVariablesPersona;
    //         $extraAbogado->cedulaProf = $request->cedulaProf;        
    //         $extraAbogado->sector = $request->sector;
    //         $extraAbogado->correo = $request->correo;
    //         $extraAbogado->tipo = $request->tipo;
    //         $extraAbogado->save();  
    //         $id = $extraAbogado->id;                
    //         $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_abogado','INSERT',$id,null,$extraAbogado);
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
    //         $extraAbogado = ExtraAbogado::find($request->id);
    //         $antes= clone $extraAbogado;
    //         $extraAbogado->cedulaProf = $request->cedulaProf;        
    //         $extraAbogado->sector = $request->sector;
    //         $extraAbogado->correo = $request->correo;
    //         $extraAbogado->tipo = $request->tipo;
    //         $extraAbogado->save();  
    //         $id = $extraAbogado->id;                
    //         $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_denunciado_fisico','UPDATE',$id,$antes,$extraAbogado);
    //         DB::commit();
    //     }catch (Exception $e){
    //         DB::rollback();
    //         return response()->json(["ERROR"->$e->getMessage()]);
    //     }
    //     return response()->json($id);
    // }
}
