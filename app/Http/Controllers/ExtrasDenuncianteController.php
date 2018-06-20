<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\ExtraDenunciante;
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
    public function store(Request $request)
    {        
        $ExtraDenunciante = new ExtraDenunciante();
        $ExtraDenunciante->idVariablesPersona = $request->idVariablesPersona;
        $ExtraDenunciante->idNotificacion = $request->idNotificacion;
        $ExtraDenunciante->idAbogado = $request->idAbogado;
        $ExtraDenunciante->victima = $request->victima;
        $ExtraDenunciante->reguardarIdentidad = $request->reguardarIdentidad;
        $ExtraDenunciante->narracion = $request->narracion;        
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
    public function update(Request $request, $id)
    {
        //
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
