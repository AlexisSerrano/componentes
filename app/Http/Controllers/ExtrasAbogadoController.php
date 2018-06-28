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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $id=[];       
        try{
            DB::beginTransaction();        
            $extraAbogado = new ExtraAbogado();
            $extraAbogado->idVariablesPersona = $request->idVariablesPersona;
            $extraAbogado->cedulaProf = $request->cedulaProf;        
            $extraAbogado->sector = $request->sector;
            $extraAbogado->correo = $request->correo;
            $extraAbogado->tipo = $request->tipo;
            $extraAbogado->save();  
            $id = $extraAbogado->id;                
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_abogado','INSERT',$id,null,$extraAbogado);
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            return response()->json(["ERROR"->$e->getMessage()]);
        }    
        return response()->json($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {    
        $id=[];     
        try{
            DB::beginTransaction();
            $extraAbogado = ExtraAbogado::find($request->id);
            $antes= clone $extraAbogado;
            $extraAbogado->cedulaProf = $request->cedulaProf;        
            $extraAbogado->sector = $request->sector;
            $extraAbogado->correo = $request->correo;
            $extraAbogado->tipo = $request->tipo;
            $extraAbogado->save();  
            $id = $extraAbogado->id;                
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_denunciado_fisico','UPDATE',$id,$antes,$extraAbogado);
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            return response()->json(["ERROR"->$e->getMessage()]);
        }
        return response()->json($id);
    }
}
