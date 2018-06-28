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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("extrasAutoridad");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $ExtraAutoridad = new ExtraAutoridad();
            $ExtraAutoridad->idVariablesPersona = $request->idVariablesPersona;
            $ExtraAutoridad->antiguedad = $request->antiguedad;
            $ExtraAutoridad->rango = $request->rango;
            $ExtraAutoridad->horarioLaboral = $request->horarioLaboral;
            //$ExtraAutoridad->narracion = $request->narracion;                
            $ExtraAutoridad->save();  
            $id = $ExtraAutoridad->id;
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_autoridad','INSERT',$id,null,$ExtraAutoridad);
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            return response()->json(["ERROR"->$e->getMessage()]);
        }    
        return response()->json($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=[];     
        try{
            DB::beginTransaction(); 
            $ExtraAutoridad = ExtraAutoridad::find($request->idVariablesPersona);        
            $antes=clone $ExtraAutoridad;
            $ExtraAutoridad->antiguedad = $request->antiguedad;
            $ExtraAutoridad->rango = $request->rango;
            $ExtraAutoridad->horarioLaboral = $request->horarioLaboral;                 
            $ExtraAutoridad->save();     
            $id = $ExtraAutoridad->id; 
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_autoridad','UPDATE',$id,$antes,$ExtraAutoridad);
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            return response()->json(["ERROR"->$e->getMessage()]);
        }               
            return response()->json($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
