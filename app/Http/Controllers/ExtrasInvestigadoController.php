<?php

namespace App\Http\Controllers;

use App\Http\Models\CatPuesto;
use Illuminate\Http\Request;
use App\Http\Models\ExtraDenunciadoFisico;
use App\Http\Models\ExtraDenunciadoMoral;
use BitracoraController;
use DB;

class ExtrasInvestigadoController extends Controller{

    protected $log;

    function __construct() {
        $this->log=new BitacoraController();
    }

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFisico(Request $request)
    {       
       $id=[];       
        try{
            DB::beginTransaction();
            $extraDenunciado = new ExtraDenunciadoFisico();
            $extraDenunciado->idVariablesPersona = $request->idVariablesPersona;
            $extraDenunciado->idPuesto = $request->idPuesto;
            $extraDenunciado->alias = $request->alias;
            $extraDenunciado->senasPartic = $request->senasPartic;
            $extraDenunciado->ingreso = $request->ingreso;
            $extraDenunciado->periodoIngreso = $request->periodoIngreso;
            $extraDenunciado->residenciaAnterior = $request->residenciaAnterior;
            $extraDenunciado->personasBajoSuGuarda = $request->personasBajoSuGuarda;
            $extraDenunciado->perseguidoPenalmente = $request->perseguidoPenalmente;
            $extraDenunciado->vestimenta = $request->vestimenta;
            $extraDenunciado->save();
            $id = $extraDenunciado->id;
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_denunciado_fisico','INSERT',$id,null,$extraDenunciado);
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
    public function updateFisico(Request $request)
    {   
        $id=[];     
        try{
            DB::beginTransaction();
            $extraDenunciado = ExtraDenunciadoFisico::find($request->id);
            $antes=clone $extraDenunciado;
            $extraDenunciado->idPuesto = $request->idPuesto;
            $extraDenunciado->alias = $request->alias;
            $extraDenunciado->senasPartic = $request->senasPartic;
            $extraDenunciado->ingreso = $request->ingreso;
            $extraDenunciado->periodoIngreso = $request->periodoIngreso;
            $extraDenunciado->residenciaAnterior = $request->residenciaAnterior;
            $extraDenunciado->personasBajoSuGuarda = $request->personasBajoSuGuarda;
            $extraDenunciado->perseguidoPenalmente = $request->perseguidoPenalmente;
            $extraDenunciado->vestimenta = $request->vestimenta;
            $extraDenunciado->save();  
            $id = $extraDenunciado->id;
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_denunciado_fisico','UPDATE',$id,$antes,$extraDenunciado);
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            return response()->json(["ERROR"->$e->getMessage()]);
        }
        return response()->json($id);
    }

    public function storeMoral(Request $request)
    {        
        $id=[];     
        try{
            DB::beginTransaction();
            $extraDenunciado = new ExtraDenunciadoMoral();
            $extraDenunciado->idVariablesPersona = $request->idVariablesPersona;
            $extraDenunciado->idPuesto = $request->idPuesto;
            $extraDenunciado->alias = $request->alias;
            $extraDenunciado->senasPartic = $request->senasPartic;
            $extraDenunciado->ingreso = $request->ingreso;
            $extraDenunciado->periodoIngreso = $request->periodoIngreso;
            $extraDenunciado->residenciaAnterior = $request->residenciaAnterior;
            $extraDenunciado->personasBajoSuGuarda = $request->personasBajoSuGuarda;
            $extraDenunciado->perseguidoPenalmente = $request->perseguidoPenalmente;
            $extraDenunciado->vestimenta = $request->vestimenta;
            $extraDenunciado->save();
            $id = $extraDenunciado->id;                
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_denunciado_moral','INSERT',$id,null,$extraDenunciado);
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
    public function updateMoral(Request $request)
    {
        $id=[];     
        try{
            DB::beginTransaction();        
            $extraDenunciado = ExtraDenunciadoMoral::find($request->id);
            $antes=clone $extraDenunciado;
            $extraDenunciado->idPuesto = $request->idPuesto;
            $extraDenunciado->alias = $request->alias;
            $extraDenunciado->senasPartic = $request->senasPartic;
            $extraDenunciado->ingreso = $request->ingreso;
            $extraDenunciado->periodoIngreso = $request->periodoIngreso;
            $extraDenunciado->residenciaAnterior = $request->residenciaAnterior;
            $extraDenunciado->personasBajoSuGuarda = $request->personasBajoSuGuarda;
            $extraDenunciado->perseguidoPenalmente = $request->perseguidoPenalmente;
            $extraDenunciado->vestimenta = $request->vestimenta;
            $extraDenunciado->save();  
            $id = $extraDenunciado->id;                
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_denunciado_moral','UPDATE',$id,$antes,$extraDenunciado);
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            return response()->json(["ERROR"->$e->getMessage()]);
        }
        return response()->json($id);
    }
}
