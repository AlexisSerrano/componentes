<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Models\ExtraDenuncianteFisico;
use App\Http\Models\ExtraDenuncianteMoral;
use App\Http\Controllers\Controller;

class ExtrasDenuncianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("extrasDenunciante");
        
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
    public function storeExtraDenuncianteFisico(Request $request)
    {        
        $ExtraDenunciante = new ExtraDenuncianteFisico();
        $ExtraDenunciante->idVariablesPersona = $request->idVariablesPersona;        
        $ExtraDenunciante->idAbogado = $request->idAbogado;
        $ExtraDenunciante->resguardarIdentidad = $request->reguardarIdentidad;        
        $ExtraDenunciante->victima = $request->victima;        
        $ExtraDenunciante->save();  
        $id = $ExtraDenunciante->id;                
        return response()->json($id);
        
    }

    public function storeExtraDenuncianteMoral(Request $request)
    {        
        $ExtraDenunciante = new ExtraDenuncianteMoral();
        $ExtraDenunciante->idVariablesPersona = $request->idVariablesPersona;        
        $ExtraDenunciante->idAbogado = $request->idAbogado;
        $ExtraDenunciante->resguardarIdentidad = $request->reguardarIdentidad;        
        $ExtraDenunciante->victima = $request->victima;      
        $ExtraDenunciante->save();  
        $id = $ExtraDenunciante->id;                
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
    public function updateExtrasDenuncianteFisico(Request $request)
    {               
        $ExtraDenunciante = ExtraDenuncianteFisico::find($request->idVariablesPersona);            
        $ExtraDenunciante->idAbogado= $request->idAbogado;
        $ExtraDenunciante->resguardarIdentidad = $request->reguardarIdentidad;
        $ExtraDenunciante->victima = $request->victima;                
        $ExtraDenunciante->save();     
        $id = $ExtraDenunciante->id;                
        return response()->json($id); 

    }

    public function updateExtrasDenuncianteMoral(Request $request)
    {         
        $ExtraDenunciante = ExtraDenuncianteMoral::find($request->idVariablesPersona);            
        $ExtraDenunciante->idAbogado= $request->idAbogado;
        $ExtraDenunciante->resguardarIdentidad = $request->reguardarIdentidad;
        $ExtraDenunciante->victima = $request->victima;                
        $ExtraDenunciante->save();     
        $id = $ExtraDenunciante->id;                
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
