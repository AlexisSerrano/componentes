<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Models\ExtraAutoridad;
use App\Http\Controllers\Controller;

class ExtrasAutoridadController extends Controller
{
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
        $ExtraAutoridad = new ExtraAutoridad();
        $ExtraAutoridad->idVariablesPersona = $request->idVariablesPersona;
        $ExtraAutoridad->antiguedad = $request->antiguedad;
        $ExtraAutoridad->rango = $request->rango;
        $ExtraAutoridad->horarioLaboral = $request->horarioLaboral;
        //$ExtraAutoridad->narracion = $request->narracion;                
        $ExtraAutoridad->save();  
        $id = $ExtraAutoridad->id;                
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
        
       $ExtraAutoridad = ExtraAutoridad::find($request->idVariablesPersona);        
        $ExtraAutoridad->antiguedad = $request->antiguedad;
        $ExtraAutoridad->rango = $request->rango;
        $ExtraAutoridad->horarioLaboral = $request->horarioLaboral;                 
        $ExtraAutoridad->save();     
        $id = $ExtraAutoridad->id;                
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
